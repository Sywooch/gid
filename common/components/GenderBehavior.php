<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 23.11.2014
 * Time: 19:37
 */

namespace common\components;

use yii\base\Behavior;

class GenderBehavior extends Behavior
{
    const GENDER_MAN = 0;
    const GENDER_WOMAN = 1;

    public function getGenderArray() {
        return [
            self::GENDER_MAN   => 'Мужской',
            self::GENDER_WOMAN => 'Женский',
        ];
    }
}