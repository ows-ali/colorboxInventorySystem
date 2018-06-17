<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Shade;
/* @var $this yii\web\View */
/* @var $model common\models\Shade */
/* @var $form yii\widgets\ActiveForm */
  \Yii::$app->getSession()->getFlash('error');
    $all_shades = json_encode(Shade::find()->select(['shade_name'])->column());

?>

<div class="inventory-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row col-md-12" >
    
        <div class="col-md-6">
        <?= $form->field($model, 'shade_id')->textarea(['maxlength' => true,'rows' => 6,'style'=>'width:500px','id'=>'inputfield','oninput'=>"myfunction(".$all_shades.")"]) ?>
      </div>
      <div class=" col-md-4">
        <b>Tracking:</b>
        <div id="myid" class="nav-tabs-custom bg-blue"></div>
      </div>  
    </div>

     <?php
     //echo $form->field($model, 'created_at')->textInput() 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Into Inventory' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); 


    // print_r($all_shades);
    ?>

</div>


<!-- <script type="text/javascript" src="../js/main.js"></script> -->
