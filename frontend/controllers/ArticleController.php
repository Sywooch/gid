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
            else return 3;



            /*Yii::$app->response->format = 'json';
            if($model->save()) {
                return ['message' => 'Success!'];
            } else {
                return ActiveForm::validate($model);;
            }*/



            /*$request = Yii::$app->request;
            $model = new Model();
            if ($request->isAjax && $model->load($request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($model);
            } elseif ($model->load($request->post()) && $model->save()) {
                return ['message' => 'Success!'];
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }*/



        } else return 'notajax';//Forbidden
    }
}