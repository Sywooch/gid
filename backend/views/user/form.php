<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 * @var $form yii\widgets\ActiveForm
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

    <?= $form->field($model, 'role')->dropDownList($model->roleArray) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>