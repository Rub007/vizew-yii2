<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'style.css',
//        'css/style.css',
//        'css/animate.css',
//        'css/bootstrap.min.css',
//        'css/classy-nav.css',
//        'css/magnific-popup.css',
//        'css/nice-select.css',
//        'css/owl.carousel.css',
//        'css/themify-icons.css',
    ];
    public $js = [
        'js/jquery/jquery-2.2.4.min.js',
        'js/bootstrap/popper.min.js',
        'js/bootstrap/bootstrap.min.js',
        'js/plugins/plugins.js',
        'js/active.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
