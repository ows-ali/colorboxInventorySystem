<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "salesman_profile".
 *
 * @property integer $salesman_id
 * @property string $salesman_name
 * @property string $phone_number
 * @property string $address
 * @property string $joining_date
 */
class SalesmanProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salesman_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salesman_name'], 'required'],
            [['phone_number'], 'integer'],
            [['address'], 'string'],
            [['joining_date'], 'safe'],
            [['salesman_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'salesman_id' => 'Salesman ID',
            'salesman_name' => 'Salesman Name',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'joining_date' => 'Joining Date',
        ];
    }
}
