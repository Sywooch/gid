<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 04.11.2014
 * Time: 21:03
 */

namespace app\components;

use yii\base\Behavior;

class AlbumSongBehavior extends Behavior
{
    const SOUND_STUDIO = 1;
    const SOUND_LIVE = 2;

    public function getSoundArray() {
        return [
            self::SOUND_STUDIO => 'Студийный',
            self::SOUND_LIVE   => 'Концертный',
        ];
    }
}