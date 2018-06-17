<?php

namespace backend\controllers;

use Yii;
use common\models\Shade;
use common\models\ShadeSearch;
use common\models\InventoryIn;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;
use common\models\Notification;
/**
 * ShadeController implements the CRUD actions for Shade model.
 */
class ShadeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Shade models.
     * @return mixed
     */

    public function actionDelete_notification()
    {

        $notification_id=Yii::$app->request->post('id');
        $notification = Notification::find()->where(['id'=>$notification_id])->one();
        
        $notification->status=0;
        $notification->save();

      return "bye bye";
    }
    public function actionHistory()
    {


      return $this->render('history');
    }
    public function actionIndex()
    {
        $searchModel = new ShadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $model = Shade::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shade model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
public function actionViewpdf() {
    // get your HTML raw content without any layouts or scripts

 
    // require_once __DIR__ . '/../../vendor/autoload.php';
    // setup kartik\mpdf\Pdf component
$mpdf = new mPDF('utf-8', 'A4-P');
// $con=renderPartial('sample');

/////////////////////
 /*
 $model2 = Orderdetail::find()->where(['order_id' => $id])->orderBy(['shade_id'=>SORT_ASC])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'model2' => $model2,
        ]);

*/

//////////////////
// $id=4;

$model2=Shade::find()->all();//Orderdetail::find()->where(['order_id' => $id])->orderBy(['shade_id'=>SORT_ASC])->all();


    $iter=0;
    $sum=0;
    foreach ($model2 as $key => $value) {
        $sum+=$model2[$iter]->quantity;
        $iter+=1;

        # code...
    }



$str=$sum;
// $mpdf->SetHTMLHeader('<div >Printed on:'.date('d M Y').'</div><div style="float: right; ">Page: {PAGENO}</div>');
$mpdf->SetHTMLHeader('<div>



<div style="float: right; width: 8%;">

<b>Page:</b> {PAGENO}
</div>

<div >


<b>Printed on: </b> '.date('d M Y').'

</div>

<div style="clear: both; margin: 0pt; padding: 0pt; "></div>



</div>');
// $mpdf->SetHeader('Document Title|{PAGENO}');
$mpdf->WriteHTML($this->renderPartial('inv_list',['model2'=>$model2,'type'=>"viewpdf"] ));
$mpdf->Output('colorbox_order_'.date('d-m-Y').'.pdf','D');
// $mpdf->Output('colorbox_order_'.date('d-m-Y').'.pdf','I');
////////////////////
////////////////////
/////////////////

///////////////////
/////////////////
/////////////////////
   // $content = $this->renderPartial('sample');//['view', 'id' => 46]);
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        // 'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        // any css to be embedded if required
        'cssInline' => '.kv-heading-1{font-size:18px}', 
         // set mPDF properties on the fly
        'options' => ['title' => 'Krajee Report Title'],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetHeader'=>['Krajee Report Header'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    
    // return the pdf output as per the destination setting
    return $pdf->render(); 
}

    /**
     * Creates a new Shade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $searchModel = new ShadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $total_shades = Shade::find()->all();
        $total_shades = sizeof($total_shades);
        // print_r (sizeof($total_shades));die();
        $items = array_fill('1',strval($total_shades), 0);
        // echo "<pre>";
        // $a[1]="p";
        // $a[2]=99;
        // print_r($a[1]);
        // print_r($items);
        // die;

        $model  = new InventoryIn();

        if ($model->load(Yii::$app->request->post()) ){//&& $model->save()) {
        // echo "<pre>";
        // print_r($_POST);
        // die;
            $new_array = explode("\n", $model->shade_id);
            // print_r(is_numeric($new_array[0]) ) ;
            // print_r(1);
            // print_r(is_numeric(9));
            // die();

            foreach ($new_array as $key => $value) {
                // print_r($value);
                // die;
                if ($value)
                {
                    if ( ( strpos( $value, '.' ) === false ) && $value >0 && $value <= $total_shades )
                
                    {$items[intval($value)]=$items[intval($value)]+1;}

                    else 
                    {
                          \Yii::$app->getSession()->setFlash('error', 'Invalid Shade IDs Input! Please enter values line by line without extra spaces and/or special characters!');

                            return $this->render('create', [
                'model' => $model,]);
                    }
                }

                # code...
            }
            // print_r($items);
            // die;

            foreach ($items as $key => $value) {

                if ($value>0){
                    $modelentry=new InventoryIn();
                    $modelentry->shade_id=$key;
                    $modelentry->quantity=$value;
                    $modelentry->save();

                             
                   //don't uncomment this part if u wnt to add shades


                    $shadeupdate = Shade::findOne($key);//;new Shade();
                    $shadeupdate->quantity = $shadeupdate->quantity+$value;
                    $shadeupdate->save();

                    



                }
                # code...
            }   



            // die;




    //        return $this->redirect(['view', 'id' => $model->shade_id]);
  \Yii::$app->getSession()->setFlash('success', 'New Items added in the Inventory successfully!');

            return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Shade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->shade_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Shade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Shade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Shade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
