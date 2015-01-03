<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Europe/Moscow',
    'language' => 'ru',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class'          => 'yii\rbac\PhpManager',
            'defaultRoles'   => ['user', 'author', 'moderator', 'admin'],
            'itemFile'       => '@common/components/rbac/items.php',
            'assignmentFile' => '@common/components/rbac/assignments.php',
            'ruleFile'       => '@common/components/rbac/rules.php'
        ],
        'db' => [
            'class'       => 'yii\db\Connection',
            'dsn'         => 'mysql:host=localhost;dbname=lavrenop_gid',
            'username'    => 'lavrenop_gid',
            'password'    => 'sIEvTlAC',
            'charset'     => 'utf8',
            'tablePrefix' => 'jhh_',
        ],
        'mailer' => [
            'class'    => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
    'as beforeAction' => [
        'class' => '\common\components\LastVisitBehavior'
    ],
];