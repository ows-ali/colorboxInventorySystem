<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orderdetail */

$this->title = $model->orderdetail_id;
$this->params['breadcrumbs'][] = ['label' => 'Orderdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderdetail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->orderdetail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->orderdetail_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'orderdetail_id',
            'order_id',
            'shade_id',
            'quantity',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
