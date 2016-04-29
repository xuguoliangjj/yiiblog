<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->type->name, 'url' => ['index','type'=>$model->type->tag]];
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
         <i class="glyphicon glyphicon-eye-open"></i> <?= $model->times == null ? '0 浏览次数' : $model->times.' 浏览次数'?>
     </span>
        &nbsp;&nbsp;
        <!-- JiaThis Button BEGIN -->
     <span class="jiathis_style" style="display: inline-block;">
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_renren"></a>
            <a href="http://www.jiathis.com/share?uid=2036982" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
     </span>
     <script type="text/javascript">
            var jiathis_config = {data_track_clickback:'true'};
     </script>
     <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=2036982" charset="utf-8"></script>
     <!-- JiaThis Button END -->
    </div>

    <div class="article-view">
        <?= $model->content?>
    </div>

    <div class="article-comment">
    <!-- UY BEGIN -->
    <div id="uyan_frame"></div>
    <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2036982"></script>
    <!-- UY END -->
    </div>
</div>

