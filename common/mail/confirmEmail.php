<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $user common\models\User
 */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'token' => $user->email_confirm_token]);
?>

<p>Здравствуйте, спасибо за регистрацию на music-gid.ru</p>

<p>Ваш логин: <b><?= Html::encode($user->username) ?></b></p>

<p>Для активации аккаунта пройдите по ссылке:</p>

<p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>

<p>Данное письмо сгенерировано автоматически, отвечать на него не нужно.</p>

<p>Если Вы не регистрировались на нашем сайте, то просто удалите это письмо.</p>

<p>С уважением, Администрация music-gid.ru</p>