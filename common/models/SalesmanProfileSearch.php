<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SalesmanProfile;

/**
 * SalesmanProfileSearch represents the model behind the search form about `common\models\SalesmanProfile`.
 */
class SalesmanProfileSearch extends SalesmanProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salesman_id', 'phone_number'], 'integer'],
            [['salesman_name', 'address', 'joining_date'], 'safe'],
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
        $query = SalesmanProfile::find();

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
            'salesman_id' => $this->salesman_id,
            'phone_number' => $this->phone_number,
            'joining_date' => $this->joining_date,
        ]);

        $query->andFilterWhere(['like', 'salesman_name', $this->salesman_name])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
