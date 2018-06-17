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


// echo '<pre>';
// echo "<pre";
// print_r($model);
// print_r($model2[0]);
// die;
?>

<div class="order-form">

    <?php $form = ActiveForm::begin();
    $all_shades = json_encode(Shade::find()->select(['shade_name'])->column());

     ?>
    <!-- $all_shades = json_encode(Shade::find()->select(['shade_name'])->column()); -->

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
/*
        DatePicker::widget([
        'model' => $model,
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'attribute' => 'order_date', 
        'value' => date('yyyy-mm-d', strtotime('+0 days')),
        'options' => ['placeholder' => 'Select date ...','style'=>'width:420px'],
        'pluginOptions' => [
        'format' => 'yyyy-mm-d',
        'todayHighlight' => true
        ]
        ])
*/
?>



<?php 
if (Yii::$app->user->identity->name=="Admin")
    echo $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Approved' => 'Approved' ],['prompt'=>'Select Option','style'=>"width:500px;"]);

// echo Html::activeDropDownList($model, 'status',
//       ArrayHelper::map(Order::find()->all(), 'status', 'status'))
// echo  $form->field($model, 'status')->dropDownList(['Pending','Approved'],['style'=>'width:500px'])

?>
<?php $model3=Orderdetail::find()->where(['order_id'=>$model->order_id])->andWhere(['status'=>'1'])->all(); 

$shade_ids="";
foreach ($model3 as $key => $value) {
    # code...
    for ($i=0;$i<$value->quantity;$i++)
        $shade_ids=$shade_ids.$value->shade_id."\n";

}
//print_r($shade_ids);
//echo "<pre>";print_r($model3); echo "</pre>"?>
    <?php //echo $form->field($model3, 'shade_id')->textarea(['maxlength' => true,'rows' => 6,'style'=>'width:500px','id'=>'inputfield','oninput'=>'myfunction()']) ?>

     <?php 
     // $form = ActiveForm::begin(); 
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
<!-- 
/*
///////////////////
*/
deleting from here
 -->

<!-- 

///////////////////
///////////////////
deleting till here 
-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Order' : 'Update Order', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
var data = [];//new Array();
      // data['0'] = 'hi';
      // data['1'] = 'bye';
      // data['4']='sdf';
      // data['3']='3';

      var newHTML = [];
/////

/////

function toggle_func(){
  var x=  document.getElementById('hiddenDiv');//.toggle();
  if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}


/*
// console.log($id);
    // newHTML.push('<span>' + data[0] + '</span>');
  //   for (var key in data) {
  // // console.log("key " + key + " has value " + myArray[key]);
  //   newHTML.push('<span>' key +" "+ data[key] + '</span>');

  //     }
  // var lastWord = document.getElementById("inputfield").value.match(/\w+$/)[0];
// var lastWord = document.getElementById("inputfield").value.split("-").pop();

// var lastWord = document.getElementById("inputfield").value.split(" ");
// lastWord= lastWord[lastWord.length - 1];
var lastWord = document.getElementById("inputfield").value.split("\n");//.split("/n").splice(-1)[0];

// console.log(lastWord);
// console.log(lastWord[lastWord.length - 2]);
lastWord=lastWord[lastWord.length - 2]


if(lastWord[0]=='0')
{
  lastWord=lastWord.substr(1);
}
if(lastWord[0]=='0')
{
 lastWord=lastWord.substr(1); 
}


if (lastWord=='801')
{
  lastWord='White';
}
else if(lastWord=='802')
{
  lastWord='Black'; 
}
else if(lastWord=='803')
{
  lastWord='Red';
}
        var newHTML = [];



        if (lastWord in data){
            data[lastWord]+=1;

        }
        else{
          data[lastWord]=1;
        }
      // for (var i = 0; i < data.length; i++) {
        for (var i in data){
          // console.log( data[i]);
    newHTML.push('<div>' + '<span>' + "Shade " + i+ '</span>' + '<span style="float:right">'+"   Quantity: "+data[i] +'</span>'+ '</div>' );
}
// newHTML="underconstruction";


    document.getElementById("myid").innerHTML=newHTML.join(" ");
 
  }
*/
         // window.onload = myfunction($all_shades );
         // alert('<?php echo json_encode($all_shades)?>');
        var all_s = '<?php  echo ($all_shades) ;?>';
        setTimeout(function(){ 
              myfunction(all_s);//console.log(all_s+'sl');
        // alert("Hello"); 
      }, 2000);



</script>