<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use xuguoliangjj\ueditor\UEditor;
use yii\helpers\ArrayHelper;
use backend\modules\blog\models\Type;
/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(Type::find()->asArray()->all(),'id','name')
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea()->widget(UEditor::className(),[
        'options'=>[]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '0'=>'草稿',
        '1'=>'发布'
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '新建') : Yii::t('app', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
