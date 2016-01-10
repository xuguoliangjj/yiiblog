<?php
/*
 * @author xuguoiang
 * UEditor插件
 */
namespace xuguoliangjj\ueditor;


use yii\web\AssetBundle;

class UEditorAsset extends AssetBundle
{
    public $sourcePath = '@xuguoliangjj/ueditor/assets';

    public $css = [
    ];
    public $js = [
        'ueditor.config.js',
        'ueditor.all.js',
        'lang/zh-cn/zh-cn.js'
    ];
    public $depends = [

    ];
}
