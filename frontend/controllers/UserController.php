<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($username)
    {
        return $this->render('view', [
            'model' => $this->findModel($username),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($username)
    {
        $model = $this->findModel($username);
        $model->scenario = 'updateUser';

        if ($model->id_user == Yii::$app->user->identity->id) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {


                $model->avatar = UploadedFile::getInstance($model, 'avatar');

                if (!is_null($model->avatar)) {

                    if (!is_dir($model->pathToUserFolder() . '/avatar/'))
                        mkdir($model->pathToUserFolder() . '/avatar/', 766, true);

                    $model->avatar->saveAs($model->pathToUserFolder() . '/avatar/' . $model->username . '.jpg');
                }

                return $this->redirect(['view', 'username' => $model->username]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException('Доступ запрещен.');
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($username)
    {
        $model = $this->findModel($username);

        $model->status = $model::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        if (($model = User::findByUsername($username)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Пользователь не найден.');
        }
    }
}