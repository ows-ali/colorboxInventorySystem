<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerProfile;

/**
 * CustomerProfileSearch represents the model behind the search form about `common\models\CustomerProfile`.
 */
class CustomerProfileSearch extends CustomerProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'phone_number1', 'phone_number2', 'phone_number3'], 'integer'],
            [['customer_name', 'address', 'customer_type', 'description', 'status', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CustomerProfile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'customer_id' => $this->customer_id,
            'phone_number1' => $this->phone_number1,
            'phone_number2' => $this->phone_number2,
            'phone_number3' => $this->phone_number3,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'customer_type', $this->customer_type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
