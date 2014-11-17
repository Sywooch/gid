<?php

namespace common\models\article;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article_params}}".
 *
 * @property integer $id_article
 * @property integer $id_param
 * @property string $value
 */
class ArticleParam extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%article_params}}';
    }

    public function rules()
    {
        return [
            [['id_article', 'id_param'], 'required'],
            [['id_article', 'id_param'], 'integer'],
            [['value'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_article' => 'ID статьи',
            'id_param'   => 'ID параметра',
            'value'      => 'Значение параметра',
        ];
    }
}