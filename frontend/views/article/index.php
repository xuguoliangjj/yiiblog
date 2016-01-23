<?php
/* @var $this yii\web\View */
$this->title = $type->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-xs-12 col-md-8">
        <div class="panel panel-default own-panel">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i> 文章列表
            </div>
            <div class="panel-body">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider'=>$dataProvider,
                    'itemOptions'=>['class'=>'list-item'],
                    'summary'=>'',
                    'itemView'=>'_item'
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="panel panel-default own-panel">
            <div class="panel-heading">
                热门标签
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
</div>