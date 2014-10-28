<?php

namespace app\models\album;

use yii\db\ActiveRecord;
use app\models\artist\Artist;
use app\models\artist\ArtistAlbum;

/**
 * This is the model class for table "album".
 *
 * @property string $id_album
 * @property string $name_album
 * @property string $alt_name_album
 * @property string $released
 * @property string $recorded
 * @property string $year_album
 * @property string $length_album
 * @property integer $template
 * @property integer $size_disk
 * @property integer $disks
 * @property integer $number_album
 * @property integer $sound
 * @property integer $artists
 * @property integer $count_artists
 * @property integer $status_album
 * @property integer $repeated
 * @property integer $changed
 * @property integer $times
 * @property integer $dead
 * @property integer $ost
 * @property integer $device
 * @property string $meta_description
 */
class Album extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_album', 'year_album', 'length_album', 'template', 'size_disk', 'disks', 'number_album', 'sound', 'artists',
                'count_artists', 'status_album', 'repeated', 'changed', 'times', 'dead', 'ost', 'device', 'meta_description'], 'required'],
            [['released', 'year_album', 'length_album'], 'safe'],
            [['template', 'size_disk', 'disks', 'number_album', 'sound', 'artists', 'count_artists', 'status_album', 'repeated',
                'changed', 'times', 'dead', 'ost', 'device'], 'integer'],
            [['name_album', 'alt_name_album', 'recorded'], 'string', 'max' => 255],
            [['meta_description'], 'string', 'max' => 155]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_album'         => 'ID альбома',
            'name_album'       => 'Название альбома',
            'alt_name_album'   => 'Неофициальное название альбома',
            'released'         => 'Дата релиза альбома',
            'recorded'         => 'Период записи альбома',
            'year_album'       => 'Год',
            'length_album'     => 'Длительность всех композиций',
            'template'         => 'Шаблон для артистов',
            'size_disk'        => 'LP EP сингл или бокс-сет',
            'disks'            => 'Количество дисков',
            'number_album'     => 'Номерной(1) Неномерной(2)',
            'sound'            => 'Где был записан звук',
            'artists'          => 'Количество исполнителей в названии альбома',//по другому обозвать
            'count_artists'    => 'Количество исполнителей в названии альбома (число) 0-различные исполнители',
            'status_album'     => 'Статус альбома',
            'repeated'         => 'Повторы',
            'changed'          => 'Новый ли материал? Изменённый',
            'times'            => 'Важные временные особенности',
            'dead'             => 'Посмертный(2)',
            'ost'              => 'Саундтрек особенности',
            'device'           => 'Носитель информации',
            'meta_description' => 'Мета-тег description',
        ];
    }

    public function getArtist()
    {
        return $this->hasMany(Artist::className(), ['id_artist' => 'id_artist'])
            ->viaTable(ArtistAlbum::tableName(), ['id_album' => 'id_album'])
           // ->select('id_artist, name_artist, artist_album . release_sequence, artist_album . role')
            //->where(['<', 'role', 5])
            ;
    }

    public function getTitle()
    {
        return $this->artist;
    }

    /*public function getTitleArtist()
    {
        return $this->getArtist()->where(['<', 'role', 5]);
    }*/
}