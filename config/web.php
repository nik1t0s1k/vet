<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'language'=>'ru-RU',
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru-RU', // Устанавливаем русскую локаль
            'dateFormat' => 'php:d F Y',
            'datetimeFormat' => 'php:d M Y H:i', // M вместо F для сокращенного месяца
            'timeFormat' => 'php:H:i',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '23124',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'veterinarians' => 'veterinarian/index',
                'profile' => 'profile/index',
                'profile/add-pet' => 'profile/add-pet',
                'medical/<pet_id:\d+>' => 'medical/index',
                'medical/add-record/<pet_id:\d+>' => 'medical/add-record',
                'services' => 'service/index',
                'service/<id:\d+>' => 'service/view',
                'order/create/<service_id:\d+>' => 'order/create',
                'orders' => 'order/index',
                'order/<id:\d+>' => 'order/view',
                'medical' => 'medical/index',
                'knowledge-base' => 'knowledge-base/index',
                'knowledge-base/<id:\d+>' => 'knowledge-base/view',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
