<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/jquery.toast.css',
        "https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i",
        "vendor/bootstrap/css/bootstrap.ltr.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/highlight.js/styles/github.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/simplebar/simplebar.min.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/quill/quill.snow.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/air-datepicker/css/datepicker.min.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/select2/css/select2.min.css?v=",
        "vendor/datatables/css/dataTables.bootstrap5.min.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/nouislider/nouislider.min.css?v=" . PROJECT_VERSION_ADMIN,
        "vendor/fullcalendar/main.min.css?v=" . PROJECT_VERSION_ADMIN,
        // 'css/ajaxcrud.css',
        "css/style.css?v=" . PROJECT_VERSION_ADMIN,
    ];
    public $js = [
//        "vendor/jquery/jquery.min.js?v=" . PROJECT_VERSION_ADMIN,
//        'js/jquery.toast.js',
        "vendor/feather-icons/feather.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/simplebar/simplebar.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/bootstrap/js/bootstrap.bundle.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/highlight.js/highlight.pack.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/quill/quill.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/air-datepicker/js/datepicker.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/air-datepicker/js/i18n/datepicker.en.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/select2/js/select2.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/fontawesome/js/all.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/chart.js/chart.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/datatables/js/jquery.dataTables.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/datatables/js/dataTables.bootstrap5.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/nouislider/nouislider.min.js?v=" . PROJECT_VERSION_ADMIN,
        "vendor/fullcalendar/main.min.js?v=" . PROJECT_VERSION_ADMIN,
        "js/stroyka.js?v=" . PROJECT_VERSION_ADMIN,
        "js/custom.js?v=" . PROJECT_VERSION_ADMIN,
//        "js/calendar.js?v=" . PROJECT_VERSION_ADMIN,
        "js/demo.js?v=" . PROJECT_VERSION_ADMIN,
        "js/my-demo.js?v=" . PROJECT_VERSION_ADMIN,
        "js/demo-chart-js.js?v=" . PROJECT_VERSION_ADMIN,

//        'js/ModalRemote.js?v=' . PROJECT_VERSION_ADMIN,
//        'js/ajaxcrud.js?v=' . PROJECT_VERSION_ADMIN,
    ];
    public $depends = [
         'yii\web\YiiAsset',
//         'yii\bootstrap5\BootstrapAsset',
    ];
}
