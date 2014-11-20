<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class SystemController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionFileManager()
    {
        return $this->render('file-manager');
    }

}