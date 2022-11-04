<?php

namespace app\modules\bookingcar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bookingcar\models\Booking;

/**
 * BookingSearch represents the model behind the search form of `app\modules\bookingcar\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ref', 'date_start', 'time_start', 'date_end', 'time_end', 'province_id', 'district_id', 'car_id', 'data_json'], 'safe'],
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
        $query = Booking::find();

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
        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'date_start', $this->date_start])
            ->andFilterWhere(['like', 'time_start', $this->time_start])
            ->andFilterWhere(['like', 'date_end', $this->date_end])
            ->andFilterWhere(['like', 'time_end', $this->time_end])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'car_id', $this->car_id])
            ->andFilterWhere(['like', 'data_json', $this->data_json]);

        return $dataProvider;
    }
}
