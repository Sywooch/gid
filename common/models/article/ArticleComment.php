<?php

namespace common\models\article;

use yii\db\ActiveRecord;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'id_article', 'id_user', 'status', 'created'], 'integer'],
            [['id_user', 'text', 'created'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'ID комментария',
            'id_parent'  => 'ID родительского комментария',
            'id_article' => 'ID статьи',
            'id_user'    => 'ID пользователя',
            'title'      => 'Заголовок',
            'text'       => 'Текст',
            'status'     => 'Статус',
            'created'    => 'Создано',
        ];
    }
}