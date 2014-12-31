<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\param\ParameterUnique
 * @var $form yii\widgets\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Параметры (уник)', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить параметр';
    $this->params['breadcrumbs'][] = $this->title;
}
else {
    $this->title = 'Обновить параметр: ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_param]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>

<div class="parameter-unique-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_param')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>