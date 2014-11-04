<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\song\Song
 * @var $form yii\widgets\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Треки', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить трек';
    $this->params['breadcrumbs'][] = $this->title;
}
else {
    $this->title = 'Обновить трек: ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_song]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>
<div class="song">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="song-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'year')->textInput(['maxlength' => 4]) ?>

        <?= $form->field($model, 'template')->textInput() ?>

        <?= $form->field($model, 'sound')->dropDownList($model->soundArray)  ?>

        <?= $form->field($model, 'count_artists')->input('number') ?>

        <?= $form->field($model, 'original')->dropDownList($model->originalArray) ?>

        <?= $form->field($model, 'version')->dropDownList($model->versionArray) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>