<?php

use yii\helpers\Html;
use common\models\Shade;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\models\CustomerProfile;
use common\models\SalesmanProfile;
use common\models\Order;
use common\models\OrderDetail;
// use yii\helpers\ArrayHelper;

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


        <div style="float: left; width: 54%;">
    <b>Customer Name: </b><?php echo CustomerProfile::findOne($model->customer_id)->customer_name ?>


        </div>

        <div style="float: right; width: 28%;">
    <b>Date: </b><?php echo date("d-m-Y"); ?>
        
        </div>
    </div>


    <div>

        <div style="float: left; width: 54%;">
    <b>Address: </b><?php echo CustomerProfile::findOne($model->customer_id)->address ?>
        

        </div>
            <div style="float: right; width: 28%;">

        <b>Phone: </b><?php echo SalesmanProfile::findOne($model->salesman_id)->phone_number ?>
        <!-- This is text that is set to float:right. -->


        </div>

    </div>

    <div>
        <br>
        <b>Salesman: </b><?php echo SalesmanProfile::findOne($model->salesman_id)->salesman_name ?>
    </div>



    <div>
        <b>Total Boxes: </b><?php

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
elseif ($type=="view") {

    $this->title = $model->order_id;
    $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;

      \Yii::$app->getSession()->getFlash('success');


    ?>

    <div class="order-view">

        <h1><?php
        // echo Html::encode($this->title) ?></h1>

        <p>

    <?php
    if (Order::findOne($model->order_id)->status=="Approved" )//&& Yii::$app->user->identity->name=="Admin")
    {

    ?>
    <div style="float:right;">
            <?= Html::a('Get Packing List', ['viewpdf', 'id' => $model->order_id], ['class' => 'btn btn-success']) ?>

    </div>
    <?php
    }

    else
    {

    echo "Note: Packing List will be printed after the order is Approved!";
    ?>
    <br>
    <?php
    }


     if (Yii::$app->user->identity->name=="Admin"){
    ?>
                

            <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
     <?php } ?>       
            <?php
           
            ?>

        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'order_id',

                // 'customerprofile.customer_name',
                [   
                    'attribute'=>'customer_id',
                    'value'=>   CustomerProfile::findOne($model->customer_id)->customer_name,
                ],


                [   
                    'attribute'=>'salesman_id',
                    'value'=>   SalesmanProfile::findOne($model->salesman_id)->salesman_name,
                ],

                // 'salesman_id',
                'order_date',
                'status',
                // 'created_at',
                'approved_at',
                'delivered_at',
                // 'cancelled_at',
            ],
        ]) 


    ?>
    <?php
    /*
    //////////////////////////////
    /////////////////////////////
    */
}

echo $this->render('shade_1_to_800', array('model'=>$model,'model2'=>$model2));

?>

</div>
