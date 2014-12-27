<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model backend\models\UserSearch
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="user-search clearfix">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-4">

        <?= $form->field($model, 'id_user') ?>

        <?= $form->field($model, 'username') ?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'role')->dropDownList($model->roleArray, ['prompt' => '']) ?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['prompt' => '']) ?>

    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>