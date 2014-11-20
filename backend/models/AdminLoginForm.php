<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 20.11.2014
 * Time: 15:41
 */

namespace backend\models;

use common\models\LoginForm;
use common\models\User;

class AdminLoginForm extends LoginForm
{
    private $_user = false;

    /**
     * Проверка на право доступа в админку
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        if (!\Yii::$app->user->can('dashboard', ['user' => $this->_user])) {
            $this->_user = null;
        }

        return $this->_user;
    }
}