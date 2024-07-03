<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ProductPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

//        '/css/product-page.css?v=' . PROJECT_VERSION,

        '/css/product__tabs.css?v=' . PROJECT_VERSION,
        '/css/product-gallery.css?v=' . PROJECT_VERSION,
        '/css/checkout.css?v=' . PROJECT_VERSION,
        '/css/typography.css?v=' . PROJECT_VERSION,
        '/css/product--layout--columnar.css?v=' . PROJECT_VERSION,
        '/vendor/photoswipe/photoswipe.css?v=' . PROJECT_VERSION,
        '/vendor/photoswipe/default-skin/default-skin.css?v=' . PROJECT_VERSION,
    ];
    public $js = [

        '/js/product-page.js?v=' . PROJECT_VERSION,

//        '/js/product-gallery.js?v=' . PROJECT_VERSION,
//        '/js/product-tabs.js?v=' . PROJECT_VERSION,
//        '/js/checkout-payment-methods.js?v=' . PROJECT_VERSION,

        '/vendor/photoswipe/photoswipe.min.js?v=' . PROJECT_VERSION,
        '/vendor/photoswipe/photoswipe-ui-default.min.js?v=' . PROJECT_VERSION,

    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
}
