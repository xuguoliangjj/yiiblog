<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
    <div class="page-header">
    <h3><?= Html::encode($model->title) ?></h3>
     <span style="color:#ccc;">
         <i class="glyphicon glyphicon-time"></i> <?= $model->create_at?>
     </span>
        &nbsp;&nbsp;
     <span style="color:#ccc;">
         <i class="glyphicon glyphicon-eye-open"></i> <?= $model->times.' 浏览次数'?>
     </span>
    </div>
    <?= $model->content?>
    <!-- UY BEGIN -->
    <div id="uyan_frame"></div>
    <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2036982"></script>
    <!-- UY END -->
</div>

