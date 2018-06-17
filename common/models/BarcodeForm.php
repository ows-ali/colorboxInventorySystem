<?php

namespace common\models;

use Yii;
use yii\base\Model;

class BarcodeForm extends Model
{
    public $shadenumber;
    public $quantity;

    public function rules()
    {
        return [
            [[ 'quantity'], 'integer'],
            [[ 'quantity'], 'required'],
            // ['email', 'email'],
        ];
    }
}