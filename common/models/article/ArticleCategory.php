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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'name'], 'required'],
            [['id_category', 'id_parent'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'ID категории',
            'name'        => 'Название',
            'id_parent'   => 'ID родительской категории',
        ];
    }
}