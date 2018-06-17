<?php
namespace backend\views\order\barcode;

  include('Barcode.php');


use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use backend\views\order\barcode\Barcode;

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  // download a ttf font here for example : http://www.dafont.com/fr/nottke.font
  // $font     = './NOTTB___.TTF';
  $font = Yii::$app->basePath.'/views/order/barcode/font/arial/arial.ttf';
  // echo basename(__DIR__);


  print_r($font);
  // die;
  // - -
  
  $fontSize = 10;   // GD1 in px ; GD2 in point
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 70;  // barcode center
  $y        = 30;  // barcode center
  $height   = 50;   // barcode height in 1D ; module size in 2D
  $width    = 2;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
  $code     = '100';//123456789012'; // barcode, of course ;)
  $code2='300';
  $type     = 'code128';
  
  // -------------------------------------------------- //
  //                    USEFUL
  // -------------------------------------------------- //
  
  function drawCross($im, $color, $x, $y){
    // imageline($im, $x - 10, $y, $x + 10, $y, $color);
    // imageline($im, $x, $y- 10, $x, $y + 10, $color);
  }
  
  // -------------------------------------------------- //
  //            ALLOCATE GD RESSOURCE
  // -------------------------------------------------- //
  $dimx = 355;
  $dimy=80;
  $im     = imagecreatetruecolor($dimx,$dimy);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  imagefilledrectangle($im, 0, 0, $dimx,$dimy, $white);
  
  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
// console.log("ere");

  // -------------------------------------------------- //
  //                        HRI
  // -------------------------------------------------- //
  if ( isset($font) ){
        $mydata='50/3 Polyester';

    $box = imagettfbbox($fontSize, 0, $font, $mydata);
    $len = $box[2] - $box[0];
    Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
    imagettftext($im, $fontSize, $angle, $x + $xt , $y + $yt , $black, $font, $mydata);


  }

    $box2 = imagettfbbox($fontSize+5, 0, $font, $data['hri']);
    
      $wid = $box2[2] - $box2[0];
      $dataheight = $box2[1] - $box2[7];

  imagettftext($im, $fontSize+5, $angle, $x+($data['width']/2) +5, $y+($dataheight/2), $black, $font, $data['hri']);

///////////////////////
/*  Second barcode */
////////////////////
// echo 'die';
  
  $data = Barcode::gd($im, $black, $x+$wid+($data['width'])+5+5, $y, $angle, $type, array('code'=>$code2), $width, $height);

  if ( isset($font) ){
        $mydata='50/3 Polyester';

    $box = imagettfbbox($fontSize, 0, $font, $mydata);
    $len = $box[2] - $box[0];
    Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
    imagettftext($im, $fontSize, $angle, $x + $xt +$wid+($data['width'])+5+5, $y + $yt , $black, $font, $mydata);


  }

    $box2 = imagettfbbox($fontSize+5, 0, $font, $code2);
    
      // $wid = $box2[1] - $box2[0];
  imagettftext($im, $fontSize+5, $angle, $x+($data['width']/2)+5+  $wid + ($data['width'])+5+5, $y+($dataheight/2), $black, $font, $code2);










///////////////
  // $text='sdf';
  // $font = 'arial.ttf';
  // imagettftext($im, $fontSize, $angle, $x , $y , $blue, $font, $text);  


  // -------------------------------------------------- //
  //                     ROTATE
  // -------------------------------------------------- //
  // Beware ! the rotate function should be use only with right angle
  // Remove the comment below to see a non right rotation
  /** /
  $rot = imagerotate($im, 45, $white);
  imagedestroy($im);
  $im     = imagecreatetruecolor(900, 300);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  imagefilledrectangle($im, 0, 0, 900, 300, $white);
  
  // Barcode rotation : 90�
  $angle = 90;
  $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
  imagettftext($im, 10, 0, 60, 290, $black, $font, 'BARCODE ROTATION : 90�');
  
  // barcode rotation : 135
  $angle = 135;
  Barcode::gd($im, $black, $x+300, $y, $angle, $type, array('code'=>$code), $width, $height);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  imagettftext($im, $fontSize, $angle, $x + 300 + $xt, $y + $yt, $blue, $font, $data['hri']);
  imagettftext($im, 10, 0, 360, 290, $black, $font, 'BARCODE ROTATION : 135�');
  
  // last one : image rotation
  imagecopy($im, $rot, 580, -50, 0, 0, 300, 300);
  imagerectangle($im, 0, 0, 299, 299, $black);
  imagerectangle($im, 299, 0, 599, 299, $black);
  imagerectangle($im, 599, 0, 899, 299, $black);
  imagettftext($im, 10, 0, 690, 290, $black, $font, 'IMAGE ROTATION');
  /**/

  // -------------------------------------------------- //
  //                    MIDDLE AXE
  // -------------------------------------------------- //
  //imageline($im, $x, 0, $x, 250, $red);
  //imageline($im, 0, $y, 250, $y, $red);
  
  // -------------------------------------------------- //
  //                  BARCODE BOUNDARIES
  // -------------------------------------------------- //
  for($i=1; $i<5; $i++){
    drawCross($im, $blue, $data['p'.$i]['x'], $data['p'.$i]['y']);
  }
  
  // -------------------------------------------------- //
  //                    GENERATE
  // -------------------------------------------------- //
  // imageresolution($im, -2000);
  header('Content-type: image/png');
  
//  imagepng($im,NULL,8);

  imagepng($im,"D:\barcodeexample\abcs.png",8);

  imagedestroy($im);
?>