<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CustomerProfile;
use common\models\SalesmanProfile;
use common\models\Order;
use common\models\Orderdetail;
use common\models\Shade;


use yii\helpers\ArrayHelper;

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $model common\models\CustomerProfile */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="order-form">

    <?php $form = ActiveForm::begin();
    $all_shades = json_encode(Shade::find()->select(['shade_name'])->column());

     ?>

<?php 
         $customers = CustomerProfile::find()->orderBy('customer_name')->asArray()->all(); 
         // create an array of pairs ('id', 'type-name'):
         $customerList = ArrayHelper::map($customers, 'customer_id', 'customer_name'); 
         // finally create the drop-down list:
?>

<div class="row col-md-12">
    <div class="col-md-6">
<?=
         $form->field($model, 'customer_id')->dropDownList($customerList,['style'=>'width:500px'])
?>

<?php 



        $salesman = SalesmanProfile::find()->orderBy('salesman_name')->asArray()->all(); 
         // create an array of pairs ('id', 'type-name'):
         $salesmanList = ArrayHelper::map($salesman, 'salesman_id', 'salesman_name'); 
         // finally create the drop-down list:
?>

<?=
         $form->field($model, 'salesman_id')->dropDownList($salesmanList,['style'=>'width:500px'])
?>

  
<?php
// $model->order_date=date('Y-m-d');

?>
    
<?= 
$form->field($model, 'order_date')->widget(DatePicker::classname(), [
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
if (Yii::$app->user->identity->name=="Admin")
    echo $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Approved' => 'Approved' ],['prompt'=>'Select Option','style'=>"width:500px;"]);


?>
<?php $model3=Orderdetail::find()->where(['order_id'=>$model->order_id])->andWhere(['status'=>'1'])->all(); 

$shade_ids="";
foreach ($model3 as $key => $value) {
    # code...
    for ($i=0;$i<$value->quantity;$i++)
        $shade_ids=$shade_ids.$value->shade_id."\n";

}
     ?>

    <?php
    // echo $form->field($model3, 'shade_id')->textarea(['maxlength' => true,'rows' => 6,'style'=>'width:500px']) 
    if (Order::find()->where(['order_id'=>$model->order_id])->one()->status=="Pending")
    {
        echo "<b>Edit Order Items ? </b>";
        echo Html::checkBox('edit_detail',0,['onchange'=>'toggle_func()']);
    ?>

        <div id="hiddenDiv" style="display: none">
    <?php
            echo Html::textArea( 'shade_ids',$shade_ids,['rows'=>6,'maxlength'=>true,'style'=>'width:500px','id'=>'inputfield','oninput'=>"myfunction(".($all_shades).")"]); 
    ?>
        </div>
    <?php
    }
    ?>
</div>
<!-- <div class="col-md-6"> -->
        <div class=" col-md-4">
            <b>Tracking:</b>
            <div id="myid" class="nav-tabs-custom bg-blue"></div>
        </div>  
    </div>
    <!-- row -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Order' : 'Update Order', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
  var data = [];
  var newHTML = [];

  function toggle_func(){
    var x=  document.getElementById('hiddenDiv');//.toggle();
    if (x.style.display === "none") {
          x.style.display = "block";
      } else {
          x.style.display = "none";
      }
  }


   // window.onload = myfunction($all_shades );
   // alert('<?php echo json_encode($all_shades)?>');
  var all_s = '<?php  echo ($all_shades) ;?>';
  setTimeout(function(){ 
        myfunction(all_s);//console.log(all_s+'sl');
  // alert("Hello"); 
}, 2000);



</script>