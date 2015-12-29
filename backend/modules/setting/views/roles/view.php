<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/8/9
 * Time: 19:16
 */
$this->title = '角色授权';
$this->params['breadcrumbs'] = \backend\components\Tools::buildBreadcrumbs($this,$this->title);
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        <?= $this->title?>
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_auth_form',['model'=>$model,'result'=>$result])?>
    </div>
</div>