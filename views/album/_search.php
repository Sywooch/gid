<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\album\AlbumSearch
 * @var $form yii\bootstrap\ActiveForm
*/
?>

<div class="album-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-6',
                //'wrapper' => 'col-sm-6',
            ],
        ],
    ]); ?>

    <?= $form->errorSummary($model) ?>

    <div class="col-md-4 form-group-sm">

        <?= $form->field($model, 'id_album') ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'year') ?>

    </div>

    <div class="col-md-4 form-group-sm">

        <?= $form->field($model, 'type')->dropDownList($model->typeArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'sound')->dropDownList($model->soundArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'size') ?>

    </div>

    <div class="col-md-4 form-group-sm">

        <?= $form->field($model, 'repeated')->dropDownList($model->repeatArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'count_artists') ?>

        <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'changed')->dropDownList($model->changeArray, ['prompt' => '']) ?>

    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>