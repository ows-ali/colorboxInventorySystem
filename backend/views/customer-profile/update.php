<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfile */

$this->title = 'Update Customer Profile: ' . $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_id, 'url' => ['view', 'id' => $model->customer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
