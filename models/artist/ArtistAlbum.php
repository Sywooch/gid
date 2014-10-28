<?php

namespace app\models\artist;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "artist_album".
 *
 * @property string $id_album
 * @property string $id_artist
 * @property integer $release_sequence
 * @property integer $role
 * @property string $id_add_artist
 * @property string $role_description
 */
class ArtistAlbum extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_album', 'id_artist', 'release_sequence', 'role'], 'required'],
            [['id_album', 'id_artist', 'release_sequence', 'role', 'id_add_artist'], 'integer'],
            [['role_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_album'         => 'Идентификатор альбома',
            'id_artist'        => 'Идентификатор артиста/группы',
            'release_sequence' => 'Очерёдность в названии релиза (0 - отсутствие)',
            'role'             => 'Роль человека в создании альбома',
            'id_add_artist'    => 'Имя артиста на данном релизе',
            'role_description' => 'Описание проделанной работы',
        ];
    }
}