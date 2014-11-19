<?php

namespace backend\controllers;

use yii\web\Controller;

class SystemController extends Controller
{
    public function actionFileManager()
    {
        return $this->render('file-manager');
    }

}