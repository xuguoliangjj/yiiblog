<span class="pull-left glyphicon glyphicon-book" style="margin-top: 6px;"></span>
&nbsp;&nbsp;
<?= \yii\helpers\Html::a($model->title,['article/view','id'=>$model->id]) ?>
<span class="pull-right"><?= date('Y-m-d',strtotime($model->create_at))?></span>