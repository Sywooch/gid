<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Форма регистрации
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email'], 'filter', 'filter' => 'trim'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот логин уже занят.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email уже занят.'],

            ['password', 'string', 'min' => 8],
            ['password', 'samePasswordAndUsername'],
            //['password', 'match', 'pattern' => '\d+\D+i'],//TODO

            ['verifyCode', 'captcha'],
        ];
    }

    // Пароль совпадает с логином
    public function samePasswordAndUsername()
    {
        if ($this->password === $this->username)
            $this->addError('password', 'Пароль не должен совпадать с логином');
    }

    /**
     * Регистрация пользователя
     *
     * @return User|null возвращаем сохранённую модель или null в случае ошибки
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            if ($user->save()) {
                Yii::$app->mailer->compose('confirmEmail', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Подтверждение регистрации на music-gid.ru')
                    ->send();
            }

            return $user;
        }

        return null;
    }
}