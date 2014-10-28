<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 26.10.14
 * Time: 18:14
 */
namespace app\commands;

use yii\console\Controller;
use app\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll(); //удаляем старые данные

        //Создадим для примера права для доступа к "О нас"
        $about = $auth->createPermission('about');
        $about->description = 'О нас';
        $auth->add($about);

        //Включаем наш обработчик
        $rule = new UserRoleRule();
        $auth->add($rule);

        //Добавляем роли
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $moder = $auth->createRole('moderator');
        $moder->description = 'Модератор';
        $moder->ruleName = $rule->name;
        $auth->add($moder);

        //Добавляем потомков
        $auth->addChild($moder, $user);
        $auth->addChild($moder, $about);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;

        $auth->add($admin);
        $auth->addChild($admin, $moder);
    }
}