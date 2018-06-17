<?php

namespace common\models;
// use common\models\Fpdf;

use Yii;
use common\models\Barcode;
use FPDF;
  // include('Barcode.php');
// use 

// use Yii;
// use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
// use yii\db\Query;
// use backend\views\order\barcode\FPDF;
// use backend\views\order\barcode\eFPDF;

  // include(Yii::$app->basePath.'\views\order\barcode\FPDF.php');

  // include(Yii::$app->basePath.'\views\order\barcode\php-barcode.php');
  // print_r(Yii::$app->basePath.'\views\order\barcode\php-barcode.php');
  // die;
// define('FPDF_FONTPATH',Yii::$app->basePath.'/views/order/barcode/font/');

// print_r(is_file(Yii::$app->basePath.'/views/order/barcode/font/helveticab.php'));
// die;
     // require(Yii::$app->basePath.'\views\order\barcode\FPDF.php');

  // print_r(Yii::$app->basePath.'/views/order/barcode/FPDF.php');
  // die;
  

  // -------------------------------------------------- //
  //                      USEFUL
  // -------------------------------------------------- //
    // $font2 = Yii::$app->basePath.'/views/order/barcode/font/arial/arial.ttf';
  
  class Efpdf extends FPDF{
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
?>