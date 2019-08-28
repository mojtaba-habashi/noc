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
    public $station_name;
    public $customer_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'station_id', 'is_deleted'], 'integer'],
            [['service_type', 'address', 'tel', 'station_name', 'customer_name'], 'safe'],
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
     * @param $params
     * @param $customer_id
     * @return ActiveDataProvider
     */
    public function search($params, $customer_id)
    {
        $query = Service::find()
            ->innerJoin('station', 'service.station_id = station.id')
            ->innerJoin('user', 'service.user_id = user.id')
            ->innerJoin('profile', 'profile.user_id = user.id')
            ->where(['service.user_id' => $customer_id]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

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
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'station.name', $this->station_name])
            ->andFilterWhere(['like', 'profile.name', $this->customer_name]);

        return $dataProvider;
    }
}
