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
    public $key;// Скрытое поле для робота

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
        ];
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
            //$user->generateAuthKey();
            $user->save();
            return $user;
        }

        return null;
    }
}