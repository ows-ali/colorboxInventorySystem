<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\grid\DataColumn;
// use kartik\export\ExportMenu;
use common\models\Shade;
use yii\grid\SerialColumn;
// use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ShadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventory';
$this->params['breadcrumbs'][] = $this->title;
  \Yii::$app->getSession()->getFlash('success');

?>
<div class="shade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <div style="float:right;">
        <?= Html::a('Download Inventory List', ['viewpdf'], ['class' => 'btn btn-success']) ?>

        </div>

        <?= Html::a('Add Inventory', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Inventory History', ['history'], ['class' => 'btn btn-primary']) ?>

    </p>
    <?php    
    $gridColumns= [
        // ['class' => 'yii\grid\SerialColumn'],

        'shade_id',
        'shade_name',
        // 'gender',
        // 'male',
        [
  
           'label'=>'Male',
           // 'format'=>'raw',
           'attribute'=>'male',
           // 'value' => 'male' == 0 ? 'No' : 'Yes',  // <----- this bit is not working
          'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),

           // 'value' => function($model, $key, $index, $column) { return $model->male == 0 ? 'No' : 'Yes';},
          'value' => function($model) {
              return $model->male == 1 ? 'Yes' : 'No';
          }
        ],
        [
      

         'label'=>'Female',
         // 'header'=>'Female',
         'attribute'=>'female',

         'format'=>'boolean'
        
        ],
        // 'female',
        'quantity',
        // 'status',
        // 'created_at',
        [
          'class' => 'yii\grid\ActionColumn',
          'visible' => (Yii::$app->user->identity->name=="Admin"),
          'header' => 'Actions',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{update}',
          'buttons' => [
            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"> Change Quantity</span>', $url, [
                            'title' => Yii::t('app', 'quantity-update'),
                ]);
            },

            ],

        ],

            // ['class' => 'yii\grid\ActionColumn'],
    ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        // 'export'=>['fontAwesome'=>true],
            // 'resizableColumns'=>true,


        'columns' =>$gridColumns,
        'responsive'=>true,
    'hover'=>true,
    // 'condensed'=>true,
    // 'floatHeader'=>true,
    'bordered'=>true,
   'toolbar'=>[

    //   '{export}',
        '{toggleData}',
    ],
   
    'toggleData'=>[
            'showConfirmAlert'=>false,

    ],
   
    ]); ?>
</div>
