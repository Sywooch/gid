<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\models\article\ArticleCategory;
use common\models\article\Article;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
{
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $articles = Article::find()
            ->where([
                'status' => Article::STATUS_PUBLISHED,
                'active' => Article::OPTION_ACTIVE,
                'id_category' => $model->id_category,
            ])
            ->andWhere(['<', 'publication', \Yii::$app->formatter->asTimestamp(date_create())])
            ->andWhere(['or', 'end > ' . \Yii::$app->formatter->asTimestamp(date_create()), 'end IS NULL'])
            ->select(['alias', 'title', 'image', 'preview', 'publication'])
            ->orderBy(['publication' => SORT_DESC])
            ->limit(15)
            ->all();

        return $this->render('view', [
            'model' => $model,
            'articles' => $articles,
        ]);
    }

    /**
     * Finds the ArticleCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Категория не найдена.');
        }
    }

}