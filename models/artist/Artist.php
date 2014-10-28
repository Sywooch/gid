<?php

namespace app\models\artist;

use yii\db\ActiveRecord;
use app\models\album\Album;
/**
 * This is the model class for table "artist".
 *
 * @property string $id_artist
 * @property string $name_artist
 * @property integer $type_artist
 * @property string $date_birth
 * @property string $date_death
 * @property string $birthplace
 * @property string $deathplace
 * @property string $resident
 * @property string $years_active
 */
class Artist extends ActiveRecord
{
    const HUMAN = 1;
    const BAND = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_artist', 'type_artist'], 'required'],
            [['type_artist', 'birthplace', 'deathplace', 'resident'], 'integer'],
            [['date_birth', 'date_death'], 'safe'],
            [['name_artist'], 'string', 'max' => 255],
            [['years_active'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_artist'    => 'ID артиста/группы',
            'name_artist'  => 'Оригинальное имя',
            'type_artist'  => 'Человек / Группа',
            'date_birth'   => $this->labels()[0],
            'date_death'   => $this->labels()[1],
            'birthplace'   => $this->labels()[2],
            'deathplace'   => 'Место смерти человека',
            'resident'     => 'Резиденция в настоящее время',
            'years_active' => 'Годы активности',
        ];
    }

    public static $typeArray = [
        self::HUMAN => 'Человек',
        self::BAND  => 'Группа',
    ];

    public function getTypeText() {
        return self::$typeArray[$this->type_artist];
    }

    public function labels() {
        return ($this->type_artist == self::HUMAN) ?
            ['Дата рождения', 'Дата смерти', 'Место рождения'] :
            ['Дата создания', 'Дата распада', 'Место формирования'];
    }

    public function getAlbums()
    {
        return $this->hasMany(Album::className(), ['id_album' => 'id_album'])
            ->viaTable(ArtistAlbum::tableName(), ['id_artist' => 'id_artist']);
    }
}