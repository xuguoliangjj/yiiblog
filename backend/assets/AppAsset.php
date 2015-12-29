<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/font-awesome/css/font-awesome.css',
        'js/metismenu/dist/metisMenu.css',
        'js/layer/skin/layer.css',
        'css/site.css',
        'css/menu.css',
        'css/style.css',
        'js/icheck/skins/square/grey.css',
        'js/highlight/styles/monokai.css'
    ];
    public $js = [
        'js/metismenu/dist/metisMenu.js',
        'js/layer/layer.js',
        'js/main.js',
        'js/app.js',
        'js/icheck/icheck.js',
        'js/highcharts/js/highcharts.js',
        'js/highcharts/js/modules/exporting.js',
        'js/highlight/highlight.pack.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
