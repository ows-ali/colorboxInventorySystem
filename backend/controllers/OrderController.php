<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\Order;
use common\models\Shade;
use common\models\Orderdetail;
use common\models\OrderSearch;
use common\models\CustomerProfile;
use common\models\BarcodeForm;
use common\models\SalesmanProfile;
use common\models\InventoryOut;
use FPDF;
use mPDF;

use common\models\Efpdf;

use common\models\Barcode;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // echo "<pre>";
        // print_r($dataProvider);
        // die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTotalshades()
    {

           return \yii\helpers\Json::encode( (Shade::find()->select(['shade_name'])->column() )) ;
    }


    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model2 = Orderdetail::find()->where(['order_id' => $id])->andWhere(['status'=>'1'])->orderBy(['shade_id'=>SORT_ASC])->all();
        // echo "<pre>";
        // print_r($model2);
        // die();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model2' => $model2,
            'type'=>"view",
        ]);

    }

    public function actionUpdate2($id)
    {

      $model2 = Orderdetail::find()->where(['order_id' => $id])->orderBy(['shade_id'=>SORT_ASC])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'model2' => $model2,
            'type'=>"view",
        ]);

    }

    public function actionViewpdf($id) 
    {
      // get your HTML raw content without any layouts or scripts

   
      // require_once __DIR__ . '/../../vendor/autoload.php';
      // setup kartik\mpdf\Pdf component
      $mpdf = new mPDF('utf-8', 'A4-P');

      $model2=Orderdetail::find()->where(['order_id' => $id])->andWhere(['status'=>'1'])->orderBy(['shade_id'=>SORT_ASC])->all();


      $iter=0;
      $sum=0;
      foreach ($model2 as $key => $value) {
          $sum+=$model2[$iter]->quantity;
          $iter+=1;

          # code...
      }



      $str="Total Boxes: ".$sum;
      // $mpdf->SetHeader($str);
      $mpdf->WriteHTML($this->renderPartial('view',['model'=>$this->findModel($id),'model2'=>$model2,'type'=>"viewpdf"] ));
      $mpdf->Output('colorbox_order_'.date('d-m-Y').'.pdf','D');
      $content = $this->renderPartial('sample');
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


    public function actionBarcode()
    {

      /*

      Set your printer to 70.5mm x 20mm
      with 3mm gap
      (print 1 page per image)

      auto  centre
      margins 0:if it asks
      */
        $model = new BarcodeForm();




     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

          $fontSize = 10;
          $marge    = 10;   // between barcode and hri in pixel
          $x        = 70-15;  // barcode center
          $y        = 30;  // barcode center
          $height   = 50;   // barcode height in 1D ; module size in 2D
          $width    = 1.8;    // barcode height in 1D ; not use in 2D
          $angle    = 0;   // rotation in degrees
          
          $type     = 'code128';
          $black    = '000000'; // color in hexa
          

        define('FPDF_FONTPATH',Yii::$app->basePath.'/../vendor/setasign/fpdf/font/'); 

        if(class_exists('FPDF')) { 


        } else { 
            // print_r("without class");
            die;

            // Die Klasse existiert nicht 
            die("Die Klasse FPDF existiert nicht. Prüfen Sie, ob die Datei '".FPDF_INSTALLDIR."/fpdf.php' vorhanden ist."); 
        } 




        $pdf = new FPDF('L','pt',array(381,102));
        $font =  Yii::$app->basePath.'/../vendor/setasign/fpdf/font/arial.ttf';//   $pdf->GetFont('Arial','B',$fontSize);
         $black    = '000000'; // color in hexa
         $mydata='50/3 Polyester';
        $pagewid = $pdf->GetPageWidth()+38;
        foreach ($_POST['shadenum'] as $key => $value) {

          # code...
          $code     =($value); // barcode, of course ;)
            $code2= $value;
            if (strlen($code)==1){


              $code='00'.$code;

              $code2='00'.$code2;
            }
            elseif (strlen($code)==2){


              $code='0'.$code;

              $code2='0'.$code2;
            }
              

          // $pdf = new FPDF('L','pt',array(390,90));
        //70.2 20.4
        $shade_with_namess = Shade::find()->select('shade_name')->where(['>=', 'shade_id','801'])->column();
         // $shade_with_names = array_combine(range(800, count($shade_with_names)), array_values($shade_with_names));
        $shade_with_names =[];
         foreach($shade_with_namess as $key => $value)
          { 
            $shade_with_names[$key+801] = $value; 
          }

          for ($i =1;$i<=$model->quantity/2;$i++){

          $pdf->AddPage();
                
        $data = Barcode::fpdf($pdf, $black, $x+10+10, $y, $angle, $type, array('code'=>$code), $width, $height);


        // if ( isset($font) )
        // {
              
          $pdf->SetFont('Arial','B',$fontSize+25);
        // $pdf->SetTextColor(0, 0, 0);
        $len = $pdf->GetStringWidth($mydata);
         Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
       //   imagettftext($pdf, $fontSize, $angle, $x + $xt , $y + $yt , $black, $font, $mydata);

        if($data['hri'] <= 800)//   $data['hri']!=801 && $data['hri']!=802 && $data['hri']!=803 )
        {  $pdf->Text($x + $xt+10+10+80, $y + $yt+5+2, $data['hri']);    //$data['hri']
        }


         $box2 = imagettfbbox($fontSize+5, 0, $font, $data['hri']);
          // 
           $wid = $box2[2] - $box2[0];
           $dataheight = $box2[1] - $box2[7];

           //seting the font size for white balck red for left side barcode label

          $pdf->SetFont('Arial','B',$fontSize+15);

      // print_r($shade_with_names );die();
          if($data['hri']>=801 ){
              
              //$pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'White');
                $pdf->Text($x + $xt+10+10+80, $y + $yt, $shade_with_names[$data['hri']]);    //$data['hri']

           }
                
          else{
            $pdf->SetFont('Arial','B',$fontSize+10);
         //   $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), $data['hri']);
          }
        // $data = Barcode::fpdf($pdf, $black, $x+$wid+($data['width'])+5+5+10+30, $y, $angle, $type, array('code'=>$code2), $width, $height);

        $data = Barcode::fpdf($pdf, $black, $x+ ($pagewid/2)+5+5+10, $y, $angle, $type, array('code'=>$code2), $width, $height);

        // }


        //setting the font of right barcde
        $pdf->SetFont('Arial','B',$fontSize+25);
        

         Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        //  imagettftext($im, $fontSize, $angle, $x + $xt +$wid+($data['width'])+5+5, $y + $yt , $black, $font, $mydata);

        if($data['hri'] <= 800)// !=801 && $data['hri']!=802 && $data['hri']!=803 )
        {
          $pdf->Text($x + $xt+($pagewid/2)+5+5+5+5+80, $y + $yt+5+2, $data['hri']);
        }

        $pdf->SetFont('Arial','B',$fontSize+15);

          if($code2>=801 ){
            //$pdf->Text(($pagewid/2)+$x+($data['width']/2)+2+ 10+ 10, $y+($dataheight/2), 'White');
               $pdf->Text($x + $xt+($pagewid/2)+5+5+5+5+80, $y + $yt, $shade_with_names[$code2]);
              // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'White');

           }
           
          else{
            $pdf->SetFont('Arial','B',$fontSize+10);
           
          }

      /* For Loop End Below */
      }
      //below if condition prints one more barcode if the quantity is odd


      if ($model->quantity%2==1)
      {

        $pdf->AddPage();
        
        // -------------------------------------------------- //
        //                      BARCODE
        // -------------------------------------------------- //
        $data = Barcode::fpdf($pdf, $black, $x+10+10, $y, $angle, $type, array('code'=>$code), $width, $height);


        // if ( isset($font) )
        // {
              
          $pdf->SetFont('Arial','B',$fontSize+25);
        // $pdf->SetTextColor(0, 0, 0);
        $len = $pdf->GetStringWidth($mydata);
         Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
       //   imagettftext($pdf, $fontSize, $angle, $x + $xt , $y + $yt , $black, $font, $mydata);
        
        if($data['hri']<=800)// && $data['hri']!=802 && $data['hri']!=803 )
        {
          $pdf->Text($x + $xt+10+10+80, $y + $yt+5+2, $data['hri']);
        }
         $box2 = imagettfbbox($fontSize+5, 0, $font, $data['hri']);
          // 
           $wid = $box2[2] - $box2[0];
           $dataheight = $box2[1] - $box2[7];

              $pdf->SetFont('Arial','B',$fontSize+15);
          
          if($data['hri']>=801 ){
              //$pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'White');
              $pdf->Text($x + $xt+10+10+80, $y + $yt, $shade_with_names[$data['hri']]);


           }
           
          else{
            $pdf->SetFont('Arial','B',$fontSize+10);
          }

        /* if ends here*/
      }

      /* For Each Loop End Below */ 
        }

        // $pdf->Output();

        //use below command to ask user to save
        $pdf->Output('D','Barcodes_Printed_On_'.date('d-m-Y').'.pdf');
      exit();

            return $this->render('barcode', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('barcode', ['model' => $model]);
        }


    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Order();
        $model2 = new Orderdetail();


        $model3  = new InventoryOut();
        if ($model->load(Yii::$app->request->post()) ){// &&    $model->save() ){

                $total_shades = Shade::find()->all();
                $total_shades = sizeof($total_shades);
          
                $items = array_fill('1',strval($total_shades), 0);

            if ($model3->load(Yii::$app->request->post() )){

                $new_array = explode("\n", $_POST['InventoryOut']['shade_id']);//$model3->shade_id);
                // print_r($new_array);
                //   die;

                foreach ($new_array as $key => $value) {
                    // print_r($value);
                    // die;
                    if ($value)
                    {
                        if ( ( strpos( $value, '.' ) === false ) && $value >0 && $value <= $total_shades && Shade::find()->where(['shade_id'=>intval($value)])->one()->quantity >= ($items[intval($value)]+1))

                        {
                            $items[intval($value)]=$items[intval($value)]+1;
                        }
                        else
                        {
                            // die;
                            \Yii::$app->getSession()->setFlash('error', 'Invalid Shade IDs Input: '.$value);

                            $type = 'create';
                            return $this->render('create',

                             [
                                'model' => $model,
                                'model2' => $model2,
                                'type' => $type,
                                'model3'=>$model3,
                            ]


                            // array('model'=>$model,'model2'=>$model2)
                            );                                       
                        }
                    }

                # code...
                }//foreach

            }   // if
            // print_r($items);
            // die;
            //saving the $model on successful checking of submitted data
            $model->save();
            foreach ($items as $key => $value) {

                if ($value>0) {
                    $modelentry=new InventoryOut();
                    $modelentry->shade_id=$key;
                    $modelentry->quantity=$value;
                    $modelentry->salesman_id=$model->salesman_id;
                    $modelentry->customer_id=$model->customer_id;
                    $modelentry->save();

                             
                   //don't uncomment this part if u wnt to add shades


                    $shadeupdate = Shade::findOne($key);//;new Shade();
                    $shadeupdate->quantity = $shadeupdate->quantity-$value;
                    $shadeupdate->save();

                        $model4 = new Orderdetail();

                        $model4->shade_id = $key;//shade_id+1;
                        $model4->quantity = $value;//quantity;
                        $model4->status = '1';
                        $model4->order_id = $model->order_id;
                        date_default_timezone_set('Asia/Karachi');
                   //     echo "hi";
                     //   echo date('Y-m-d H:i:s');
                        // die;
                       $model4->created_at = date('Y-m-d h:i:s');


                        $model4->save();
                    
                }//if
                # code...
            }//foreach


              \Yii::$app->getSession()->setFlash('success', 'Order created successfully!');

            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            $type = 'create';
            return $this->render('create',

             [
                'model' => $model,
                'model2' => $model2,
                'type' => $type,
                'model3'=>$model3,
            ]


            // array('model'=>$model,'model2'=>$model2)
            );
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ){//&& $model->save()) {

          $total_shades = Shade::find()->all();
          $total_shades = sizeof($total_shades);

          $items = array_fill('1',strval($total_shades), 0);


          if($this->findModel($id)->status=="Approved"  )
          {
            $model->save();

            \Yii::$app->getSession()->setFlash('success', 'Order updated successfully!');
            return $this->redirect(['view', 'id' => $model->order_id]);
          }
          if ($this->findModel($id)->status=="Pending" && $model->status=="Approved"   )
          {
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Order updated successfully!');
            return $this->redirect(['view', 'id' => $model->order_id]);


          }
          if ($_POST['shade_ids'] && isset($_POST['edit_detail']) && $_POST['edit_detail']==1){//$model3->load(Yii::$app->request->post() )){

            $new_array = explode("\n", $_POST['shade_ids']);//$model3->shade_id);
            // print_r($new_array);
            //   die;

            foreach ($new_array as $key => $value) {
                // print_r($value);
                // die;
                if ($value)
                {
                    if ( ( strpos( $value, '.' ) === false ) && $value >0 && $value <= $total_shades && Shade::find()->where(['shade_id'=>intval($value)])->one()->quantity >= ($items[intval($value)]+1))
                    {
                      // die()
                        $items[intval($value)]=$items[intval($value)]+1;
                    }
                    else
                    {
                        // die;
                        \Yii::$app->getSession()->setFlash('error', 'Invalid Shade IDs Input (check items available in inventory): '.$value);

                        $type = 'edit';
                        return $this->render('update',

                         [
                            'model' => $model,
                            //'model2' => $model2,
                            'type' => $type,
                            //'model3'=>$model3,
                        ]


                        // array('model'=>$model,'model2'=>$model2)
                        );           
                        
                    }

                }

                # code...
            }//foreach

          }   // if condition ends to check if the input of shade ids is valid
        //if the order was already approved, you will not be allowed to chnge order_detail/orderitems

            $ord_details=Orderdetail::find()->where(['order_id'=>$id])->andWhere(['status'=>'1'])->all();
            // print_r($ord_details);
            // die();  
            echo "<pre>";
            foreach ($ord_details as $key => $value) {

              $value->status='0';
              $value->save();


              $shadeupdate = Shade::findOne($value->shade_id);//;new Shade();
              // print_r($shadeupdate);
              // die();
              $shadeupdate->quantity = $shadeupdate->quantity+$value->quantity;
              $shadeupdate->save();

              # code...
            }

            foreach ($items as $key => $value) {

                if ($value>0){
                    


                    $shadeupdate = Shade::findOne($key);//;new Shade();
                    $shadeupdate->quantity = $shadeupdate->quantity-$value;
                    $shadeupdate->save();

                    $model4 = new Orderdetail();

                    $model4->shade_id = $key;//shade_id+1;
                    $model4->quantity = $value;//quantity;
                    $model4->status = '1';
                    $model4->order_id = $model->order_id;
                    date_default_timezone_set('Asia/Karachi');
              
                   $model4->created_at = date('Y-m-d h:i:s');

                    $model4->save();
                



                }//if
                # code...
            }//foreach


            \Yii::$app->getSession()->setFlash('success', 'Order updated successfully!');
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {

          $type='edit';
            return $this->render('update', [
                'model' => $model,
  //              'model2'=>$model2,
                'type' => $type,
            ]);
  




        }

    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->redirect(['index']);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
}
