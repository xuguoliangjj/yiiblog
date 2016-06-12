<?php
/* @var $this yii\web\View */
\backend\assets\DatatableAsset::register($this);
?>
<div class="container">
    <div class="jumbotron">
        <h2><?=Yii::$app->user->identity->username?>，欢迎使用博客管理后台!</h2>
    </div>
</div>
