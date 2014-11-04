<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * @property string $pass
 * @property string $username
 * @property integer $id_user
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_ADMIN = 3;

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function attributeLabels()
    {
        return [
            'id_user'    => 'ID пользователя',
            'username'   => 'Логин',
            'email'      => 'Почта',
            'pass'       => 'Пароль-хэш',
            'role'       => 'Роль',
            'status'     => 'Статус',
            'gender'     => 'Пол',
            'birthday'   => 'Дата рождения',
            'created'    => 'Дата регистрации',
            'last_visit' => 'Дата последнего посещения',
            'updated'    => 'Дата обновления',
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
     * Поиск пользователя по логину или почте
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->where(['username' => $username])
            ->orWhere(['email' => $username])
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_user;
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

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" не реализовано.');
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
}