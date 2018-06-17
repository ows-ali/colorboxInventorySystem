<?php

namespace backend\views\order\barcode;

  // include('Barcode.php');


use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
// use backend\views\order\barcode\Barcode;




  include(Yii::$app->basePath.'/views/order/barcode/php-barcode.php');
  require(Yii::$app->basePath.'/views/order/barcode/FPDF.php');

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  // download a ttf font here for example : http://www.dafont.com/fr/nottke.font
  // $font     = './NOTTB___.TTF';
   $font = Yii::$app->basePath.'/views/order/barcode/font/arial/arial.ttf';


    class eFPDF extends FPDF{
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
  }


  // $font = 'font/arial/arial.ttf';
  
  // - -
  
  $fontSize = 10;   // GD1 in px ; GD2 in point
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 70;  // barcode center
  $y        = 30;  // barcode center
  $height   = 50;   // barcode height in 1D ; module size in 2D
  $width    = 2;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  $type     = 'code128';




  $pdf = new eFPDF('P', 'pt',array(370,80));

  ////////
  ////////

  /*  Loop Starts here  */

  ////////
  ////////

  $code     = '300';//123456789012'; // barcode, of course ;)
  $code2='300';
  
  
  // -------------------------------------------------- //
  //                    USEFUL
  // -------------------------------------------------- //
  
  // -------------------------------------------------- //
  //            ALLOCATE GD RESSOURCE
  // -------------------------------------------------- //


  for ($i =1;$i<=3;$i++){

  $pdf->AddPage();
  

  // $dimx = 355;
  // $dimy=80;
  // $im     = imagecreatetruecolor($dimx,$dimy);
  // $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  // $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  // $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  // $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  // imagefilledrectangle($im, 0, 0, $dimx,$dimy, $white);

  $black    = '000000'; // color in hexa

  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  $data = Barcode::fpdf($pdf, $black, $x+10, $y, $angle, $type, array('code'=>$code), $width, $height);

// console.log("ere");

  // -------------------------------------------------- //
  //                        HRI
  // -------------------------------------------------- //
  if ( isset($font) ){
        $mydata='50/3 Polyester';


    $pdf->SetFont('Arial','B',$fontSize);
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($mydata);
  
   Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
 //   imagettftext($pdf, $fontSize, $angle, $x + $xt , $y + $yt , $black, $font, $mydata);
  $pdf->TextWithRotation($x + $xt+10, $y + $yt, $mydata, $angle);    //$data['hri']
  // $pdf->TextWithRotation($x , $y , $data['hri'], $angle);    //$data['hri']



   $box2 = imagettfbbox($fontSize+5, 0, $font, $data['hri']);
    // 
     $wid =$box2[2] - $box2[0];
     $dataheight = $box2[1] - $box2[7];
$pdf->SetFont('Arial','B',$fontSize+5);

$pdf->TextWithRotation($x+($data['width']/2) +5+5+5, $y+($dataheight/2), $data['hri'],$angle);
  }
// $wid=10;

///////////////////////
/*  Second barcode */
////////////////////
// echo 'die';
  
  $data = Barcode::fpdf($pdf, $black, $x+$wid+($data['width'])+5+5+10, $y, $angle, $type, array('code'=>$code2), $width, $height);
  
  if ( isset($font) ){
        $mydata='50/3 Polyester';

    // $box = imagettfbbox($fontSize, 0, $font, $mydata);
    // $len = $box[2] - $box[0];

$pdf->SetFont('Arial','B',$fontSize);
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($mydata);
  

   Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  //  imagettftext($im, $fontSize, $angle, $x + $xt +$wid+($data['width'])+5+5, $y + $yt , $black, $font, $mydata);
$pdf->TextWithRotation($x + $xt+$wid+($data['width'])+5+5+5+5, $y + $yt, $mydata, $angle);
$pdf->SetFont('Arial','B',$fontSize+5);

$pdf->TextWithRotation($x+($data['width']/2)+5+ 10+ $wid + ($data['width'])+5+5, $y+($dataheight/2), $code2,$angle);

  }


////////

/* Loop End Below */

  }

////////
  
  $pdf->Output('D:\barcodeexample\abcs.pdf','F');
  // $pdf->Output();

?>