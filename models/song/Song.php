<?php

namespace app\models\song;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "{{%songs}}".
 *
 * @property string $id_song
 * @property string $name
 * @property string $year
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
            [['year'], 'safe'],
            [['template', 'sound', 'count_artists', 'original', 'version'], 'integer'],
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
            'count_artists'   => 'Число исполнителей в названии',
            'original'        => 'Оригинал',
            'version'         => 'Версии',
            'created'         => 'Создано',
            'id_created_user' => 'Кем создано',
            'updated'         => 'Обновлено',
            'id_updated_user' => 'Кем обновлено',
        ];
    }
}