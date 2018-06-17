<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SalesmanProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salesman Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesman-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Salesman Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'salesman_id',
            'salesman_name',
            'phone_number',
            'address:ntext',
            'joining_date',


              [
          'class' => 'yii\grid\ActionColumn',
          'visible' => (Yii::$app->user->identity->name=="Admin"),
          'header' => '',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{view}{update}',
          'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'quantity-update'),
                                ]);
                        },
                        

            'edit' => function ($url, $model) {
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
