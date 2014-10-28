<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\artist\Artist */
/* @var $form yii\widgets\ActiveForm */


$this->params['breadcrumbs'][] = ['label' => 'Артисты', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить артиста/группу';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Обновить артиста: ' . ' ' . $model->name_artist;
    $this->params['breadcrumbs'][] = ['label' => $model->name_artist, 'url' => ['view', 'id' => $model->id_artist]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>
<div class="artist">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="artist-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name_artist')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'type_artist')->dropDownList($model::$typeArray) ?>

        <?= $form->field($model, 'date_birth')->textInput() ?>

        <?= $form->field($model, 'date_death')->textInput() ?>

        <?= $form->field($model, 'birthplace')->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'deathplace')->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'resident')->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'years_active')->textInput(['maxlength' => 40]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>