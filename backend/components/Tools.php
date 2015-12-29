<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/8/16
 * Time: 18:51
 */
namespace backend\components;
use \yii\base\Object;
use Yii;
class Tools extends Object
{
    /**
     * 创建面包屑
     */
    public static function buildBreadcrumbs($view,$currLabel='')
    {
        $menus = $view->context->leftMenu;
        $route = $view->context->route;
        $breadCrumbs = [];
        foreach ($menus[0]['items'] as $item) {
            $url = trim($item['url'][0], '/');
            if (stripos($route, $url) === 0) {
                $label = trim(strip_tags($item['label']), '&nbsp;');
                $breadCrumbs[] = ['url' => [$item['url'][0]], 'label' => $label];
                $breadCrumbs[] = $currLabel;
                break;
            }
        }
        return $breadCrumbs;
    }
}