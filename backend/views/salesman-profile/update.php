<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SalesmanProfile */

$this->title = 'Update Salesman Profile: ' . $model->salesman_id;
$this->params['breadcrumbs'][] = ['label' => 'Salesman Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->salesman_id, 'url' => ['view', 'id' => $model->salesman_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salesman-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
