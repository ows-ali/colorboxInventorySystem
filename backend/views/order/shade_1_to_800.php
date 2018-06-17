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
?>
<?php 


        $shades = Shade::find()->orderBy('shade_name')->asArray()->all(); 
         // create an array of pairs ('id', 'type-name'):
        $shadeList = ArrayHelper::map($shades, 'shade_id', 'shade_name'); 
         // finally create the drop-down list:
?>

<?php

$len=800;//sizeof($shadeList)-3;
// print_r($len);
$ptr=1;
$ptr2=1;
$shadeptr = 0;
$indptr=0;
$var=25;
// $type="create";
$ind2=0;
$shade_with_name_ind = 801;

?>

<style>
 /*table { table-layout: fixed; }*/

  table { table-layout: fixed; border-collapse: collapse;}

 /*table tbody tr th{  background-color: #b0e0e6;} */
 table th, table td { overflow: hidden;text-align: center; }
table, th, td {
    border: 0.1px solid black;
}

</style>
 <div class="box">
<div class="box-body">
<?php
if (!empty($model->order_id))
{//echo "hohoho";

    $shade_quantities = ( ArrayHelper::map(OrderDetail::find()->where(['order_id'=>$model->order_id])->all(),'shade_id','quantity'));
    // print_r($shade_quantities);
}
else 
{
   // echo "stringd";
    $shades = Shade::find()->where(['>=','shade_id',801])->asArray()->all();
    //print_r($shades);
    // print_r($shades);
    // $shade_quantites = ( ArrayHelper::map(Shade::find()->where(['>=', 'shade_id',801])->asArray()->all(),'shade_id','quantity'));
    $shade_quantities = Shade::find()->select('quantity')->column();
    $shade_quantities = array_combine(range(1, count($shade_quantities)), array_values($shade_quantities));

    //( ArrayHelper::map( Shade::find()->where(['>=','shade_id',801])->all(),'shade_id','quantity'));
    //print_r($shade_quantities);//return;
}
$shade_with_names = Shade::find()->select('shade_name')->where(['>','shade_id',800])->column();
// print_r($shade_quantites);
if (1){//$type=='view'){

?>
<!-- class="table table-bordered table-hover" -->
      <table  style='width:100%'>

<!-- <table> -->
 <?php
// while ( sizeof($shadeList) ){
    
// }
?>

<?php //print_r($model2); 
// $shade_quantities = ArrayHelper::map( OrderDetail::find()->where(['order_id'=>$model->order_id])->asArray()->all()  , 'shade_id', 'quantity');

while($shade_with_names)
{

?>

<tr >

    <th style="background-color: #D0D0D0;font-size:10px;">
        <?php $shade_name =  array_shift($shade_with_names); if ($shade_name){echo ($shade_name);}else {}; ?>
    </th>
    <th style="background-color: #D0D0D0;font-size:10px;">
        <?php $shade_name =  array_shift($shade_with_names); if ($shade_name){echo ($shade_name);}else {}; ?>
        </th>
    <th style="background-color: #D0D0D0;font-size:10px;">
        <?php $shade_name =  array_shift($shade_with_names); if ($shade_name){echo ($shade_name);}else {}; ?>

    </th>
    
</tr>

<?php //}?>
 <!-- style="padding-left:350px;position:absolute;width:60%;background-color: #D0D0D0;font-size:10px;" -->

<tr>

    <td style="text-align:center;font-size:10px;font-weight:bold;height:24px">
        <?php
        $flag=0;
        // foreach ($model2 as $keyy => $valuee) {
        //     if ($model2[$keyy]->shade_id==803)
        //     {
        //         echo $model2[$keyy]->quantity;
        //         $flag=1;
        //         break;
        //     }
        //     # code...
        // }
        // $shade_quantity = OrderDetail::find()->where(['order_id'=>$model->order_id])->andWhere(['shade_id'=>$shade_with_name_ind])->one();
        echo (isset($shade_quantities[$shade_with_name_ind]))?$shade_quantities[$shade_with_name_ind]:'';
        $shade_with_name_ind+=1;

        // echo (!empty($shade_quantity))? $shade_quantity->quantity : "<br>";
        
        if ($flag==0)
        {
            // echo "<br>";
        }
        // print_r( $model2['802']);//['802']->quantity;  

        ?>
    </td>
    <td style="font-size:10px;font-weight:bold">
        <?php
        // echo isset($model2[801]).'d';
        // $flag=0;

        // foreach ($model2 as $keyy => $valuee) {
        //     if ($model2[$keyy]->shade_id==802)
        //     {
        //         echo $model2[$keyy]->quantity;
        //         $flag=1;
        //         break;
        //     }
        //     # code...
        // }
        // if ($flag==0)
        // {
        //     // echo "<br>";
        // }

        // $shade_quantity = OrderDetail::find()->where(['order_id'=>$model->order_id])->andWhere(['shade_id'=>$shade_with_name_ind])->one();
        echo (isset($shade_quantities[$shade_with_name_ind]))?$shade_quantities[$shade_with_name_ind]:'';
        $shade_with_name_ind+=1;

        // echo (!empty($shade_quantity))? $shade_quantity->quantity : "<br>";
        
        ?>


    </td>
    <td style="font-size:10px;font-weight:bold">
        <?php
        // $flag=0;
        // foreach ($model2 as $keyy => $valuee) {
        //     if ($model2[$keyy]->shade_id==801)
        //     {
        //         echo $model2[$keyy]->quantity;
        //         $flag=1;
        //         break;
        //     }
        //     # code...
        // }
        // if ($flag==0)
        // {
        //     // echo "<br>";
        // }

        // $shade_quantity = OrderDetail::find()->where(['order_id'=>$model->order_id])->andWhere(['shade_id'=>$shade_with_name_ind])->one();
        echo (isset($shade_quantities[$shade_with_name_ind]))?$shade_quantities[$shade_with_name_ind]:'';
        $shade_with_name_ind+=1;

        // echo (!empty($shade_quantity))? $shade_quantity->quantity : "<br>";
        
        ?>

    </td>


</tr>
<?php }?>
</table>
<?php } ?>

    <?php
    // }
    $type='create';
    ?>
              <table id="example2" class="table table-bordered table-hover">
                <thead>

                </thead>


                <tbody>


