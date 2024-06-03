<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class CategoryCatalogPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        '/css/filter.css?v=' . PROJECT_VERSION,
        '/css/filters-button.css?v=' . PROJECT_VERSION,
        '/css/nouislider.css?v=' . PROJECT_VERSION,
    ];
    public $js = [

        '/vendor/nouislider/nouislider.min.js?v=' . PROJECT_VERSION,

    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
