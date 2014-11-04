<?php

namespace app\models\album;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use app\models\User;

/**
 * This is the model class for table "{{%albums}}".
 *
 * @property integer $id_album
 * @property string $name
 * @property string $released
 * @property integer $year
 * @property string $length
 * @property integer $template
 * @property integer $type
 * @property integer $size
 * @property integer $sound
 * @property integer $count_artists
 * @property integer $status
 * @property integer $repeated
 * @property integer $changed
 * @property integer $device
 * @property integer $created
 * @property integer $id_created_user
 * @property integer $updated
 * @property integer $id_updated_user
 */
class Album extends ActiveRecord
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
        ];
    }

    public static function tableName()
    {
        return '{{%albums}}';
    }

    public function rules()
    {
        return [
            [['name', 'year', 'length', 'template', 'type', 'size', 'sound', 'count_artists', 'status', 'repeated', 'changed', 'device'], 'required'],
            [['released', 'length'], 'safe'],
            [['template', 'type', 'size', 'sound', 'count_artists', 'status', 'repeated', 'changed', 'device', 'year'], 'integer'],
            ['name', 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_album'        => 'ID альбома',
            'name'            => 'Официальное название',
            'released'        => 'Дата релиза',
            'year'            => 'Год выпуска',
            'length'          => 'Длительность композиций',
            'template'        => 'Шаблон для артистов',
            'type'            => 'Тип',
            'device'          => 'Носитель',
            'size'            => 'Количество дисков',
            'sound'           => 'Звук',
            'count_artists'   => 'Число исполнителей',
            'status'          => 'Статус',
            'repeated'        => 'Повторы',
            'changed'         => 'Изменения',
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

    //TODO подумать о примесях для звучания
    const SOUND_STUDIO = 1;
    const SOUND_LIVE = 2;

    public function getSoundArray() {
        return [
            self::SOUND_STUDIO => 'Студийный',
            self::SOUND_LIVE   => 'Концертный',
        ];
    }

    public function getSoundText() {
        return $this->soundArray[$this->sound];
    }

    const REPEAT_NOT = 1;
    const REPEAT_REISSUE = 2;
    const REPEAT_COMPILATION = 3;
    const REPEAT_COMPILATION_RARITIES = 4;

    public function getRepeatArray() {
        return [
            self::REPEAT_NOT                  => 'Ранее неизданный материал',
            self::REPEAT_REISSUE              => 'Переиздание',
            self::REPEAT_COMPILATION          => 'Сборник',
            self::REPEAT_COMPILATION_RARITIES => 'Сборник редких записей и бисайдов',
        ];
    }

    public function getRepeatText() {
        return $this->repeatArray[$this->repeated];
    }

    const CHANGE_NOT = 1;
    const CHANGE_REMAKE = 2;
    const CHANGE_COVER = 3;
    const CHANGE_REMIX = 4;
    const CHANGE_DJ_MIX = 5;
    const CHANGE_MIXTAPE = 6;
    const CHANGE_TRIBUTE = 7;

    public function getChangeArray() {
        return [
            self::CHANGE_NOT      => 'Новый материал',
            self::CHANGE_REMAKE   => 'Ремейк',
            self::CHANGE_COVER    => 'Кавер',
            self::CHANGE_REMIX    => 'Ремикс',
            self::CHANGE_DJ_MIX   => 'DJ микс',
            self::CHANGE_MIXTAPE  => 'Микстейп',
            self::CHANGE_TRIBUTE  => 'Трибьют',
        ];
    }

    public function getChangeText() {
        return $this->changeArray[$this->changed];
    }

    const DEVICE_VINYL_LP_12 = 1;
    const DEVICE_VINYL_LP_10 = 2;
    const DEVICE_VINYL_MAXI_SINGLE = 3;
    const DEVICE_VINYL_10 = 4;
    const DEVICE_VINYL_SINGLE = 5;
    const DEVICE_CASSETTE = 6;
    const DEVICE_VHS = 7;
    const DEVICE_CD = 8;
    const DEVICE_DVD = 9;
    const DEVICE_DIGITAL = 10;

    public function getDeviceArray() {
        return [
            self::DEVICE_VINYL_LP_12       => 'Винил LP 12″ (33⅓ об/мин)',//45 min Грампластинка "Гигант"
            self::DEVICE_VINYL_LP_10       => 'Винил LP 10″ (33⅓ об/мин)',//33 min Грампластинка "Гранд"
            self::DEVICE_VINYL_MAXI_SINGLE => 'Винил 12″ (45 об/мин)',
            self::DEVICE_VINYL_10          => 'Винил 10″ (78 об/мин)',
            self::DEVICE_VINYL_SINGLE      => 'Винил 7″ (45 об/мин)',
            self::DEVICE_CASSETTE          => 'Компакт-кассета',
            self::DEVICE_VHS               => 'VHS',
            self::DEVICE_CD                => 'CD',
            self::DEVICE_DVD               => 'DVD',
            self::DEVICE_DIGITAL           => 'Цифровая дистрибуция',
        ];
    }

    public function getDeviceText() {
        return $this->deviceArray[$this->device];
    }

    const TYPE_LP = 1;
    const TYPE_MINI_LP = 2;
    const TYPE_EP = 3;
    const TYPE_SINGLE = 4;
    const TYPE_BOX = 5;

    public function getTypeArray() {
        return [
            self::TYPE_LP      => 'Альбом',
            self::TYPE_MINI_LP => 'Мини-альбом (mini-LP)',
            self::TYPE_EP      => 'Мини-альбом',
            self::TYPE_SINGLE  => 'Сингл',
            self::TYPE_BOX     => 'Бокс-сет',
        ];
    }

    public function getTypeText() {
        return $this->typeArray[$this->type];
    }

    const STATUS_PROGRAM = 1;
    const STATUS_NOT_OFFICIAL = 2;
    const STATUS_DEMO = 3;
    const STATUS_BOOTLEG = 4;
    const STATUS_PROMO = 5;
    const STATUS_SAMPLER = 6;
    const STATUS_OUTTAKE = 7;
    const STATUS_UNRELEASED = 8;
    const STATUS_COMING = 9;

    public function getStatusArray() {
        return [
            self::STATUS_PROGRAM      => 'Программный',
            self::STATUS_NOT_OFFICIAL => 'Неофициальный',
            self::STATUS_DEMO         => 'Демо',
            self::STATUS_BOOTLEG      => 'Бутлег',
            self::STATUS_PROMO        => 'Промо',
            self::STATUS_SAMPLER      => 'Сэмплер',
            self::STATUS_OUTTAKE      => 'Ауттеки',
            self::STATUS_UNRELEASED   => 'Неизданный',
            self::STATUS_COMING       => 'Готовящийся к выходу',
        ];
    }

    public function getStatusText() {
        return $this->statusArray[$this->status];
    }
}