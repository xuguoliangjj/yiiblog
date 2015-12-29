<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/11/6
 * Time: 0:55
 */
$this->title = '用户授权';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        用户授权
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_form',[
            'model'=>$model,
            'roles'=>$roles,
            'permissions'=>$permissions])?>
    </div>
</div>
