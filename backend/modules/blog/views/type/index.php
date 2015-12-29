<?php
$this->title = '类别列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php \yii\widgets\Pjax::begin()?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        类别列表
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
    <?= \xuguoliangjj\editorgridview\EditorGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'buttons'=>[
            \yii\helpers\Html::a('新增类别',['create'],['class'=>'btn btn-sm btn-primary'])
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tag',
            ['attribute'=>'name','label'=>'分类名','filter'=>true],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    </div>
</div>
<?php \yii\widgets\Pjax::end()?>
