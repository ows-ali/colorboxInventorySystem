<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Orderdetail */

$this->title = 'Update Orderdetail: ' . $model->orderdetail_id;
$this->params['breadcrumbs'][] = ['label' => 'Orderdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->orderdetail_id, 'url' => ['view', 'id' => $model->orderdetail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orderdetail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
