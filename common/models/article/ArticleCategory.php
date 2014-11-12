<?php

namespace common\models\article;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article_category}}".
 *
 * @property integer $id_category
 * @property string $name
 * @property integer $id_parent
 */
class ArticleCategory extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['id_parent', 'integer'],
            ['name', 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_category' => 'ID категории',
            'name'        => 'Название',
            'id_parent'   => 'Родительская категория',
        ];
    }

    public function getParentCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id_category' => 'id_parent']);
    }
}