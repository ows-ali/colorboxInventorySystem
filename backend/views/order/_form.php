<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CustomerProfile;
use common\models\SalesmanProfile;
use common\models\Orderdetail;
use common\models\Shade;


use yii\helpers\ArrayHelper;

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $model common\models\CustomerProfile */
/* @var $form yii\widgets\ActiveForm */


  \Yii::$app->getSession()->getFlash('error');
    $all_shades = json_encode(Shade::find()->select(['shade_name'])->column());

?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); 
    echo $form->errorsummary($model3);
    ?>
    <div class="col-md-12">
        <div class="col-md-6">
<?php 
         $customers = CustomerProfile::find()->orderBy('customer_name')->asArray()->all(); 
         // create an array of pairs ('id', 'type-name'):
         $customerList = ArrayHelper::map($customers, 'customer_id', 'customer_name'); 
         // finally create the drop-down list:
?>
<?=
         $form->field($model, 'customer_id')->dropDownList($customerList,['style'=>'width:500px'])
?>

<?php 
        $salesman = SalesmanProfile::find()->orderBy(['salesman_name'=>SORT_ASC])->asArray()->all(); 
         // create an array of pairs ('id', 'type-name'):
         $salesmanList = ArrayHelper::map($salesman, 'salesman_id', 'salesman_name'); 
         // finally create the drop-down list:
?>

<?=
         $form->field($model, 'salesman_id')->dropDownList($salesmanList,['style'=>'width:500px'])
?>

  
<?php

?>
    
<?= 
$form->field($model, 'order_date')->widget(DatePicker::classname(), [
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
    
    'options' => ['label'=>"Joining Date",'placeholder' => "Select Date",'style'=>'width:420px'],
    
    'pluginOptions' => [
        'format' => 'yyyy-mm-d',
        // 'todayHighlight' => true
    ]    
])
?>
     <?php 
     // $form = ActiveForm::begin(); 
     ?>

    <?= $form->field($model3, 'shade_id')->textarea(['maxlength' => true,'rows' => 6,'style'=>'width:500px','id'=>'inputfield','oninput'=>"myfunction(".$all_shades.")"]) ?>

  </div> <!-- col-md-8 -->
  <div class="col-md-4">
        <b>Tracking:</b>
        <div id="myid" class="nav-tabs-custom bg-blue"></div>
  </div>

</div><!-- col-md-12 -->



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Order' : 'Update Order', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>