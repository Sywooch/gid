<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * @property string $pass
 * @property string $login
 * @property integer $id_user
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_ADMIN = 3;

    public static function tableName()
    {
        return 'users';
    }

    public function attributeLabels()
    {
        return [
            'id_user'     => 'Идентификатор пользователя',
            'login'       => 'Логин',
            'mail'        => 'Почта',
            'pass'        => 'Пароль',
            'date_reg'    => 'Дата регистрации',
            'last_visit'  => 'Дата последнего посещения',
            'status_user' => 'Статус 0-неактивирован 1-активирован 2-забанен',
            'gender'      => 'Пол 1-женщина 2-мужчина',
            'date_birth'  => 'Дата рождения',
            'level_user'  => 'Уровень доступа пользователя 1-простой 2-админ(автор)',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" не реализовано.');
    }

    /**
     * Поиск пользователя по логину или почте!!!
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find(['or', 'login' => $username, 'mail' => $username])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Валидация пароля
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->pass);
    }
}