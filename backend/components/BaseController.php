<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/11
 * Time: 23:48
 */
namespace backend\components;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class BaseController extends Controller
{
    public $topMenu;    //顶部菜单
    public $leftMenu;   //左侧二级菜单

    /*
     * 默认的菜单图标
     * public $defaultIcon = 'glyphicon glyphicon-star';
     */
    public $defaultIcon = '';
    //默认显示菜单图标
    public $activeIcon = true;

    public function init()
    {
        parent::init();
        $this->getView()->title = '数据分析平台';
        if(Yii::$app->session->hasFlash('success')){
            $msg = Yii::$app->session->getFlash('success');
            $this->getView()->registerJs("
            layer.msg(\"$msg\", {icon: 1});
            ");
        }else if(Yii::$app->session->hasFlash('fail')){
            $msg = Yii::$app->session->getFlash('fail');
            $this->getView()->registerJs("
            layer.msg(\"$msg\", {icon: 5});
");
        }
    }

    public function beforeAction($action)
    {
        if(Yii::$app->user->isGuest && $this->route != 'site/login')
        {
            $this ->redirect(['/site/login']);
        }
        $this -> authRoute();
        $menus = Yii::$app->params['menu'];
        $activeTag = '';
        $menus = $this -> normalizeMenu($menus,$activeTag);
        if(isset($menus[$activeTag]['items']))
        {
            $this -> leftMenu = $menus[$activeTag]['items'];
        }else{
            $this -> leftMenu  = [];
        }
        foreach($menus as $key => $items)
        {
            unset($menus[$key]['items']);
        }

        $this -> topMenu = $menus;
        return true;
    }

    //验证是否有权限
    private function authRoute()
    {
        if(count(explode('/',$this->route)) == 3 && $this->action->id == 'index'){
            $route = trim(str_replace('index','',$this -> route),'/');
        }else{
            $route = trim($this->route,'/');
        }
        if(!$this->auth($route)){
            throw new ForbiddenHttpException('没有相关权限，如需开通，请联系管理人员！');
        }else{
            return true;
        }
    }

    private function auth($route)
    {
        if($route == 'site/login' || $route == 'site/error' || $route == 'site/logout'){
            return true;
        }
        $route = '/'.trim($route,'/');
        $arr   = explode('/',trim($route,'/'));
        if(!Yii::$app->user->can('/*') && !Yii::$app->user->can('/'.$arr[0].'/'.$arr[1].'/*') && !Yii::$app->user->can($route)){
            return false;
        }else{
            return true;
        }
    }

    //判断是否当前url
    private function isItemActive($item){
        if(stripos($this->route,trim($item['url'][0],'/')) === 0)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $menus
     * @param $activeTag
     * @return mixed
     */
    private function normalizeMenu($menus,&$activeTag)
    {
        foreach($menus as $i => $items)
        {
            $firstUrl = '';
            foreach($items['items'] as $k => $item)
            {
                if(!empty($item['items'])) {
                    foreach ($item['items'] as $l => $menu) {
                        if($firstUrl == '')
                        {
                            $firstUrl = $menu['url'][0];                      //获取第一个url
                        }
                        if (stripos($this->route,trim($menu['url'][0],'/')) === 0) {   //找出当前路由在哪个菜单下
                            $activeTag = $i;
                            $menus[$i]['active']=true;
                        }
                        if(!$this->auth($menu['url'][0])){
                            //删除没有权限的菜单
                            unset($menus[$i]['items'][$k]['items'][$l]);
                            continue;
                        }
                        if(!isset($menus[$i]['items'][$k]['active']))
                        {
                            if($this->isItemActive($menu))
                            {
                                $menus[$i]['items'][$k]['active']=true;
                                $menus[$i]['items'][$k]['items'][$l]['active']=true;
                            }
                        }
                        $iconClass = isset($menu['icon']) ? $menu['icon'] : $this->defaultIcon;
                        $menus[$i]['items'][$k]['items'][$l]['label'] = $this->buildMenusLabel($menu['label'], $iconClass);
                        unset($menus[$i]['items'][$k]['items'][$l]['icon']);
                    }
                    if(empty($menus[$i]['items'][$k]['items'])){
                        unset($menus[$i]['items'][$k]);
                    }else{
                        $menus[$i]['items'][$k]['url'] = ['#'];
                        $iconClass = isset($item['icon']) ? $item['icon'] : $this->defaultIcon;
                        $menus[$i]['items'][$k]['label'] = $this -> buildItemsLabel($item['label'],$iconClass);
                        unset($menus[$i]['items'][$k]['icon']);
                    }
                }else{
                    unset($menus[$i]['items'][$k]);  //删除没有子菜单的菜单
                    continue;
                }
            }
            if(empty($menus[$i]['items'])){
                unset($menus[$i]);
            }else {
                $menus[$i]['url'] = [$firstUrl];
            }
        }
        return $menus;
    }

    /**
     * @param $label
     * @param $iconClass
     * @return string 返回母菜单标签
     */
    private function buildItemsLabel($label,$iconClass)
    {
        $label = $this -> buildMenusLabel($label,$iconClass)
        .Html::tag('span','',['class'=>'glyphicon arrow']);
        return $label;
    }

    /**
     * @param $label
     * @param $iconClass
     * @return string 返回菜单标签
     */
    private function buildMenusLabel($label,$iconClass)
    {
        if($this -> activeIcon) {
            $label = Html::tag('span',"&nbsp;",['class' => $iconClass])
                . $label;
        }
        return $label;
    }
}