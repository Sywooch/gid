<?php

namespace frontend\controllers;

use Yii;
use common\models\article\Article;
use common\models\article\ArticleComment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
            ->select(['title', 'text', 'publication', 'id_article'])
            ->one();

        if ($article !== null) {

            //Обновляем количество просмотров
            $article->updateCounters(['views' => 1]);

            $comments = ArticleComment::find()
                ->where(['id_parent' => null, 'id_article' => $article->id_article, 'status' => ArticleComment::STATUS_ACTIVE])
                ->select(['id_comment', 'id_parent', 'id_user', 'text', 'created'])
                ->limit(20)
                ->all();

            $newComment = new ArticleComment;

            return $this->render('view', [
                'article'    => $article,
                'comments'   => $comments,
                'newComment' => $newComment,
            ]);
        } else {
            throw new NotFoundHttpException('Статья не найдена.');
        }
    }
}