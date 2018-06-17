<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_profile".
 *
 * @property string $customer_id
 * @property string $customer_name
 * @property string $address
 * @property string $phone_number1
 * @property string $phone_number2
 * @property string $phone_number3
 * @property string $customer_type
 * @property string $description
 * @property string $status
 * @property string $created_at
 */
class CustomerProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'customer_type', 'description', 'status'], 'string'],
            [['phone_number1', 'phone_number2', 'phone_number3'], 'integer'],
            [['created_at'], 'safe'],
            [['customer_name'], 'string', 'max' => 255],
            [['customer_name'], 'required'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'address' => 'Address',
            'phone_number1' => 'Phone Number 1',
            'phone_number2' => 'Phone Number 2',
            'phone_number3' => 'Phone Number 3',
            'customer_type' => 'Customer Type',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
