<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Order;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','forgraphs','for_sub_graphs'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actionFor_sub_graphs()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $year_val = $_POST['year_val'];
        $month_val = $_POST['month_val'];
        $all_months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        foreach ($all_months as $key => $value) {
            # code...
            if($value==$month_val){
                $month_val = $key+1;
                break;
            }
        }
        $all_days=['Week 1','Week 2','Week 3','Week 4'];
        $weeks = [];
        // $months[] = 'Jan';
        // $months[]='Feb';
        $orders = [];
        // foreach ($all_months as $key => $value) {
            # code...


            // if ( date($year_val,'-'.$key+1) <= date('Y-m')  ) {
                // $months[] = $value;
                $orders_per_month = Order::find()->where(['>=', 'created_at',date($year_val.'-'.($month_val).'-01 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-'.($month_val).'-07 23:59:59')])->all();
                $orders[]=sizeof($orders_per_month);


                // $months[] = $value;
                $orders_per_month = Order::find()->where(['>=', 'created_at',date($year_val.'-'.($month_val).'-08 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-'.($month_val).'-14 23:59:59')])->all();
                $orders[]=sizeof($orders_per_month);


                // $months[] = $value;
                $orders_per_month = Order::find()->where(['>=', 'created_at',date($year_val.'-'.($month_val).'-15 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-'.($month_val).'-21 23:59:59')])->all();
                $orders[]=sizeof($orders_per_month);

                // $months[] = $value;
                $orders_per_month = Order::find()->where(['>=', 'created_at',date($year_val.'-'.($month_val).'-22 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-'.($month_val).'-31 23:59:59')])->all();
                $orders[]=sizeof($orders_per_month);

                # code...
            // }
        // }
        // $orders_arr = Order::find()->where(['>=', 'created_at',date($year_val.'-01-01 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-01-31 00:00:00')])->all();
        // $orders[] =sizeof($orders);
        // $orders[]=99;

        $ret = [];
        $ret[]=$orders;
        $ret[]=$all_days;

        return $ret;
    }
    public function actionForgraphs(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $year_val = $_POST['year_val'];
        $all_months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $months = [];
        // $months[] = 'Jan';
        // $months[]='Feb';
        $orders = [];
        foreach ($all_months as $key => $value) {
            # code...


            if ( date($year_val,'-'.$key+1) <= date('Y-m')  ) {
                $months[] = $value;
                $orders_per_month = Order::find()->where(['>=', 'created_at',date($year_val.'-'.($key+1).'-01 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-'.($key+1).'-31 23:59:59')])->all();
                $orders[]=sizeof($orders_per_month);
                # code...
            }
        }
        // $orders_arr = Order::find()->where(['>=', 'created_at',date($year_val.'-01-01 00:00:00')])->andWhere(['<', 'created_at',date($year_val.'-01-31 00:00:00')])->all();
        // $orders[] =sizeof($orders);
        // $orders[]=99;

        $ret = [];
        $ret[]=$orders;
        $ret[]=$months;

        return $ret;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'guest';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
}