<?php                
                while ($ptr<=$len)
                {
?>                    

                <tr>

<?php

                    // $var=1;
                    for ($i = 0 ;$i<$var;$i++){
         ?>
                            <th style="width: 5.5%;background-color: #D0D0D0;font-size:10px;">
                                <?php
                                    echo $shadeList[$ptr];
                                    $ptr=$ptr+1; 
                                    if ($ptr>$len){
                                        break;
                                    }
                                ?>
                            </th>
<?php
                }

?>
    
                </tr>
                
                

                <tr>

<?php

// echo '<pre>';
// print_r($model);
// die;
                    // $var=18;
?>



<?php

// echo '<pre>';
// print_r($model);
// die;
                    // $var=18;
if (1)//$type=='create')
{
                    for ($i = 0 ;$i<$var;$i++){
         ?>
                            <td style="height:30px;">
                                <?php
                                     
// print_r($model2[0]);

// print_r($model);
// die;
// print_r($ptr2);
// die;
                                     //echo $form->field($model2[$ptr2-1],'quantity')->textinput(['maxlength' => true])->label(false);
//                                     echo $form->field($model,'quantity[]')->checkbox(array('label'=>''));//textinput(['maxlength' => true,])->label(false);
  

//my code here (uncommment above line)
                                
// echo "<pre>";
// print_r($model2[$shadeptr]->shade_id);
// die;


if ($shadeptr< sizeof($model2) && $model2[$shadeptr]->shade_id == $ptr2){
?>
  
  
    
<div  style="font-weight:bold;">
    <?php

 echo $model2[$shadeptr]->quantity;
 ?>
</div>
    <?php



    // echo $model2[$shadeptr]->quantity;
    $shadeptr=$shadeptr+1;
}


else
    echo " ";

?>

 <!-- <input type="checkbox" name="quantity1[]" value = <?php echo $ptr2; ?> ></input> -->


<?php

                                     // die;
                                     $ptr2=$ptr2+1;
                                     if ($ptr2>$len){
                                        break;
                                     }

                                ?>

                            </td>


<?php
                } //end for
            }// end if

            ?>

                </tr>

<?php
            }
?>            

                </tbody>


                
                <tfoot>
                <tr>

<?php

                    // $var=18;
                    for ($i = 0 ;$i<$var;$i++){
         ?>
         <!-- 
                            <th><?php
                            // echo 0 
                            ?></th>
                             -->
<?php
                }

?>
                </tr>


                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

