<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $order_id
 * @property string $customer_id
 * @property string $salesman_id
 * @property string $order_date
 * @property string $status
 * @property string $created_at
 * @property string $approved_at
 * @property string $delivered_at
 * @property string $cancelled_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            // [['customer_id', 'salesman_id'], 'integer'],
            // [['order_date', 'created_at', 'approved_at', 'delivered_at', 'cancelled_at'], 'safe'],
            // [['status'], 'string'],
            // [['status'],'default', 'value'=>'Pending'],

            // [['created_at'], 'default', 'value'=> date('Y-m-d H:i:s')]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'order_id' => 'Order ID',
            // 'customer_id' => 'Customer',
            // 'salesman_id' => 'Salesman',
            // 'order_date' => 'Order Date',
            // 'status' => 'Status',
            // // $val
            // 'created_at' => 'Created At',
            // 'approved_at' => 'Approved At',
            // 'delivered_at' => 'Delivered At',
            // 'cancelled_at' => 'Cancelled At',
        'message'=>'Notification Message',
        'type'=>'Type',
        

        ];
    }

//     public function getSalesman()
// {
//     return $this->hasOne(SalesmanProfile::className(), ['salesman_id' => 'salesman_id']);
// }


//     public function getCustomer()
// {
//     return $this->hasOne(CustomerProfile::className(), ['customer_id' => 'customer_id']);
// }


}
