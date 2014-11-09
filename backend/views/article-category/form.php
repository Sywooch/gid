<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\ArticleCategory
 * @var $form yii\widgets\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Article Categories', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Create Article Category';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Article Category: ' . ' ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_category]];
    $this->params['breadcrumbs'][] = 'Update';
}
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_category')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'id_parent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
