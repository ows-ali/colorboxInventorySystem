<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orderdetail;

/**
 * OrderdetailSearch represents the model behind the search form about `common\models\Orderdetail`.
 */
class OrderdetailSearch extends Orderdetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderdetail_id', 'order_id', 'shade_id', 'quantity'], 'integer'],
            [['status', 'created_at'], 'safe'],
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
        $query = Orderdetail::find();

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
            'orderdetail_id' => $this->orderdetail_id,
            'order_id' => $this->order_id,
            'shade_id' => $this->shade_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
