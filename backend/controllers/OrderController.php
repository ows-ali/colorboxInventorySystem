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
// use kartik\mpdf\Pdf;
// use mpdf\Mpdf;
// use mPDF;
// use common\models\PDF;
// use Efpdf;
// use common\models\Fpdf;
use common\models\Efpdf;

// require('setasign\fpdf\fpdf.php');
use common\models\Barcode;
// use @vendor\setasign\fpdf\fpdf;
//Yii::import('application.vendors.*');
// require_once('setasign/fpdf/fpdf.php');

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
// require_once __DIR__ . '/../../vendor/autoload.php';

// use vendor\setasign\fpdf\fpdf;
// require(__DIR__ . '/../../vendor/setasign/fpdf/fpdf.php');

// include("/../FPDF.php");

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

public function actionViewpdf($id) {
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
// $mpdf->Output('colorbox_order_'.date('d-m-Y').'.pdf','I');
////////////////////
////////////////////
/////////////////

///////////////////
/////////////////
/////////////////////
   $content = $this->renderPartial('sample');//['view', 'id' => 46]);
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
            // valid data received in $model

            //   echo "<pre>";
            //   print_r($_POST['shadenum']);
            //   die;    
            // // do something meaningful here about $model ...

  $fontSize = 10;
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 70-15;  // barcode center
  $y        = 30;  // barcode center
  $height   = 50;   // barcode height in 1D ; module size in 2D
  $width    = 1.8;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees
  
  $type     = 'code128';
  $black    = '000000'; // color in hexa
  
  
  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //

define('FPDF_FONTPATH',Yii::$app->basePath.'/../vendor/setasign/fpdf/font/'); 

// print_r((Yii::$app->basePath.'/../common/models/font/'));
// define('FPDF_INSTALLDIR', Yii::$app->basePath.'/../common/models/'); 

// if(!defined('FPDF_FONTPATH')) define('FPDF_FONTPATH', FPDF_INSTALLDIR.'/font/'); 

// include(FPDF_INSTALLDIR.'/fpdf.php'); 

// Prüfen ob die Klasse existiert 
if(class_exists('FPDF')) { 

    // Die Klasse existiert, Installation ok 
    // print_r("with class");

    // die("Die Installation war erfolgreich. Die Klasse FPDF existiert."); 
} else { 
    // print_r("without class");
    die;

    // Die Klasse existiert nicht 
    die("Die Klasse FPDF existiert nicht. Prüfen Sie, ob die Datei '".FPDF_INSTALLDIR."/fpdf.php' vorhanden ist."); 
} 

// Yii::$classMap['FPDF'] = '@vendor/setasign/fpdf/fpdf.php';



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
  

  // $dimx = 355;
  // $dimy=80;
  // $im     = imagecreatetruecolor($dimx,$dimy);
  // $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  // $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  // $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  // $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  // imagefilledrectangle($im, 0, 0, $dimx,$dimy, $white);



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
     // else if($data['hri']==802 ){
     //    // $pdf->SetFont('Arial','B',$fontSize+10);
     //   // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'Black');
     //      $pdf->Text($x + $xt+10+10+80, $y + $yt, 'Black');    //$data['hri']

     // }
     // else if($data['hri']==803 ){
     //    // $pdf->SetFont('Arial','B',$fontSize+10);
     // //   $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'Red');
     //      $pdf->Text($x + $xt+10+10+80, $y + $yt, 'Red');    //$data['hri']

     // }
     
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
     // else if($code2==802 ){
     //    // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'Black');
     //    //$pdf->Text(($pagewid/2)+$x+($data['width']/2)+2+ 10+ 10, $y+($dataheight/2), 'Black');
     //     $pdf->Text($x + $xt+($pagewid/2)+5+5+5+5+80, $y + $yt, 'Black');

     // }
     // else if($code2==803 ){
     //    // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'Red');
     //    //$pdf->Text(($pagewid/2)+$x+($data['width']/2)+2+ 10+ 10, $y+($dataheight/2), 'Red');
     //     $pdf->Text($x + $xt+($pagewid/2)+5+5+5+5+80, $y + $yt, 'Red');

     // }
     
    else{
      $pdf->SetFont('Arial','B',$fontSize+10);
      // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), $data['hri']);
      //$pdf->Text(($pagewid/2)+$x+($data['width']/2)+2+ 10+ 10, $y+($dataheight/2), $code2);
    }
// 





  // }


////////


/* For Loop End Below */
}
//below if condition prints one more barcode if the quantity is odd


