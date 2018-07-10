<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\SalesmanProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesman-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'salesman_name')->textInput(['maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6,'style'=>'width:500px']) ?>

    
<?php
// $model->joining_date=date('Y-m-d');

?>
    <?=
    $form->field($model, 'joining_date')->widget(DatePicker::classname(), [
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
    'options' => ['label'=>"Joining Date",'placeholder' => "Select Date",'style'=>'width:420px'],
    
    'pluginOptions' => [
        'format' => 'yyyy-mm-d',
        'todayHighlight' => true
    ]    
])
?>
    
    <?php
  
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
