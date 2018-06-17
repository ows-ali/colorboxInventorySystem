<?php

use yii\helpers\Html;
use yii\grid\GridView;


use common\models\CustomerProfile;

use common\models\SalesmanProfile;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

 <h1><?= Html::encode($this->title) ?></h1> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
        $val = 0;
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'model'=> $model,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'order_id',
            // 'customer_id',

            [
            'attribute'=>'customer_id',
            'value'=>'customer.customer_name'
            // 'label'=>'Customer Name',
            // 'format'=>'text',//raw, html
            // 'value' => CustomerProfile::find()->where(['customer_id'=>'customer_id'])->all()->customer_name,//One($model->customer_id)->customer_name,
            // 'content'=>CustomerProfile::find()->all(),
            ],


            // ['value'=>CustomerProfile.customer_name],
            // 'salesman_id',
            [
                'attribute'=> 'salesman_id',
                'value'=>'salesman.salesman_name',
            ],
            [
            'attribute' => 'order_date',
            //'format' => ['raw', 'Y-m-d H:i:s'],
            'format' =>  ['date', 'php:d-m-Y'],
            // 'options' => ['width' => '200']
            ],

            // 'order_date',
            'status',
            // 'created_at',
            // 'approved_at',
            // 'delivered_at',
            // 'cancelled_at',

            [
          'class' => 'yii\grid\ActionColumn',
          // 'visible' => (Yii::$app->user->identity->name=="Admin"),
          'header' => 'View',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{view}',
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'quantity-update'),
                                ]);
                        },
                        ],
          ],

            [
          'class' => 'yii\grid\ActionColumn',
          // 'visible' => (Yii::$app->user->identity->name=="Admin"),
          'header' => 'Edit',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{update}',
          'buttons' => [
            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'quantity-update'),
                ]);
            },

          ],
          ],
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
