<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $url;
    public $subject;
    public $body;
    public $verifyCode;

    public function getSubjectArray() {
        return [
            0 => 'Информация на сайте',
            1 => 'Ошибка в работе сайта',
            2 => 'Ваши предложения',
            3 => 'Другое',
        ];
    }

    public function getSubjectName() {
        return $this->subjectArray[$this->subject];
    }

    public function rules()
    {
        return [
            [['subject', 'body'], 'required'],
            [['name', 'email'], 'required', 'when' => function() {
                return Yii::$app->user->isGuest;
            }],
            ['email', 'email'],
            ['url', 'url'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'    => 'Ваше имя',
            'subject' => 'Тема',
            'body'    => 'Текст',
            'url'     => 'Ссылка',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom((Yii::$app->user->isGuest) ? [$this->email => $this->name] : [Yii::$app->user->identity->email => Yii::$app->user->identity->username])
            ->setSubject($this->subjectName)
            ->setTextBody($this->body . $this->url)//TODO
            ->send();
    }
}