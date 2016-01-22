<?php
/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\Type */

$this->title = Yii::t('app', 'Create Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        新增文章类别
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>