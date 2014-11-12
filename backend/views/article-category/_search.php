<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model backend\models\article\ArticleCategorySearch
 * @var $form yii\bootstrap\ActiveForm
 */
?>

<div class="article-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-4">

        <?= $form->field($model, 'id_category') ?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'name') ?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'id_parent') ?>

    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>