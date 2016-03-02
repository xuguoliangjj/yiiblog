<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/27
 * Time: 13:11
 */
namespace xuguoliangjj\ueditor;

use yii\web\AssetBundle;

class UEditorAsset extends AssetBundle
{
    public $sourcePath = '@xuguoliangjj/ueditor/assets';

    public $css = [

    ];
    public $js = [
        'ueditor/ueditor.config.js',
        'ueditor/ueditor.all.min.js',
        'ueditor/lang/zh-cn/zh-cn.js'
    ];
    public $depends = [

    ];
}