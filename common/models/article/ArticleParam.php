<?php

namespace common\models\article;

use yii\db\ActiveRecord;
use common\models\param\ParameterUnique;

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
            [['id_article', 'id_param', 'value'], 'required'],
            [['id_article', 'id_param'], 'integer'],
            ['value', 'string', 'max' => 255]
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

    public function getParameterUnique() {

        return $this->hasOne(ParameterUnique::className(), ['id_param' => 'id_param'])
            //->where([
                //'name' => ['Мета-тег description'],
            //])
            ;
    }

    /*public function getParameterArray() {
        foreach ($this->ParameterUnique as $param)
            $array[] = [$param->id_param =>
        return [

        ]
    }*/
}