<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/9/5
 * Time: 18:15
 */

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id' => 'create-permission-form']); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'description')->textarea()?>
<?= $form->field($model, 'ruleName') ?>
<?= $form->field($model, 'data')->textarea()?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '添加' : '修改',
        ['class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm']) ?>
</div>
<?php ActiveForm::end(); ?>