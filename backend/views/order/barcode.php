<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Shade;


use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = "Generate Barcodes";//$model->order_id;

// $this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">


<?php $form = ActiveForm::begin(); ?>



     <?php echo $form->field($model, 'quantity')->textinput(['style'=>'width:500px'])
     ?>
  
</div>

<?php 
    $shades = Shade::find()->where(['<=','shade_id','800'])->orderBy('shade_name')->asArray()->all(); 
     // create an array of pairs ('id', 'type-name'):
    $shadeList = ArrayHelper::map($shades, 'shade_id', 'shade_name'); 
     // finally create the drop-down list:
?>

<?php

$len=sizeof($shadeList);
$ptr=1;
$ptr2=1;
$indptr=0;
$var=20;
$type="create";
$ind2=0;

?>



<style>
 table { table-layout: fixed; }
 table th, table td { overflow: hidden; }
</style>
 <div class="box">
<div class="box-body">

  <!--  -->
      <table class="table table-bordered table-hover">

<?php
$shade_names=Shade::find()->select(['shade_name'])->where(['>', 'shade_id',800])->column();
$shade_nums = Shade::find()->select(['shade_id'])->where(['>', 'shade_id',800])->column();
// print_r($shade_nums);


while($shade_names){
  ?>
<tr>
    <!-- <td style="width: 333%;background-color: #D0D0D0;font-size:10px;">White</td> -->

    <td style="width: 50%">
        
        <?php $shade_name =  array_shift($shade_names); if ($shade_name){echo ($shade_name);}else {}; ?>
        
    </td>
    <td style="width: 50%">
        
        <?php $shade_name =  array_shift($shade_names); if ($shade_name){echo ($shade_name);}else {}; ?>
        
    </td>
     <td style="width: 50%">
        
        <?php $shade_name =  array_shift($shade_names); if ($shade_name){echo ($shade_name);}else {}; ?>
        
    </td >



</tr>
<?php
// }
?>

<?php


?>
<tr>
    <?php  
    $shade_num =  array_shift($shade_nums); 
    if ($shade_num){
    ?>
            <td style="width: 50%">
                   <input type="checkbox" name="shadenum[]" value = <?php {echo ($shade_num);} ?> ></input>

                  
            </td>
    <?php  
  }
    $shade_num =  array_shift($shade_nums); 
    if ($shade_num){
    ?>
            <td style="width: 50%">
                 <input type="checkbox" name="shadenum[]" value = <?php   {echo ($shade_num);} ?>  ></input>

                
            </td>

    <?php  
  }
    $shade_num =  array_shift($shade_nums); 
    if ($shade_num){
    ?>     
             <td style="width: 50%">
                 <input type="checkbox" name="shadenum[]" value = <?php {echo ($shade_num);} ?>  ></input>

                
            </td >
      <?php } ?>

</tr>

<?php  }  ?>
</table>

<!--  -->
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
        <td style="width: 5.5%">
            <?php
                echo $shadeList[$ptr];
                $ptr=$ptr+1; 
                if ($ptr>$len){
                    break;
                }
            ?>
        </td>
<?php
       }

?>

  </tr>
  
  

  <tr>




<?php

if ($type=='create')
{
                    for ($i = 0 ;$i<$var;$i++){
         ?>
                            <td>
                                
 <input type="checkbox" name="shadenum[]" value = <?php echo $ptr2; ?> ></input>
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
                    <th><?php
                     // 0 
                     ?></th>
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
  <div class="form-group">
        <?= Html::submitButton('Generate Barcodes', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
