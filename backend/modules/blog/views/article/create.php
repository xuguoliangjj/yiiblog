<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\Article */

$this->title = Yii::t('app', '新建文章');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '文章列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">
    <div class="page-header">
    <h3 style="text-align: center;"><?= Html::encode($this->title) ?></h3>
     </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
