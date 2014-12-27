<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use common\models\article\Article;
use common\models\article\ArticleParam;
use common\models\param\ParameterUnique;
use backend\models\article\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach(Yii::$app->request->post('ArticleParam') as $param) {
                $articleParam = new ArticleParam;
                $articleParam->id_article = $model->id_article;
                $articleParam->id_param = $param['id_param'];
                $articleParam->value = $param['value'];
                $articleParam->save();
            }
            return $this->redirect(['view', 'id' => $model->id_article]);
        } else {
            $paramUnique = ParameterUnique::find()->asArray()->all();

            return $this->render('form', [
                'model' => $model,
                'paramUnique' => $paramUnique,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $params = ArticleParam::find()->where(['id_article' => $model->id_article])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Model::loadMultiple($params, Yii::$app->request->post()) && Model::validateMultiple($params)) {
                foreach ($params as $param) {
                    $param->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->id_article]);
        } else {
            //except
            $paramUnique = ParameterUnique::find()
                ->where(['not in', 'id_param', \yii\helpers\ArrayHelper::getColumn($params, 'id_param')])
                ->asArray()
                ->all();

            return $this->render('form', [
                'model'  => $model,
                'params' => $params,
                'paramUnique' => $paramUnique,
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = $model::OPTION_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionDeleteParameter($article, $param)
    {
        if (Yii::$app->request->isAjax) {
            ArticleParam::findOne(['id_article' => $article, 'id_param' => $param])->delete();
            return true;
        } else {
            throw new ForbiddenHttpException('Доступ запрещен.');
        }
    }

    public function actionAddParameter($param, $article = null)
    {
        if (Yii::$app->request->isAjax) {
            $model = new ArticleParam;
            $model->id_param = $param;
            $model->value = '?';
            if (is_null($article)) {
                return $this->renderAjax('_params2', [
                    'model' => $model,
                ]);
            }
            else {
                $model->id_article = $article;
                $model->save();
                return $this->renderAjax('_params', [
                    'params' => ArticleParam::find()->where(['id_article' => $model->id_article])->all(),
                ]);
            }
        } else {
            throw new ForbiddenHttpException('Доступ запрещен.');
        }
    }

    public function actionUpdateSelect()
    {
        if (Yii::$app->request->isAjax) {

            $exception = Yii::$app->request->post('exception');

            $paramUnique = ParameterUnique::find();

            if ($exception != '')
                $paramUnique->where('id_param NOT IN (' . $exception . ')');

            return $this->renderAjax('_params_search', [
                'paramUnique' => $paramUnique->asArray()->all()
            ]);

        } else {
            throw new ForbiddenHttpException('Доступ запрещен.');
        }
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Статья не найдена.');
        }
    }
}