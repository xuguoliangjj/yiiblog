<?php
/*
 * @author xuguoliang
 * UEditor插件
 */
namespace xuguoliangjj\ueditor;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;
class UEditor extends InputWidget
{
    public $options      = [];
    public $inputOptions = [];
    //UEditor插件配置
    public $clientOptions = [
        'initialContent'=>'writing...',
        'toolbars'=>[
            [
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                'print', 'preview', 'searchreplace', 'help', 'drafts'
            ]
        ]
    ];

    public $uploadUrl = '';
    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->clientOptions = array_merge([
            'serverUrl'=>Url::to(['upload'])
        ],$this->clientOptions);
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->options = array_merge($this->inputOptions,$this->options,['id'=>$this->hasModel() ? Html::getInputId($this->model,$this->attribute) : $this->id]);
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this -> registerUEditor();
    }

    protected function registerUEditor()
    {
        UEditorAsset::register($this->view);
        $config = Json::encode($this->clientOptions);
        $js = <<<EOD
        var editor = UE.getEditor('{$this->options["id"]}',$config);
EOD;
        $this->view->registerJs($js,\yii\web\View::POS_READY);
    }
}
