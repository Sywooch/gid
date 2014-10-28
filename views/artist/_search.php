<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\artist\ArtistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'id_artist') ?>

    <?= $form->field($model, 'name_artist') ?>

    <?= $form->field($model, 'type_artist') ?>

    <?php // echo $form->field($model, 'birthplace') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>