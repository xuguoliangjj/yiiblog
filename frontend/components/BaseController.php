<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/11
 * Time: 23:48
 */
namespace frontend\components;
use frontend\models\SearchForm;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function init()
    {
        parent::init();
//        Yii::$app->view->params['searchForm'] = new SearchForm();
    }
}