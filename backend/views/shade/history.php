<?php
use yii\helpers\Html;
use common\models\InventoryIn;

?>

<?php
$this->params['breadcrumbs'][] = ['label' => 'Inventory', 'url' => ['index']];
$this->params['breadcrumbs'][] = "History";


?>
    <h1><?= Html::encode("Inventory History") ?></h1>

	<p>
        <?= Html::a('Back To Inventory', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="shade-history">





	            <ul class="timeline timeline-inverse">
                  
                  <!-- timeline item -->
                <?php

                $histories=InventoryIn::find()->orderBy(['created_at' => SORT_DESC])->limit(800)->all();
                foreach ($histories as $key => $history) {
                  # code...
                	// echo $history->shade_id;
                
                ?>

                  <li>
                    <i class="fa fa-check-square-o bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 
                        <!-- 5 mins ago -->
                        <?php 
                        $date = $history->created_at;

						$createDate = new DateTime($date);

						$strip = $createDate->format('d-m-Y');

                        echo $strip;
?>
                      </span>

                      <h3 class="timeline-header no-border">Shade: <a href="#">
                        <?php 
                	echo $history->shade_id;
                        ?>
                        <!-- Sarah Young -->


                      </a> of quantity<span style="margin-right:5px;;margin-left:5px;" class="bg-green">
                      <?php
                      echo $history->quantity;
                      ?>
                    </span>
                    	added in the inventory.
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <?php
                  }
                  ?>

                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>



</div>