<?php
$this->title = '文章列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php \yii\widgets\Pjax::begin()?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        文章列表
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?php
        echo \xuguoliangjj\editorgridview\EditorGridView::widget([
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'summary'=>'',
            'buttons'=>[
                \yii\helpers\Html::a('新增文章',['create'],['class'=>'btn btn-sm btn-primary'])
            ],
            'columns'=>[
                ['attribute'=>'id','label'=>'ID'],
                ['attribute'=>'title','label'=>'文章标题','filter'=>true],
                ['attribute'=>'create_by','label'=>'作者','filter'=>true],
                ['attribute'=>'create_at','label'=>'创建时间','format'=>['date', 'php:Y-m-d H:i:s']],
                ['attribute'=>'update_at','label'=>'更新时间','format'=>['date', 'php:Y-m-d H:i:s']],
                ['attribute'=>'status','format'=>'raw','label'=>'状态','filter'=>[
                    0=>'草稿',
                    1=>'发布'
                ],'value'=>function($data){
                    if($data['status']==0){
                        return '<span class="text-danger">草稿</span>';
                    }elseif($data['status']==1){
                        return '<span class="text-success">发布</span>';
                    }
                }],
                ['class' => 'yii\grid\ActionColumn','template' => '{view} {update} {delete}'],
            ]
        ]);

        ?>
    </div>
</div>
<?php \yii\widgets\Pjax::end()?>
