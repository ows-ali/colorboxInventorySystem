<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SalesmanProfile */

$this->title = 'Create Salesman Profile';
$this->params['breadcrumbs'][] = ['label' => 'Salesman Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesman-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
