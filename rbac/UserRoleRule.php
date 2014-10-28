<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 26.10.14
 * Time: 18:08
 */
namespace app\rbac;

use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use app\models\User;

class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        //Получаем массив пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if ($user) {
            $role = $user->level_user; //Значение из поля role базы данных, TODO level_user поменять на role

            if ($item->name === 'admin') {
                return $role == User::ROLE_ADMIN;
            } elseif ($item->name === 'moderator') {
                //moderator является потомком admin, который получает его права
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODERATOR;
            }
            elseif ($item->name === 'user') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODERATOR || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}