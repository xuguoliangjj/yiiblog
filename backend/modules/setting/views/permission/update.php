<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/9/5
 * Time: 1:29
 */


$this->title = '修改权限';
$this->params['breadcrumbs'] = \backend\components\Tools::buildBreadcrumbs($this,$this->title);
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        修改权限
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_form',[
            'model'=>$model
        ])?>
    </div>
</div>


