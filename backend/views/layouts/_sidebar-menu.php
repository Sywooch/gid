<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 11.11.2014
 * Time: 15:54
 */

use yii\widgets\Menu;

echo Menu::widget([
    'items' => [
        ['label' => 'Консоль', 'url' => '/site/index'],
        ['label' => 'Статьи', 'url' => '#',
            'options' => [
                'class' => 'treeview'
            ],
            'items' => [
                ['label' => 'Статьи', 'url' => '/article/index'],
                ['label' => 'Категории', 'url' => '/article-category/index'],
                ['label' => 'Комментарии', 'url' => '/article-comment/index'],
            ]
        ],
        ['label' => 'Пользователи', 'url' => '/user/index'],


        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    ],
    'options' => [
        'class' => 'sidebar-menu'
    ],
    'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
]);