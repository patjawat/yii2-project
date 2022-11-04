<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$modules = require __DIR__ . '/add_modules.php';


$config = [
    'id' => 'basic',
    'defaultRoute' =>'bookingcar',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => $modules,
    'components' => [
        'thaiFormatter'=>[
        'class'=>'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                'sourceLanguage' => 'en',
                'fileMap' => [
                    //'main' => 'main.php',
                ],
            ],
        ],
    ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pitX8eaH4IKLXLsGPK8R1e9fDyX4NVeP',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => false,
            'enableSession' => true,
            // ตั้งเวลา timeout 1 ชั่วโมง 60 วินาที * 60 นาที
            // 'authTimeout' => 12960000,
        ],
        'authManager' => [
            // 'class' => 'dektrium\rbac\components\DbManager',
            'class' => 'yii\rbac\PhpManager'
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
            ],
        ],
    ],
    
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
            // 'site/*',
            'usermanager/*',
            'uploads/upload-ajax',
            'datecontrol/parse/convert',
            'soc/events/upload-ajax',
            'gii/*',
            'line/*'
            // 'api/*'
        ],
    ],
    'controllerMap' => [
        'file' => 'mdm\\upload\\FileController', // use to show or download file
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];
}

return $config;
