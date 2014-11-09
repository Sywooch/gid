<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\Article
 * @var $form yii\bootstrap\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить статью';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Обновить статью: ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_article]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'id_category')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray) ?>

    <?= $form->field($model, 'publication')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>