<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/8/16
 * Time: 18:42
 */

$this->title = '添加角色';
$this->params['breadcrumbs'] = \backend\components\Tools::buildBreadcrumbs($this,$this->title);
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        添加角色
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


