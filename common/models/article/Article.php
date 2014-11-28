<?php

namespace common\models\article;

use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
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
 * @property boolean $active
 */
class Article extends ActiveRecord
{
    const STATUS_NOT_PUBLISHED = 0;
    const STATUS_PUBLISHED = 1;
    const OPTION_ACTIVE = true;
    const OPTION_DELETED = false;

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
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'id_created_user',
                'updatedByAttribute' => 'id_updated_user',
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'end',
                ],
                'value' => function ($event) {
                    if (!empty($event->sender->end)) {
                        $date = new \DateTime($event->sender->end);
                        return $date->format('U');
                    }
                    else return null;
                },
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'publication',
                ],
                'value' => function ($event) {
                    if (!empty($event->sender->publication)) {
                        return \Yii::$app->formatter->asTimestamp($event->sender->publication);
                    }
                    else return \Yii::$app->formatter->asTimestamp(date_create());
                },
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
            [['id_category', 'status'], 'integer'],//'publication', 'end'
            [['preview', 'text', 'alias'], 'string'],
            ['alias', 'unique'],
            [['publication', 'end'] , 'safe'],
            ['status', 'in', 'range' => array_keys($this->statusArray)],
            ['active', 'boolean'],
            ['image', 'url'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_article'      => 'ID статьи',
            'id_category'     => 'Категория',
            'title'           => 'Название',
            'alias'           => 'Алиас',
            'image'           => 'Главное изображение',
            'preview'         => 'Превью',
            'text'            => 'Текст',
            'status'          => 'Статус',
            'publication'     => 'Дата публикации',
            'end'             => 'Дата завершения',
            'views'           => 'Просмотры',
            'created'         => 'Создано',
            'id_created_user' => 'Автор',
            'updated'         => 'Обновлено',
            'id_updated_user' => 'Кем обновлено',
            'active'          => 'Активно',
        ];
    }

    public function getStatusArray() {
        return [
            self::STATUS_NOT_PUBLISHED => 'Не опубликовано',
            self::STATUS_PUBLISHED     => 'Опубликовано',
            //self::STATUS_DELETED       => 'Удалено',
        ];
    }

    public function getStatusName() {
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
/*            case self::STATUS_DELETED:
                return 'label-danger';
                break;*/
            default: return '';
        }
    }

    public function getStatusText() {
        return "<span class='label " . $this->statusClass . "'>" . $this->statusName . '</span>';
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

    public function getParams() {
        return $this->hasMany(ArticleParam::className(), ['id_article' => 'id_article']);
    }

    public function getCommentsCount() {
        return $this->getComments()->count();
    }
}