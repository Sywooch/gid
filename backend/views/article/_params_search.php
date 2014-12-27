<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * @var $paramUnique common\models\param\ParameterUnique
 */

if (!empty($paramUnique)) {

    echo Html::dropDownList(
        'param-unique', null, ArrayHelper::map($paramUnique, 'id_param', 'name'),
        ['id' => 'param-unique']
    );

    echo Html::submitButton('Добавить параметр', ['class' => 'btn btn-primary btn-sm', 'id' => 'addParam']);
}