<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\album\Album
 * @var $form yii\bootstrap\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить альбом';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Обновить альбом: ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_album]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>
<div class="album">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="album-form">

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'released') ?>

        <?= $form->field($model, 'year')->textInput(['maxlength' => 4]) ?>

        <?= $form->field($model, 'length') ?>

        <?= $form->field($model, 'template') ?>

        <?= $form->field($model, 'type')->dropDownList($model->typeArray) ?>

        <?= $form->field($model, 'size')->input('number') ?>

        <?= $form->field($model, 'sound')->dropDownList($model->soundArray) ?>

        <?= $form->field($model, 'count_artists')->input('number') ?>

        <?= $form->field($model, 'status')->dropDownList($model->statusArray) ?>

        <?= $form->field($model, 'repeated')->dropDownList($model->repeatArray) ?>

        <?= $form->field($model, 'changed')->dropDownList($model->changeArray) ?>

        <?= $form->field($model, 'device')->dropDownList($model->deviceArray) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>