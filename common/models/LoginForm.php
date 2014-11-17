<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Форма входа
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username'   => 'Логин или email',
            'password'   => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    /**
     * Правило для проверки пароля
     *
     * @param string $attribute атрибут к которому прикреплен вывод ошибки
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверные логин (email) или пароль.');
            } elseif ($user && $user->status == User::STATUS_BANNED) {
                $this->addError('username', 'Ваш аккаунт временно забанен.');
            } elseif ($user && $user->status == User::STATUS_WAIT) {
                $this->addError('username', 'Ваш аккаунт не активирован.');
            }
        }
    }

    /**
     * Вход пользователя через ввода логина(email) и пароля
     *
     * @return boolean зависит от успешности входа
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Поиск пользователя по логину(email)
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}