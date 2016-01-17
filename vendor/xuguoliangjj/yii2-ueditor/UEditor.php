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
        'initialContent'=>'你好',
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
