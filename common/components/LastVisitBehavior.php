<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 22.11.2014
 * Time: 21:24
 */

namespace common\components;

use yii\base\Behavior;
use yii\console\Controller;

class LastVisitBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    public function beforeAction()
    {
        if (!\Yii::$app->user->isGuest) {

            $connection = \Yii::$app->db;

            $connection->createCommand()
                ->update('{{%users}}', ['last_visit' => \Yii::$app->formatter->asTimestamp(date_create())], ['id_user' => \Yii::$app->getUser()->getId()])
                ->execute();//$model->touch('lastVisit')
        }
        return true;
    }
}