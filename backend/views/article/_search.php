<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\article\ArticleCategory;

/**
 * @var $this yii\web\View
 * @var $model backend\models\article\ArticleSearch
 * @var $form yii\bootstrap\ActiveForm
 */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id_article') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'id_category')->dropDownList(
        ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id_category', 'name'),
        ['prompt' => '']
    )?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['prompt' => '']) ?>

    <?php // echo $form->field($model, 'end') по автору TODO?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>