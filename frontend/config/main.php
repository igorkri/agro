<?php
define('PROJECT_VERSION', 41);

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'devicedetect'],
    'layout' => 'shop',
    'name' => 'AgroPro',
    'language' => 'uk-UA',
    'timeZone' => 'Europe/Kiev',
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => '/site',
    'components' => [
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ],
        'metamaster' => [
            'class' => 'floor12\metamaster\MetaMaster',
            'siteName' => 'AgroPro.org.ua',
            'defaultImage' => '/images/logos/meta_logo.jpg',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'showScriptName' => false,
            // 'enableStrictParsing' => false,
            'rules' => [
                '/' => '/site/index',

                'catalog' => 'category/list',
                'catalog/<slug:[\w+-]*\w+>' => 'category/children',
                'product-list/<slug:[\w+-]*\w+>' => 'category/catalog',
                'auxiliary-product-list/<slug:[\w+-]*\w+>' => 'category/auxiliary-catalog',

                'product/<slug:[\w+-]*\w+>' => 'product/view',
                'post/<slug:[\w+-]*\w+>' => 'post/view',
                'tag/<id:\d+>' => 'tag/view',
                'about' => 'about/view',
                'delivery' => 'delivery/view',
                'special' => 'special/view',
                'contact' => 'contact/view',
                'blogs' => 'blogs/view',

                [
                    'pattern' => 'sitemap',
                    'route' => 'site/sitemap',
                    'suffix' => '.xml'
                ],
            ],
        ],
    ],
    'params' => $params,
];
