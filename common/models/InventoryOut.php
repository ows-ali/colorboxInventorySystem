<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inventory_out".
 *
 * @property integer $inventory_out_id
 * @property integer $shade_id
 * @property integer $quantity
 * @property integer $salesman_id
 * @property integer $customer_id
 * @property string $created_at
 */
class InventoryOut extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory_out';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'quantity', 'salesman_id', 'customer_id'], 'integer'],
            ['shade_id','required'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventory_out_id' => 'Inventory Out ID',
            'shade_id' => 'Shade ID',
            'quantity' => 'Quantity',
            'salesman_id' => 'Salesman ID',
            'customer_id' => 'Customer ID',
            'created_at' => 'Created At',
        ];
    }
}
