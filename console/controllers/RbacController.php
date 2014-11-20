<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 20.11.2014
 * Time: 14:37
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;
use yii\helpers\Console;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $dashboard = $auth->createPermission('dashboard');//Права для доступа к админке
        $dashboard->description = 'Админ панель';
        $auth->add($dashboard);

        //Включаем наш обработчик
        $rule = new UserRoleRule();
        $auth->add($rule);

        $user = $auth->createRole('user');//Добавляем роли
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $author = $auth->createRole('author');
        $author->description = 'Автор';
        $author->ruleName = $rule->name;
        $auth->add($author);

        $auth->addChild($author, $user);//Добавляем потомков
        $auth->addChild($author, $dashboard);

        $moder = $auth->createRole('moderator');
        $moder->description = 'Модератор';
        $moder->ruleName = $rule->name;
        $auth->add($moder);
        $auth->addChild($moder, $author);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moder);

        Console::output('Success! RBAC roles has been added.');
    }
}