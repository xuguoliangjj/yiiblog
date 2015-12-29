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
<?php $form = ActiveForm::begin(['id' => 'assignment-form']); ?>

<?= $form->field($model, 'roles')->checkboxList($roles); ?>
<?= $form->field($model, 'permissions')->checkboxList($permissions); ?>

<div class="form-group">
    <?= Html::submitButton('修改',
        ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php ActiveForm::end(); ?>