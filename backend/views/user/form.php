<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 * @var $form yii\bootstrap\ActiveForm
 */

$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];

if ($model->isNewRecord) {
    $this->title = 'Добавить пользователя';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = 'Обновить пользователя: ' . $model->username;
    $this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id_user]];
    $this->params['breadcrumbs'][] = 'Обновить';
}
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'role')->dropDownList($model->roleArray) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray) ?>

    <?php ActiveForm::end(); ?>

</div>