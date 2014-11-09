<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model backend\models\article\ArticleSearch
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_article') ?>

    <?= $form->field($model, 'id_category') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'publication') ?>

    <?php // echo $form->field($model, 'end') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>