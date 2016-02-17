<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\Article */

$this->title = Yii::t('app', '新建文章');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '文章列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="panel panel-default own-panel">
    <div class="panel-heading">
        新增文章
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
