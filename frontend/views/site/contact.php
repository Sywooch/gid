<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var $this yii\web\View
 * @var $form yii\bootstrap\ActiveForm
 * @var $model \frontend\models\ContactForm
 */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Если Вы нашли ошибку или у Вас есть вопросы, замечания или предложения, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form'
            ]); ?>

            <?php if (Yii::$app->user->isGuest) { ?>

                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'email')->input('email') ?>

            <?php } ?>

            <?= $form->field($model, 'subject', [
                'wrapperOptions' => ['class' => 'col-sm-2'],//TODO
            ])->dropDownList($model->subjectArray) ?>

            <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

            <?= $form->field($model, 'url')->input('url', ['placeholder' => 'Ссылка на страницу сайта']) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ])->label(false)?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>