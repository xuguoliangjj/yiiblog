<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/27
 * Time: 11:51
 */
namespace xuguoliangjj\editorgridview;

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\Model;

class EditorGridView extends GridView
{
    public $dataColumnClass;
    public $tableOptions = ["class"=>"table table-striped table-bordered table-condensed","cellspacing"=>"0", "width"=>"100%"];
    public $outerTableOptions = ['class'=>'table-responsive'];
    public $options = ['class'=>'grid-view'];

    /**
     * @inheritdoc
     */
    public $emptyCell='';
    /**
     * @inheritdoc
     */
    public $filterRowOptions = ['class' => 'filters form-inline'];
    /**
     * @inheritdoc
     */
    public $filterErrorOptions = ['class' => ''];

    public $buttonOptions = ['class'=>'grid-button bg-dark'];
    /**
     * @var array
     * 搜索发生的错误
     */
    public $filterErrors = [];

    /**
     * @var按钮
     */
    public $buttons = [];

    public function init()
    {
        $this -> dataColumnClass = EditorDataColumn::className();
        parent::init();
    }

    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        EditorGridViewAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiGridView($options);$(document).off('change.yiiGridView keydown.yiiGridView');");
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback("/{\\w+}/", function ($matches) {
                $content = $this->renderSection($matches[0]);

                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Html::tag($tag, $content, $options);
        foreach ($this->columns as $column) {
            if(isset($column->attribute) && $column->editable)
            {
                $models = $this->dataProvider->getModels();
                if(($model = reset($models)) instanceof Model)
                {
                    $name = Html::getInputName($model, $column->attribute);
                }else{
                    $name = $column->attribute;
                }

                $attributeName = $column->attribute;
                $view->registerJs("$('.$attributeName').editable({
                    placement:'right',
                    ajaxOptions: {
                        type: 'GET',
                        dataType: 'json'
                    },
                    success: function(response, newValue) {
                        if(response.status=='success')
                        {
                            return jQuery('#{$this->options['id']}').yiiGridView('applyFilter');
                        }
                        else
                        {
                            return response.msg;
                        }
                    },
                    params: function(rawParams) {
                        var params = {};
                        params['$name']=rawParams.value;
                        params['pk']=rawParams.pk;
                        return params;
                    }
                });");
            }
        }
    }

    /**
     * Renders the data models for the grid view.
     */
    public function renderItems()
    {
        $button = $this->renderTableButtons();
        $caption = $this->renderCaption();
        $columnGroup = $this->renderColumnGroup();
        $tableHeader = $this->showHeader ? $this->renderTableHeader() : false;
        $tableBody = $this->renderTableBody();
        $tableFooter = $this->showFooter ? $this->renderTableFooter() : false;
        $filter = $this->renderFilters();            //筛选过滤
        $content = array_filter([
            $caption,
            $columnGroup,
            $tableHeader,
            $tableFooter,
            $tableBody,
        ]);
        $table = Html::tag('table', implode("\n", $content), $this->tableOptions);
        return $filter.$button.Html::tag('div',$table,$this->outerTableOptions);
    }

    /*
     * 添加表格按钮
     */
    public function renderTableButtons()
    {
        if(!empty($this->buttons)) {
            $content = Html::beginTag('div',$this->buttonOptions);
            $content .= Html::tag('div', implode('', $this->buttons), ['class' => 'btn-group', 'role' => 'group']);
            $content .= Html::endTag('div');
            return $content;
        }
        else
            return $this->emptyCell;
    }

    /**
     * Renders the table header.
     * @return string the rendering result.
     */
    public function renderTableHeader()
    {
        $cells = [];
        foreach ($this->columns as $column) {
            /* @var $column Column */
            $cells[] = $column->renderHeaderCell();
        }
        $content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);

        return "<thead>\n" . $content . "\n</thead>";
    }

    /**
     * Renders the table footer.
     * @return string the rendering result.
     */
    public function renderTableFooter()
    {
        $cells = [];
        foreach ($this->columns as $column) {
            /* @var $column Column */
            $cells[] = $column->renderFooterCell();
        }
        $content = Html::tag('tr', implode('', $cells), $this->footerRowOptions);

        return "<tfoot>\n" . $content . "\n</tfoot>";
    }

    /**
     * Renders the filter.
     * @return string the rendering result.
     */
    public function renderFilters()
    {
        if ($this->filterModel !== null) {
            $id = $this->options['id'];
            $view = $this->getView();
            $view->registerJs("jQuery('#$id #filter-search').click(function(){jQuery('#$id').yiiGridView('applyFilter')})");
            $cells = [];
            foreach ($this->columns as $column) {
                /* @var $column Column */
                $cells[] = $column->renderFilterCell();
            }
            $cells[] = Html::button('查询',['class'=>'btn btn-primary btn-sm','id'=>'filter-search']);
            $filterError = !empty($this->filterErrors) ? Alert::widget([
                'options' => [
                    'class' => 'alert-warning',
                ],
                'body' => implode("\n",$this->filterErrors),
            ]) : '';
            return Html::tag('form', implode('', $cells), $this->filterRowOptions).$filterError;
        } else {
            return '';
        }
    }
}