<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage'=>'en_US',
    'language'=>'ru',
    'charset'=>'utf-8',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        // 'comment' => [
        //     'class' => 'yii2mod\comments\Module',
        // ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fm3HJ85izNTm7_4AxZwFaZcAzjUrhR0F',
            // 'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['auth/login'], //переопределили 'site/login'(по умолчанию)
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'medium',
        ], 
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
    // $config['modules']['gii'] = [
    //     'class' => 'yii\gii\Module',
    //     // uncomment the following to add your IP if you are not connecting from localhost.
    //     //'allowedIPs' => ['127.0.0.1', '::1'],
    // ];
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'class' => 'yii\gii\Module',
        'generators' => [ //here
        'crud' => [ // generator name
        'class' => 'yii\gii\generators\crud\Generator', // generator class
        'templates' => [ //setting for out templates
        'custom' => '@app/vendor/yiisoft/yii2-gii/generators/crud/custom', // template name => path to template
        ]
        ]
        ],
    ];
}

return $config;
