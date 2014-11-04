<?php

namespace app\models\song;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use app\components\AlbumSongBehavior;
use app\models\User;

/**
 * This is the model class for table "{{%songs}}".
 *
 * @property string $id_song
 * @property string $name
 * @property integer $year
 * @property integer $template
 * @property integer $sound
 * @property integer $count_artists
 * @property integer $original
 * @property integer $version
 * @property integer $created
 * @property integer $id_created_user
 * @property integer $updated
 * @property integer $id_updated_user
 */
class Song extends ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
                ]
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['id_created_user', 'id_updated_user'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'id_updated_user',
                ],
                'value' => \Yii::$app->user->id,
            ],
            AlbumSongBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%songs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'year', 'template', 'sound', 'count_artists', 'original', 'version'], 'required'],
            [['template', 'sound', 'count_artists', 'original', 'version', 'year'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_song'         => 'ID песни',
            'name'            => 'Название',
            'year'            => 'Год выпуска',
            'template'        => 'Шаблон для артистов',
            'sound'           => 'Звук',
            'count_artists'   => 'Число исполнителей',
            'original'        => 'Оригинал',
            'version'         => 'Версии',
            'created'         => 'Создано',
            'id_created_user' => 'Кем создано',
            'updated'         => 'Обновлено',
            'id_updated_user' => 'Кем обновлено',
        ];
    }

    public function getCreatedUser() {
        return $this->hasOne(User::className(), ['id_user' => 'id_created_user']);
    }

    public function getUpdatedUser() {
        return $this->hasOne(User::className(), ['id_user' => 'id_updated_user']);
    }

    public function getSoundText() {
        return $this->soundArray[$this->sound];
    }

    const ORIGINAL = 1;
    const ORIGINAL_AUTHOR = 2;
    const ORIGINAL_COVER = 3;
    const ORIGINAL_MASH_UP = 4;
    const ORIGINAL_BASED = 5;

    public function getOriginalArray() {
        return [
            self::ORIGINAL         => 'Оригинал',
            self::ORIGINAL_AUTHOR  => 'Авторская версия',
            self::ORIGINAL_COVER   => 'Кавер-версия',
            self::ORIGINAL_MASH_UP => 'Мэшап',
            self::ORIGINAL_BASED   => 'В основе другая композиция',
        ];
    }

    public function getOriginalText() {
        return $this->originalArray[$this->original];
    }

    const VERSION_FIRST = 1;
    const VERSION_SECOND = 2;

    public function getVersionArray() {
        return [
            self::VERSION_FIRST  => 'Первое',
            self::VERSION_SECOND => 'Версия',
        ];
    }

    public function getVersionText() {
        return $this->versionArray[$this->version];
    }


}