<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\article\ArticleCategory
 * @var $form yii\bootstrap\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить категорию';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Обновить категорию: ' . ' ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_category]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'id_parent')->textInput() ?>

    <?php ActiveForm::end(); ?>

</div>