<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Shade;

/**
 * ShadeSearch represents the model behind the search form about `common\models\Shade`.
 */
class ShadeSearch extends Shade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shade_id', 'quantity'], 'integer'],
            [['shade_name', 'gender', 'status', 'created_at'], 'safe'],
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

        $query1 = Shade::find()->where(['<=','shade_id','800']);
       $query2 = Shade::find()->where(['>=','shade_id','801']);
       $query=$query2->union($query1);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination'=>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query1->andFilterWhere([
            'shade_id' => $this->shade_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'shade_name'=>$this->shade_name,
        ]);
        $query2->andFilterWhere([
            'shade_id' => $this->shade_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'shade_name'=>$this->shade_name,
        ]);

        $query
        //->andFilterWhere(['like', 'shade_name', $this->shade_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
