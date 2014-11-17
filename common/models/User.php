<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Модель "Пользователь"
 *
 * @property integer $id_user
 * @property string $username
 * @property string $email
 * @property string $pass
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $gender
 * @property integer $created
 * @property integer $updated
 * @property string $birthday
 * @property integer $last_visit
 * @property string $email_confirm_token
 * @property mixed statusArray
 * @property mixed statusClass
 * @property mixed statusName
 * @property mixed roleArray
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;
    const STATUS_DELETED = 3;
    const ROLE_USER = 1;
    const ROLE_MODERATOR = 2;
    const ROLE_ADMIN = 3;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function attributeLabels()
    {
        return [
            'id_user'              => 'ID пользователя',
            'username'             => 'Логин',
            'email'                => 'Почта',
            'pass'                 => 'Пароль-хэш',
            'role'                 => 'Роль',
            'status'               => 'Статус',
            'gender'               => 'Пол',
            'birthday'             => 'Дата рождения',
            'created'              => 'Дата регистрации',
            'last_visit'           => 'Дата последнего посещения',
            'updated'              => 'Дата обновления',
            'auth_key'             => 'Ключ аутентификации',
            'email_confirm_token'  => 'Токен подтверждения почты',
            'password_reset_token' => 'Токен нового пароля',
        ];
    }

    public function getStatusArray() {
        return [
            self::STATUS_WAIT    => 'Не активирован',
            self::STATUS_ACTIVE  => 'Активен',
            self::STATUS_BANNED  => 'Забанен',
            self::STATUS_DELETED => 'Удален',
        ];
    }

    public function getStatusName() {
        return $this->statusArray[$this->status];
    }

    public function getStatusClass() {
        switch ($this->status) {
            case self::STATUS_DELETED:
                return 'label-danger';
                break;
            case self::STATUS_ACTIVE:
                return 'label-success';
                break;
            case self::STATUS_BANNED:
                return 'label-warning';
                break;
            default: return '';
        }
    }

    public function getStatusText() {
        return "<span class='label " . $this->statusClass . "'>" . $this->statusName . '</span>';
    }

    public function getRoleArray() {
        return [
            self::ROLE_USER      => 'Пользователь',
            self::ROLE_MODERATOR => 'Модератор',
            self::ROLE_ADMIN     => 'Администратор',
        ];
    }

    public function getRoleName() {
        return $this->roleArray[$this->role];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_WAIT],
            ['status', 'in', 'range' => array_keys($this->statusArray)],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => array_keys($this->roleArray)],
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id_user' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" не реализовано.');
    }

    /**
     * Поиск пользователя по логину или email
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->where(['username' => $username])
            ->orWhere(['email' => $username])
            ->andWhere(['status' => self::STATUS_ACTIVE])
            ->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status'               => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Валидация пароля
     *
     * @param string $password строка для валидации
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->pass);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->pass = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }
}