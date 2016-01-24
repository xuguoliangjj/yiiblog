<?php
/* @var $this yii\web\View */
$this->title = '第十九层空间的个人博客';
?>
<div class="site-index">
    <div class="jumbotron">
        <h2>欢迎进入我的博客</h2>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-xs-12 col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="glyphicon glyphicon-list"></i> 最近更新</div>
                    <div class="panel-body">
                        <?= \yii\widgets\ListView::widget([
                            'summary'=>'',
                            'itemOptions'=>['class'=>'list-item'],
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_item'
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="glyphicon glyphicon-thumbs-up"></i> 热门文章</div>
                    <div class="panel-body">
                        <?= \yii\widgets\ListView::widget([
                            'summary'=>'',
                            'itemOptions'=>['class'=>'list-item'],
                            'dataProvider'=>$hot_dataProvider,
                            'itemView'=>'_hot_item'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
