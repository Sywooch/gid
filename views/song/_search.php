<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\song\SongSearch
 * @var $form yii\bootstrap\ActiveForm
*/
?>

<div class="song-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-6',
            ],
        ],
    ]); ?>

    <div class="col-md-6 form-group-sm">

        <?= $form->field($model, 'id_song') ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'year') ?>

    </div>

    <div class="col-md-6 form-group-sm">

        <?= $form->field($model, 'sound')->dropDownList($model->soundArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'count_artists') ?>

        <?php // echo $form->field($model, 'original') ?>

        <?php // echo $form->field($model, 'version') ?>

    </div>


    <div class="form-group text-center">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>