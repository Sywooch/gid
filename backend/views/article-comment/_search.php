<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model backend\models\article\ArticleCommentSearch
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="article-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_comment') ?>

    <?= $form->field($model, 'id_parent') ?>

    <?= $form->field($model, 'id_article') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
