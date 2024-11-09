<?php

use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'language' => 'uk-UA',
    'timeZone' => 'Europe/Kiev',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'homeUrl' => '/admin',

    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'gridviewKrajee' => [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ]
    ],
    'components' => [
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['admin'],
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\base\AssetBundle' => [
                    'bsDependencyEnabled' => false,
                ],
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false,
                ],
                'kartik\grid\GridViewAsset' => [
                    'bsDependencyEnabled' => false,
                ],
                'kartik\date\DatePickerAsset' => [
                    'bsDependencyEnabled' => false,
                ],
                // Добавьте другие виджеты kartik-v, если они используются
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',

            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => ['en-US', 'en', 'ru', 'uk'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
//                '<action:\w+>' => 'category/<action>'
//                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
            ],

        ],

    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except' => [
            'site/login', 'site/error', 'site/signup', 'site/verify-email',
            'site/resend-verification-email',
            'site/request-password-reset',
            'site/reset-password',
        ],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
