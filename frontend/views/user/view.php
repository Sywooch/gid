<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 */

$this->registerCss("
    .avatar {
        max-height: 250px;
    }
");

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view row">

    <div class="col-sm-3">

        <div class="text-center">

            <img src="<?= $model->avatarArray['src'] . '?' . rand(1, 99)?>" alt="<?= $model->avatarArray['alt']?>" class="img-thumbnail avatar">

        </div>

        <h1><?= Html::encode($this->title) ?></h1>

        <? if ($model->online) { ?>

            <p><span class="label label-success">Онлайн</span></p>

        <? } ?>


        <? if ($model->id_user == Yii::$app->user->identity->id) { ?>

            <p>
                <?= Html::a('Обновить профиль', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary btn-sm  btn-block']) ?>
                <?= Html::a('Удалить профиль', ['delete', 'id' => $model->id_user], ['data' => [
                    'confirm' => 'Вы хотите удалить профиль?',
                    'method' => 'post',
                ],
                'class' => 'btn btn-danger btn-sm  btn-block']) ?>
            </p>

        <? } ?>

    </div>

    <div class="col-sm-9">

        <p><b>Регистрация: </b><?= \Yii::$app->formatter->asDateTime($model->created) ?></p>

        <? if (!$model->online) { ?>

            <p><b>Последний визит: </b><?= \Yii::$app->formatter->asDateTime($model->last_visit)?></p>

        <? } ?>

        <? if (isset($model->genderName)) { ?>

            <p><b>Пол: </b><?= $model->genderName?></p>

        <? } ?>

        <? if (($model->birthday != '0000-00-00')) { ?>

            <p><b>День рождения: </b><?= \Yii::$app->formatter->asDate($model->birthday) ?></p>

        <? } ?>

    </div>

</div>