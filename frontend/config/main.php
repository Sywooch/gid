<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Музыкальный Гид',
    'homeUrl' => 'http://music-gid.ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'HVmHLd4EhsaskmJ8JfNnxU5Oh35fjzly',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'suffix'          => ".html",
            'rules' => [
                ['pattern' => 'rss', 'route' => 'xml/rss', 'suffix' => '.xml'],
                ''                                             => 'site/index',
                //'<controller:[a-zA-Z0-9-]+>'                   => '<controller>/index',
                '<action>'                                     => 'site/<action>',

                'article/add-comment'                          => 'article/add-comment',
                'article/<alias:[a-zA-Z0-9-]+>'                => 'article/view',

                '<controller:[A-Za-z0-9-]+>/<action>/<id:\d+>' => '<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
];