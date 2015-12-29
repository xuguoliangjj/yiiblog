<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/13
 * Time: 19:07
 */
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(['id' => 'auth-role-form']); ?>
<?= $form->field($model, 'roles')->checkboxList($result['Roles']); ?>
<?= $form->field($model, 'routes', ['parts'=>["{input}"=>'1111']])->checkboxList($result['Routes']); ?>
<?= $form->field($model, 'permissions')->checkboxList($result['Permissions']); ?>
    <div class="form-group">
        <?= Html::submitButton('修改', ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php ActiveForm::end(); ?>