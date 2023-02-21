<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

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

        'https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i',
        '/vendor/bootstrap/css/bootstrap.min.css',
        '/vendor/owl-carousel/assets/owl.carousel.min.css',
        '/vendor/photoswipe/photoswipe.css',
        '/vendor/photoswipe/default-skin/default-skin.css',
        '/vendor/select2/css/select2.min.css',
        '/css/style.css',
        '/vendor/fontawesome/css/all.min.css',
        '/fonts/stroyka/stroyka.css',

    ];
    public $js = [

        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'vendor/owl-carousel/owl.carousel.min.js',
        'vendor/nouislider/nouislider.min.js',
        'vendor/photoswipe/photoswipe.min.js',
        'vendor/photoswipe/photoswipe-ui-default.min.js',
        'vendor/select2/js/select2.min.js',
        'js/number.js',
        'js/main.js',
        'js/header.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
    //    'yii\bootstrap5\BootstrapAsset'
    ];
}
