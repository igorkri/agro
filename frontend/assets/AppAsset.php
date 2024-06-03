<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        '/vendor/owl-carousel/assets/owl.carousel.min.css?v=' . PROJECT_VERSION,

        '/vendor/photoswipe/photoswipe.css?v=' . PROJECT_VERSION,

        '/vendor/photoswipe/default-skin/default-skin.css?v=' . PROJECT_VERSION,

        '/css/style.css?v=' . PROJECT_VERSION,

        '/vendor/fontawesome/css/all.min.css?v=' . PROJECT_VERSION,

    ];
    public $js = [

        '/vendor/bootstrap/js/bootstrap.bundle.min.js?v=' . PROJECT_VERSION,
        '/vendor/owl-carousel/owl.carousel.min.js?v=' . PROJECT_VERSION,
        '/vendor/select2/js/select2.min.js?v=' . PROJECT_VERSION,
        '/vendor/photoswipe/photoswipe.min.js?v=' . PROJECT_VERSION,
        '/vendor/photoswipe/photoswipe-ui-default.min.js?v=' . PROJECT_VERSION,
        '/js/number.js?v=' . PROJECT_VERSION,
        '/js/header.js?v=' . PROJECT_VERSION,
        '/js/main.js?v=' . PROJECT_VERSION,

//        '/js/ModalRemote.js?v=' . PROJECT_VERSION,
//        '/js/ajaxcrud.js?v=' . PROJECT_VERSION,
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
    public $cssOptions = [
       'type' => 'text/css',
    ];
}
