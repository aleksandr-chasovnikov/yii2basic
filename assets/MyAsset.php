<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Great+Vibes',
        '//fonts.googleapis.com/css?family=Open+Sans:700,700italic,800,300,300italic,400italic,400,600,600italic',
        '//fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic',
        'GoEasyOn/css/style.css?t=0kw',
        'GoEasyOn/css/component.css',
        'GoEasyOn/css/font-awesome.css',
        'GoEasyOn/css/magnific-popup.css',
        'GoEasyOn/css/animate.css',
        // 'css/site.css'
    ];
    public $js = [
        "GoEasyOn/js/modernizr.custom.js",
        "GoEasyOn/js/menu.js",
        "GoEasyOn/js/jquery.magnific-popup.js",
        "GoEasyOn/js/wow.min.js",
        "GoEasyOn/js/rAF.js",
        "GoEasyOn/js/demo-2.js",
        "GoEasyOn/js/move-top.js?е=0ga",
        "GoEasyOn/js/easing.js",
        "GoEasyOn/js/responsiveslides.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset', // yii.js, jquery.js
        'yii\bootstrap\BootstrapAsset', // bootstrap.css
        'yii\bootstrap\BootstrapPluginAsset' // bootstrap.js
    ];

    public $jsOptions = [
      'position' =>  View::POS_END,
    ];

}