if ($model->quantity%2==1)
{

  $pdf->AddPage();
  

  // $dimx = 355;
  // $dimy=80;
  // $im     = imagecreatetruecolor($dimx,$dimy);
  // $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  // $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  // $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  // $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  // imagefilledrectangle($im, 0, 0, $dimx,$dimy, $white);



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
     // else if($data['hri']==802 ){
     //    // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'Black');
     //            $pdf->Text($x + $xt+10+10+80, $y + $yt, 'Black');


     // }
     // else if($data['hri']==803 ){
     //    // $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), 'Red');
     //            $pdf->Text($x + $xt+10+10+80, $y + $yt, 'Red');


     // }
     
    else{
      $pdf->SetFont('Arial','B',$fontSize+10);
  //    $pdf->Text($x+($data['width']/2) +5+5+5+10, $y+($dataheight/2), $data['hri']);
    }
  // $data = Barcode::fpdf($pdf, $black, $x+$wid+($data['width'])+5+5+10+30, $y, $angle, $type, array('code'=>$code2), $width, $height);

  /* if ends here*/
}

/* For Each Loop End Below */ 
  }

////////
  // $pdf->Output();

  //use below command to ask user to save
  $pdf->Output('D','Barcodes_Printed_On_'.date('d-m-Y').'.pdf');
exit();
// die;

  // $pdf->Output();
  

  // //eFPDF('P', 'pt');
/*
  
  $pdf->Output();
  
*/
  // exit;
            // $this->render( 'barcode/sample-fpdf.php');






            return $this->render('barcode', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('barcode', ['model' => $model]);
        }


        // return $this->render('barcode');
        // , [
        //     'model' => $this->findModel($id),
        // ]);
    }



    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

// print_r(class_exists('mpdf'));

// die;

//uncomment below to add shades from 1 to 100 after truncating the shade table
/*
$allshades=Shade::find()->orderBy(['shade_id'=>SORT_ASC])->all();
        for ($i=1;$i<=800;$i++){
  

            
            $newshade = $allshades[$i-1];//new Shade();
            // $newshade->shade_name = strval($i);
            // $newshade->quantity = 0;

            $newshade->male = 0;
            $newshade->female = 0;
            if ($i== 1 3 5 21 22 23 33 46 50 51 55 69 73 82 83 
              158 160 181 182 183 189 194 195 196 197
              241 242 247 248 249 250 251 252 261 262 263 264 265 272 

              )
            
            $newshade->save();


            
        }
        */
        /*
        include 'excel_reader.php';       // include the class
    $excel = new PhpExcelReader;      // creates object instance of the class
    $excel->read('excel_file.xls');   // reads and stores the excel file data

    // Test to see the excel data stored in $sheets property
    echo '<pre>';
    var_export($excel->sheets);

    echo '</pre>';
    */
// die;


//uncomment ablve code to add shades from 1 to 100 after truncating the shade table

            // print_r($i);
            // die();
        // }
        $model = new Order();
        $model2 = new Orderdetail();

        /*

        */
        // $model->attributes=$_POST['Order'];
