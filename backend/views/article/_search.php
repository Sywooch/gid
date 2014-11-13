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
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                //'wrapper' => 'col-sm-6',
            ],
        ],
    ]); ?>

    <div class="col-sm-4">

        <?= $form->field($model, 'id_article') ?>

        <?= $form->field($model, 'title') ?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'id_category')->dropDownList(
            ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id_category', 'name'),
            ['prompt' => '']
        )?>

        <?= $form->field($model, 'id_created_user')?>

    </div>

    <div class="col-sm-4">

        <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'active')->checkbox()->label('Корзина')?>

    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>