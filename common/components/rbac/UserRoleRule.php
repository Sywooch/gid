<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 20.11.2014
 * Time: 14:27
 */

namespace common\components\rbac;

use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;

class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if ($user) {
            $role = $user->role;
            if ($item->name === 'admin') {
                return $role == User::ROLE_ADMIN;
            }
            elseif ($item->name === 'moderator') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODERATOR;
            }
            elseif ($item->name === 'author') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODERATOR || $role == User::ROLE_AUTHOR;
            }
            elseif ($item->name === 'user') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_MODERATOR || $role == User::ROLE_AUTHOR || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}