// if ($model->attributes && $model->save() ){

        $model3  = new InventoryOut();
        if ($model->load(Yii::$app->request->post()) ){// &&    $model->save() ){

            // echo '<pre>';
            // print_r($_POST);
            // die;

                $total_shades = Shade::find()->all();
                $total_shades = sizeof($total_shades);
          
                  $items = array_fill('1',strval($total_shades), 0);
        // echo "<pre>";
        // $a[1]="p";
        // $a[2]=99;
        // print_r($a[1]);
        // print_r($items);
        // die;



        //if ($model3->load(Yii::$app->request->post()) ){//&& $model->save()) {
        // echo "<pre>";
        // print_r($_POST['InventoryOut']['shade_id']);
        // die;
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

                if ($value>0){
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

//date_default_timezone_set('Australia/Melbourne');
                        $model4->save();
                    



                }//if
                # code...
            }//foreach


          /*
            foreach ($_POST['Orderdetail']['quantity'] as $shade_id => $quantity) {
                    if($quantity)
                    {
                       // print_r($key);
                 //       print_r($shade_id);
                        $model3 = new Orderdetail();

                        $model3->shade_id = $shade_id+1;
                        $model3->quantity = $quantity;
                        $model3->status = '1';
                        $model3->order_id = $model->order_id;
                        date_default_timezone_set('Asia/Karachi');
                   //     echo "hi";
                     //   echo date('Y-m-d H:i:s');
                        // die;
                       $model3->created_at = date('Y-m-d h:i:s');

//date_default_timezone_set('Australia/Melbourne');
                        $model3->save();
                    }

                    # code...
            }
*/
//            print_r($_POST['shade_id']);
            // print_r($_POST['Orderdetail']['shade_id']);
            // die;



            // $checkbox1=$_POST['Orderdetail']['shade_id'];  


            // foreach ($checkbox1 as $chk1) {
            //     $model3 = new Orderdetail();
            //     $model3->shade_id = $chk1;
            //     $model3->save();
            //     # code...
            // }




//            $model2->load(Yii::$app->request->post());
  //          $model2->save();
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
        // $Criteria = new CDbCriteria();   

        // $Criteria->condition = "order_id = $id";

            // return $this->redirect(['view', 'id' => $model->order_id]);

//        $model2 = Orderdetail::find()->where(['order_id' => $id])->orderBy(['shade_id'=>SORT_ASC])->all();

        // $
        // (['order_id'=>$id])->orderBy(['shade_idaa'=>SORT_ASC])->all();
        // echo "<pre>";
        // print_r($model);
        // print_r("hello");
        // print_r($model2) ;
        // die;

            // echo "<pre>";
            // print_r($model2);
            // print_r($_POST);
           // die;
        if ($model->load(Yii::$app->request->post()) ){//&& $model->save()) {
//          print_r($_POST['shade_ids']);

          // die();


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
          // print_r($_POST);
          // die();

          // if ($_POST['edit_detail']==1)
          //   die("yes");
          // else
          //   die("no");

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
                    // $modelentry=new InventoryOut();
                    // $modelentry->shade_id=$key;
                    // $modelentry->quantity=$value;
                    // $modelentry->salesman_id=$model->salesman_id;
                    // $modelentry->customer_id=$model->customer_id;
                    // $modelentry->save();

                             
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

//date_default_timezone_set('Australia/Melbourne');
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

/*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // echo "<pre>";
            // print_r($model);
            // print_r($_POST['Orderdetail']['quantity']);
            // print_r($model2);


                // die;
            // $model2->loadMultiple(Yii::$app->request->post());
            $model2 = Orderdetail::find()->where(['order_id' => $id])->orderBy(['shade_id'=>SORT_ASC])->all();
            // (['order_id'=>$id])->orderBy(['shade_id'=>SORT_ASC])->all();
            // echo "<pre>";
            // print_r($model2);
            // die;
            $len2 = sizeof($model2);
            $ind2 = 0;
            foreach ($_POST['Orderdetail']['quantity'] as $shade_id=>$quantity ) {
                //editing the existing one
                if ($ind2<$len2 && $model2[$ind2]->shade_id==$shade_id+1)
                {

                    if ($model2[$ind2]->quantity != $quantity)
                    {
                        $model3 = $model2[$ind2];
                        $model3->quantity=$quantity;
                        $model3->save();
                    }


                    $ind2=$ind2+1;
                }

                elseif ($quantity != null)
                {

                    $model3 = new Orderdetail();
                    $model3->shade_id = $shade_id+1;
                        $model3->quantity = $quantity;
                        $model3->status = '1';
                        $model3->order_id = $model->order_id;
                        date_default_timezone_set('Asia/Karachi');
                   //     echo "hi";
                     //   echo date('Y-m-d H:i:s');
                        // die;
                       $model3->created_at = date('Y-m-d h:i:s');

//date_default_timezone_set('Australia/Melbourne');
                        $model3->save();

                }
                # code...
            }

*/



  //           return $this->redirect(['view', 'id' => $model->order_id]);
  //       } else {
  //           $type='edit';
  //           return $this->render('update', [
  //               'model' => $model,
  // //              'model2'=>$model2,
  //               'type' => $type,
  //           ]);
  //       }
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
