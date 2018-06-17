<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orderdetail".
 *
 * @property string $orderdetail_id
 * @property string $order_id
 * @property string $shade_id
 * @property integer $quantity
 * @property string $status
 * @property string $created_at
 */
class Orderdetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderdetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'shade_id', 'quantity'], 'integer'],
            [['status'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderdetail_id' => 'Orderdetail ID',
            'order_id' => 'Order ID',
            'shade_id' => 'Shade ID',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
