<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class PostPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        '/css/typography.css?v=' . PROJECT_VERSION,
        '/css/post-header.css?v=' . PROJECT_VERSION,
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
