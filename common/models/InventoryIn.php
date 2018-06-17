<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inventory_in".
 *
 * @property integer $inventory_in_id
 * @property string $shade_id
 * @property string $quantity
 * @property string $created_at
 */
class InventoryIn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory_in';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shade_id', ], 'required'],
            [['quantity'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventory_in_id' => 'Inventory In ID',
            'shade_id' => 'Shade IDs',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
        ];
    }
}
