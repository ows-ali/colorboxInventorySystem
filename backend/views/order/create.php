<?php

use yii\helpers\Html;
use common\models\Orderdetail;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= $this->render('_form', [
        
        'model' => $model,

        'model2'=>$model2,
        'model3'=>$model3,
        'type' => $type,


    ]) ?>





</div>
