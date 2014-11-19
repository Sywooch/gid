<?php

namespace common\models\article;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\User;

/**
 * This is the model class for table "{{%article_comments}}".
 *
 * @property string $id_comment
 * @property string $id_parent
 * @property integer $id_article
 * @property integer $id_user
 * @property string $title
 * @property string $text
 * @property integer $status
 * @property integer $created
 */
class ArticleComment extends ActiveRecord
{
    const STATUS_BANNED = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'id_user',
                ],
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%article_comments}}';
    }

    public function rules()
    {
        return [
            [['id_parent', 'id_article', 'id_user', 'status', 'created'], 'integer'],
            ['text', 'string'],
            ['status', 'in', 'range' => array_keys($this->statusArray)],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_comment' => 'ID комментария',
            'id_parent'  => 'Родительский комментарий',
            'id_article' => 'Статья',
            'id_user'    => 'Пользователь',
            'title'      => 'Заголовок',
            'text'       => 'Текст',
            'status'     => 'Статус',
            'created'    => 'Создано',
        ];
    }

    public function getStatusArray() {
        return [
            self::STATUS_BANNED => 'Забанен',
            self::STATUS_ACTIVE => 'Активен',
        ];
    }

    public function getStatusName() {
        return $this->statusArray[$this->status];
    }

    public function getStatusClass() {
        switch ($this->status) {
            case self::STATUS_BANNED:
                return 'label-danger';
                break;
            case self::STATUS_ACTIVE:
                return 'label-success';
                break;
            default: return '';
        }
    }

    public function getStatusText() {
        return "<span class='label " . $this->statusClass . "'>" . $this->statusName . '</span>';
    }

    public function getParentComment()
    {
        return $this->hasOne(ArticleComment::className(), ['id_comment' => 'id_parent']);
    }

    public function getChildComments()
    {
        return $this->hasMany(ArticleComment::className(), ['id_parent' => 'id_comment']);
    }

    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id_article' => 'id_article']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id_user' => 'id_user']);
    }
}