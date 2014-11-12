<?php

namespace common\models\article;

use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\helpers\Inflector;
use common\models\User;

/**
 * Модель "Статьи", таблица - "{{%articles}}".
 *
 * @property integer $id_article
 * @property integer $id_category
 * @property string $title
 * @property string $alias
 * @property string $preview
 * @property string $text
 * @property integer $status
 * @property integer $publication
 * @property integer $end
 * @property integer $views
 * @property integer $created
 * @property integer $id_created_user
 * @property integer $updated
 * @property integer $id_updated_user
 */
class Article extends ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DELETED = 2;

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'slugAttribute' => 'alias',
                'value' => function($event) {
                    if (!empty($event->sender->alias))
                        return $event->sender->alias;
                    return Inflector::slug($event->sender->title);
                },
            ],
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
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'end',
                ],
                'value' => function ($event) {
                    $date = new \DateTime($event->sender->end);
                    return $date->format('U');
                },
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
        return '{{%articles}}';
    }

    public function rules()
    {
        return [
            [['id_category', 'title', 'text'], 'required'],
            [['id_category', 'status', 'publication', 'views'], 'integer'],//, 'end'
            [['preview', 'text'], 'string'],
            ['alias', 'unique'],
            ['end' , 'safe'],
            ['status', 'in', 'range' => [self::STATUS_NOT_PUBLISHED, self::STATUS_PUBLISHED, self::STATUS_DELETED]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_article'      => 'ID статьи',
            'id_category'     => 'Категория',
            'title'           => 'Название',
            'alias'           => 'Алиас',
            'preview'         => 'Превью',
            'text'            => 'Текст',
            'status'          => 'Статус',
            'publication'     => 'Дата публикации',
            'end'             => 'Дата завершения',
            'views'           => 'Просмотры',
            'created'         => 'Создано',
            'id_created_user' => 'Кем создано',
            'updated'         => 'Обновлено',
            'id_updated_user' => 'Кем обновлено',
        ];
    }

    public function getStatusArray() {
        return [
            self::STATUS_NOT_PUBLISHED => 'Не опубликовано',
            self::STATUS_PUBLISHED     => 'Опубликовано',
            self::STATUS_DELETED       => 'Удалено',
        ];
    }

    public function getStatusText() {
        return $this->statusArray[$this->status];
    }

    public function getStatusClass() {
        switch ($this->status) {
            case self::STATUS_NOT_PUBLISHED:
                return 'label-default';
                break;
            case self::STATUS_PUBLISHED:
                return 'label-success';
                break;
            case self::STATUS_DELETED:
                return 'label-danger';
                break;
            default: return '';
        }
    }

    public function getCategory() {
        return $this->hasOne(ArticleCategory::className(), ['id_category' => 'id_category']);
    }

    public function getCreatedUser() {
        return $this->hasOne(User::className(), ['id_user' => 'id_created_user']);
    }

    public function getUpdatedUser() {
        return $this->hasOne(User::className(), ['id_user' => 'id_updated_user']);
    }

    public function getComments() {
        return $this->hasMany(ArticleComment::className(), ['id_article' => 'id_article']);
    }

    public function getCommentsCount() {
        return $this->getComments()->count();
    }
}