<?php
use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $user common\models\User
*/

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

<p>Здравствуйте, <?= Html::encode($user->username) ?>,</p>

<p>Пройдите по ссылке, чтобы сменить пароль:</p>

<p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>