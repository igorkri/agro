<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'bootstrap' => ['assetsAutoCompress'],
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'agro_cart',
        ],
//        'assetsAutoCompress' => [
//            'class'   => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
//            'enabled' => true,
//
//            'readFileTimeout' => 3,           //Time in seconds for reading each asset file
//
//            'jsCompress'                => true,        //Enable minification js in html code
//            'jsCompressFlaggedComments' => true,        //Cut comments during processing js
//
//            'cssCompress' => true,        //Enable minification css in html code
//
//            'cssFileCompile'        => true,        //Turning association css files
//            'cssFileCompileByGroups' => false,      //Enables the compilation of files in groups rather than in a single file. Works only when the $cssFileCompile option is enabled
//            'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
//            'cssFileCompress'       => true,        //Enable compression and processing before being stored in the css file
//            'cssFileBottom'         => false,       //Moving down the page css files
//            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js
//
//            'jsFileCompile'                 => true,        //Turning association js files
//            'jsFileCompileByGroups'         => false,        //Enables the compilation of files in groups rather than in a single file. Works only when the $jsFileCompile option is enabled
//            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
//            'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
//            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js
//
//            'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests when all pjax requests when enabled jsFileCompile
//            'noIncludeCssFilesOnPjax' => true,        //Do not connect the css files when all pjax requests when all pjax requests when enabled cssFileCompile
//
//            'htmlFormatter' => [
//                //Enable compression html
//                'class'         => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
//                'extra'         => false,       //use more compact algorithm
//                'noComments'    => true,        //cut all the html comments
//                'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on
//
//                //or
//
//                // 'class' => 'skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',
//
//                //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface
//
//                //or false
//            ],
//        ],
    ],
];
