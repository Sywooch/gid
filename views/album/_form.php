<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\album\Album */
/* @var $form yii\widgets\ActiveForm */


$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Create Album';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Update Album: ' . ' ' . $model->name_album;
    $this->params['breadcrumbs'][] = ['label' => $model->name_album, 'url' => ['view', 'id' => $model->id_album]];
    $this->params['breadcrumbs'][] = 'Update';
}

?>
<div class="album">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="album-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name_album')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'alt_name_album')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'released')->textInput() ?>

        <?= $form->field($model, 'recorded')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'year_album')->textInput(['maxlength' => 4]) ?>

        <?= $form->field($model, 'length_album')->textInput() ?>

        <?= $form->field($model, 'template')->textInput() ?>

        <?= $form->field($model, 'size_disk')->textInput() ?>

        <?= $form->field($model, 'disks')->textInput() ?>

        <?= $form->field($model, 'number_album')->textInput() ?>

        <?= $form->field($model, 'sound')->textInput() ?>

        <?= $form->field($model, 'artists')->textInput() ?>

        <?= $form->field($model, 'count_artists')->textInput() ?>

        <?= $form->field($model, 'status_album')->textInput() ?>

        <?= $form->field($model, 'repeated')->textInput() ?>

        <?= $form->field($model, 'changed')->textInput() ?>

        <?= $form->field($model, 'times')->textInput() ?>

        <?= $form->field($model, 'dead')->textInput() ?>

        <?= $form->field($model, 'ost')->textInput() ?>

        <?= $form->field($model, 'device')->textInput() ?>

        <?= $form->field($model, 'meta_description')->textInput(['maxlength' => 155]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>