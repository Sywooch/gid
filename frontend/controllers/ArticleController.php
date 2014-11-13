<?php

namespace frontend\controllers;

use Yii;
use common\models\article\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function behaviors()
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
    }



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
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($alias)
    {
        $model = $this->findModel($alias);

        //Обновляем количество просмотров
        $model->updateCounters(['views' => 1]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($alias)
    {
        if (($model = Article::findOne(['alias' => $alias])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Статья не найдена.');
        }
    }
}