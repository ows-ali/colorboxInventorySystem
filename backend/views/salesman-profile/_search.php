<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SalesmanProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesman-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'salesman_id') ?>

    <?= $form->field($model, 'salesman_name') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'joining_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
