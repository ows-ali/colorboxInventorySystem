<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfile */

$this->title = $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
  // \Yii::$app->getSession()->getFlash('success');
?>


<div class="customer-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->customer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->customer_id], [
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
            // 'customer_id',
            'customer_name',
            'address:ntext',
            'phone_number1',
            'phone_number2',
            'phone_number3',
            'customer_type',
            'description:ntext',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
