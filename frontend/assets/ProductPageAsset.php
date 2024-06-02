<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ProductPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        '/css/product__tabs.css?v=' . PROJECT_VERSION,
        '/css/product-gallery.css?v=' . PROJECT_VERSION,
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
