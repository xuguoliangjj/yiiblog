<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\searchs\tagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '标签');
$this->params['breadcrumbs'][] = $this->title;
?>
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
            'columns' => [
                ['attribute'=>'tag','label'=>'标签','filter'=>true],
                ['attribute'=>'article_id','label'=>'文章','value'=>function($data){
                    return $data->article->title;
                }],
                ['class' => 'yii\grid\ActionColumn']
            ],
        ]); ?>

    </div>
</div>
