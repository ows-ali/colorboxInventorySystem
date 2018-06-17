<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Shade */

$this->title = 'Update Shade: ' . $model->shade_id;
$this->params['breadcrumbs'][] = ['label' => 'Shades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shade_id, 'url' => ['view', 'id' => $model->shade_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shade-update">

    <h1><?= Html::encode($this->title) ?></h1>

<!-- ///////////////////////
///////////////////////
///////////////////////
 -->



<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

<?php 
         // $customers = CustomerProfile::find()->orderBy('customer_name')->asArray()->all(); 
         // create an array of pairs ('id', 'type-name'):
         // $customerList = ArrayHelper::map($customers, 'customer_id', 'customer_name'); 
         // finally create the drop-down list:
?>
<?=
         // $form->field($model, 'quantity');//->textfield()
 $form->field($model, 'quantity')->textInput(['maxlength' => true,'style'=>'width:500px']) 

?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add Order' : 'Update Quantity', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- ///////////////////////
///////////////////////
///////////////////////
 -->
    <?php 
    // echo $this->render('_form', [
    //     'model' => $model,
    // ]) 
    ?>

</div>
