<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use frontend\assets\AppAsset;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 * @var $form yii\bootstrap\ActiveForm
 */

$this->title = 'Обновить профиль: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'username' => $model->username]];
$this->params['breadcrumbs'][] = 'Обновить';

$assets = Yii::$app->assetManager->publish('@frontend/views/assets/js');
$bundle = AppAsset::register($this);
$bundle->js[] =  Yii::$app->homeUrl . $assets[1] . '/upload_avatar.js';

$this->registerCss("
    .avatar {
        max-height: 250px;
    }
");

$model->birthday = ($model->birthday != '0000-00-00') ? Yii::$app->formatter->asDateTime($model->birthday, 'php:d.m.Y') : '';
?>

<div class="user-form row">

    <div class="col-sm-3">

        <div class="text-center">

            <img src="<?= $model->avatarArray['src'] . '?' . rand(1, 99)?>" alt="<?= $model->avatarArray['alt']?>" class="img-thumbnail avatar">

        </div>

        <h1><?= Html::encode($model->username) ?></h1>

        <? if ($model->online) { ?>

            <p><span class="label label-success">Онлайн</span></p>

        <? } ?>

        <p><?= Html::a('Удалить профиль', ['delete', 'username' => $model->username], ['data-method' => "post", 'class' => 'btn btn-danger btn-sm btn-block']) ?></p>

    </div>

    <div class="col-sm-9">

        <?php $form = ActiveForm::begin([
            'layout'  => 'horizontal',
            'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                ],
            ],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary btn-sm']) ?>
        </div>

        <?= $form->field($model, 'gender')->dropDownList($model->genderArray, ['prompt' => '']) ?>

        <?= $form->field($model, 'birthday')->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'size' => 'xs',
            'template' => "{button}{reset}{input}",
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy',
                'todayBtn' => true,
                'pickerPosition' => "bottom-right",
            ]
        ]) ?>

        <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*']) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>