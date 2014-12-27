<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model backend\models\article\ArticleCommentSearch
 * @var $form yii\bootstrap\ActiveForm
 */
?>

<div class="article-comment-search clearfix">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-sm-4">

        <?= $form->field($model, 'id_comment') ?>

        <?= $form->field($model, 'id_parent') ?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'id_article') ?>

        <?= $form->field($model, 'id_user') ?>

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