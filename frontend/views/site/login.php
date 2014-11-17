<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $form yii\bootstrap\ActiveForm
 * @var $model \common\models\LoginForm
 */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните все поля для входа на сайт:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form'
            ]); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Забыли пароль?', ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>