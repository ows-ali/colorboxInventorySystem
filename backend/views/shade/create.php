<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Shade */

// $this->title = 'Create Shade';
$this->params['breadcrumbs'][] = ['label' => 'Shades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        // 'model3'=>$model3,
    ]) ?>

</div>
