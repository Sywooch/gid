<?php

namespace common\models\param;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%params_unique}}".
 *
 * @property integer $id_param
 * @property string $name
 */
class ParameterUnique extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%params_unique}}';
    }

    public function rules()
    {
        return [
            [['id_param', 'name'], 'required'],
            [['id_param'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_param' => 'ID параметра',
            'name'     => 'Название параметра',
        ];
    }
}