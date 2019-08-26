<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service;

/**
 * Servicesearch represents the model behind the search form of `app\models\Service`.
 */
class Servicesearch extends Service
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'station_id', 'is_deleted'], 'integer'],
            [['service_type', 'address', 'tel'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Service::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'station_id' => $this->station_id,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'service_type', $this->service_type])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tel', $this->tel]);

        return $dataProvider;
    }
}
