<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class HomePageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        '/css/category-card.css?v=' . PROJECT_VERSION,
        '/css/block-posts.css?v=' . PROJECT_VERSION,
        '/css/block-product-columns.css?v=' . PROJECT_VERSION,
        '/css/block-features.css?v=' . PROJECT_VERSION,

    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
