<?php

namespace backend\assets;

use yii\web\AssetBundle;


class DatatableAsset extends AssetBundle
{
    public $basePath = '@webroot/js/datatable';
    public $baseUrl = '@web/js/datatable';
    public $css = [
        'css/dataTables.bootstrap.css'
    ];
    public $js = [
        'js/jquery.dataTables.js',
        'js/dataTables.bootstrap.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
