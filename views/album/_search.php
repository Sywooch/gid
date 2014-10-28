<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\album\AlbumSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_album') ?>

    <?= $form->field($model, 'name_album') ?>

    <?= $form->field($model, 'alt_name_album') ?>

    <?= $form->field($model, 'released') ?>

    <?= $form->field($model, 'recorded') ?>

    <?php // echo $form->field($model, 'year_album') ?>

    <?php // echo $form->field($model, 'length_album') ?>

    <?php // echo $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'size_disk') ?>

    <?php // echo $form->field($model, 'disks') ?>

    <?php // echo $form->field($model, 'number_album') ?>

    <?php // echo $form->field($model, 'sound') ?>

    <?php // echo $form->field($model, 'artists') ?>

    <?php // echo $form->field($model, 'count_artists') ?>

    <?php // echo $form->field($model, 'status_album') ?>

    <?php // echo $form->field($model, 'repeated') ?>

    <?php // echo $form->field($model, 'changed') ?>

    <?php // echo $form->field($model, 'times') ?>

    <?php // echo $form->field($model, 'dead') ?>

    <?php // echo $form->field($model, 'ost') ?>

    <?php // echo $form->field($model, 'device') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
