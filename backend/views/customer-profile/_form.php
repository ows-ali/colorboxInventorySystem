<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6,'maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'phone_number1')->textInput(['maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'phone_number2')->textInput(['maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'phone_number3')->textInput(['maxlength' => true,'style'=>'width:500px']) ?>

        <?= $form->field($model, 'customer_type')->dropDownList([ 'shop' => 'Shop', 'company' => 'Company',], ['prompt' => '', 'maxlength' => true,'style'=>'width:500px']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'maxlength' => true,'style'=>'width:500px']) ?>

    <?php
    // echo $form->field($model, 'status')->dropDownList([ '0', '1', ], ['prompt' => '', 'maxlength' => true,'style'=>'width:500px']) ?>

     <?php
     // echo $form->field($model, 'created_at')->textInput() 
     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
