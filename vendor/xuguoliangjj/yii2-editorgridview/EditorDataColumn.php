<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/30
 * Time: 19:29
 */
namespace xuguoliangjj\editorgridview;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQueryInterface;
use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;

class EditorDataColumn extends DataColumn
{
    /*
     * 是否可编辑
     * ['editor',function(){
     *      return [];
     * }]
     */
    public $editable = [];



    public $filterOptions = ['class'=>'form-group'];

    /**
     * @inheritdoc
     */
    public $filterInputOptions = ['class' => 'form-control input-sm', 'id' => null,'placeholder'=>'请输入......'];
    /**
     * @inheritdoc
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return null|string
     * @throws InvalidConfigException
     */
    public function getDataCellValue($model, $key, $index)
    {
        if(count($this -> editable) == 2)
        {
            if(is_string($this->editable[0]) && $this->editable[0]=='editor')
            {
                $editorConfig = call_user_func($this->editable[1], $model, $key, $index, $this);
                $this->initEditableColumns($model,$editorConfig);
                if ($this->value !== null) {
                    if (is_string($this->value)) {
                        return Html::a(ArrayHelper::getValue($model, $this->value),'',$editorConfig);
                    } else {
                        return Html::a(call_user_func($this->value, $model, $key, $index, $this),'',$editorConfig);
                    }
                } elseif ($this->attribute !== null) {
                    return Html::a(ArrayHelper::getValue($model, $this->attribute),'',$editorConfig);
                }
            }else{
                throw new InvalidConfigException('配置错误');
            }
            return null;
        }else {
            return parent::getDataCellValue($model,$key,$index);
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderFilterCellContent()
    {
        if (is_string($this->filter)) {
            return $this->filter;
        }

        $model = $this->grid->filterModel;

        if ($this->filter !== false && $model instanceof Model && $this->attribute !== null && $model->isAttributeActive($this->attribute)) {
            if ($model->hasErrors($this->attribute)) {
                Html::addCssClass($this->filterOptions, 'has-error');
                $this->grid->filterErrors[] = '' . Html::error($model, $this->attribute, $this->grid->filterErrorOptions);
            }
            if (is_array($this->filter)) {
                $options = array_merge(['prompt' => ''], $this->filterInputOptions);
                return Html::activeDropDownList($model, $this->attribute, $this->filter, $options);
            } else {
                return Html::activeTextInput($model, $this->attribute, $this->filterInputOptions);
            }
        } else {
            return parent::renderFilterCellContent();
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content === null) {
            return $this->grid->formatter->format($this->getDataCellValue($model, $key, $index), $this->format);
        } else {
            return parent::renderDataCellContent($model, $key, $index);
        }
    }

    /*
     *
     */
    protected function initEditableColumns($model,&$columns)
    {
       if(!isset($columns['class']))
       {
           $columns['class'] = $this->attribute;
       }
       if(!isset($columns['data-title']))
       {
           $columns['data-title'] = $model->getAttributeLabel($this->attribute);
       }
    }

    /**
     * @inheritdoc
     */
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || $this->label === null && $this->attribute === null) {
            return parent::renderHeaderCellContent();
        }

        $provider = $this->grid->dataProvider;
        if ($this->label === null) {
            $label = &$this->label;
            if ($provider instanceof ActiveDataProvider && $provider->query instanceof ActiveQueryInterface) {
                /* @var $model Model */
                $model = new $provider->query->modelClass;
                $label = $model->getAttributeLabel($this->attribute);
            } else {
                $models = $provider->getModels();
                if (($model = reset($models)) instanceof Model) {
                    /* @var $model Model */
                    $label = $model->getAttributeLabel($this->attribute);
                } else {
                    $label = Inflector::camel2words($this->attribute);
                }
            }
        } else {
            $label = $this->label;
        }
        if ($this->attribute !== null && $this->enableSorting &&
            ($sort = $provider->getSort()) !== false && $sort->hasAttribute($this->attribute)) {
            return $sort->link($this->attribute, array_merge($this->sortLinkOptions, ['label' => ($this->encodeLabel ? Html::encode($label) : $label)]));
        } else {
            return $this->encodeLabel ? Html::encode($label) : $label;
        }
    }

    /**
     * Renders the filter cell.
     */
    public function renderFilterCell()
    {
        if($this->filter) {
            $content = $this->renderFilterCellContent();
            if($content != $this->grid->emptyCell)
                return Html::tag('span',$this->label.':').$content;
        }else {
            return null;
        }
    }
}