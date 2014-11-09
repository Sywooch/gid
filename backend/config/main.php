<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'modules' => [],
    'components' => [
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
            //'suffix'          => ".html",
            'rules' => [
                //'' => 'site/index',
                //'<action>' => 'site/<action>',
                //'admin/article/<alias:[a-zA-Z0-9-]+>/'=>'admin/article/view',
                //'<controller:\w+>'                                 => '<controller>/index',
                '<controller:\w+>/<action:update|delete|view>/<id:\d+>' => '<controller>/<action>',
                // принудительное / в конце
            ]
        ],
    ],
    'params' => $params,
];