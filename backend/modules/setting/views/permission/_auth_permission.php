<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/9/27
 * Time: 2:58
 */
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id' => 'auth-role-form']); ?>
<?= $form->field($model, 'permissions')->checkboxList($result['Permissions']); ?>
<?= $form->field($model, 'routes')->checkboxList($result['Routes']); ?>
    <div class="form-group">
        <?= Html::submitButton('修改', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php ActiveForm::end(); ?>