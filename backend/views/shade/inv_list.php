<?php

use yii\helpers\Html;
use common\models\Shade;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\CustomerProfile;
use common\models\SalesmanProfile;
use common\models\Order;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $model common\models\Order */






if ($type=="viewpdf")
{

$this->title = "Color Box";//$model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="order-view">

    <div style="text-align:center;">
        <h2>Company Name<br>
            <span style="font-size:25px;">(<?= Html::encode($this->title) ?>)
        <span style="font-size:10px;margin-top:0px;"><br>Address: Shop no X, Street No. X, Area XYZ, Karachi, Pakistan  <br> Cell: 0312-xxxxxxx, 0335-xxxxxxx  Email: owaisali.cs@gmail.com</span>
    </span>
</h2>
    </div>






<div>
    <b>Total Items in Inventory: </b><?php

    $iter=0;
    $sum=0;
    foreach ($model2 as $key => $value) {
        $sum+=$model2[$iter]->quantity;
        $iter+=1;

        # code...
    }



$str=$sum;

     echo $str;
     ?>
</div>




<br>
<br>
<?php
}

/*
//////////////////////////////////////////
//////////////////////////////////////////



*/


?>


<?php 
echo $this->render('../order/shade_1_to_800', array('model'=>$model,'model2'=>$model2));

// die();

?>

          <!-- /.box -->
</div>
