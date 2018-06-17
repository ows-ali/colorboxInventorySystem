<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shade".
 *
 * @property string $shade_id
 * @property string $shade_name
 * @property string $gender
 * @property string $category_id
 * @property string $status
 * @property string $created_at
 */
class Shade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender', 'status'], 'string'],
            [['quantity'], 'integer'],
            [['created_at'], 'safe'],
            [['shade_name'], 'string', 'max' => 22],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shade_id' => 'Shade ID',
            'shade_name' => 'Shade Name',
            'gender' => 'Gender',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
