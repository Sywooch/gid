<?php

namespace frontend\controllers;

use Yii;
use common\models\article\Article;
use common\models\article\ArticleComment;
use common\models\article\ArticleParam;
use common\models\article\ArticleCategory;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

/**
 * ArticleController
 */
class ArticleController extends Controller
{
    /*public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['view'],
                'lastModified' => function () {
                    $query = new \yii\db\Query();
                    return $query->select('updated')
                        ->from('{{%articles}}')
                        ->where(['alias' => Yii::$app->request->get('alias')])
                        ->max('updated');//переделать на последний добавленный комментарий
                },
            ],
        ];
    }*/



    /**
     * Список статей.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Вывод статьи с комментариями.
     * @param string $alias
     * @return mixed
     */
    public function actionView($alias)
    {
        $article = Article::find()
            ->where([
                'alias'  => $alias,
                'status' => Article::STATUS_PUBLISHED,
                'active' => Article::OPTION_ACTIVE,
            ])
            ->select(['title', 'text', 'publication', 'id_article', 'id_category'])
            ->one();

        if ($article !== null) {

            //Обновляем количество просмотров
            $article->updateCounters(['views' => 1]);

            //Параметры
            $metaDesc = ArticleParam::find()
                ->select('value')
                ->innerJoinWith('parameterUnique')
                ->where([
                    'id_article' => $article->id_article,
                    'name'       => 'Мета-тег description'
                ])
                ->one();

            $query = ArticleComment::find()
                ->where(['id_parent' => null, 'id_article' => $article->id_article, 'status' => ArticleComment::STATUS_ACTIVE])
                ->select(['id_comment', 'id_parent', 'id_user', 'text', 'created']);

            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'defaultPageSize' => 10]);
            $comments = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('view', [
                'article'    => $article,
                'comments'   => $comments,
                'newComment' => new ArticleComment,
                'pages'      => $pages,
                'metaDesc'   => $metaDesc,
            ]);
        } else {
            throw new NotFoundHttpException('Статья не найдена.');
        }
    }

    /**
     * Добавление комментария ajax-ом
     * @return mixed
     */
    public function actionAddComment()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {

            $comment = new ArticleComment;

            if ($comment->load($request->post()) && $comment->save()) {
                $this->render('_comment');
                return commentTree($comment);
            }
            else return false;
        } else {
            throw new ForbiddenHttpException('Доступ запрещен.');
        }
    }
}