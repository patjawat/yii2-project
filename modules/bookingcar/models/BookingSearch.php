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
            [['id', 'passengers_number',  'contact_name', 'contact_phone', 'cost_type', 'receive'], 'integer'],
            [['province_id', 'district_id', 'passengers_name', 'rally_point', 'date_start', 'time_start', 'title', 'description', 'stopover', 'person_name', 'certifier_name', 'certifier_position', 'author_id', 'author_position', 'date_end', 'time_end', 'driver', 'car_id'], 'safe'],
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
            'passengers_number' => $this->passengers_number,
            'contact_name' => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'cost_type' => $this->cost_type,
            'receive' => $this->receive,
        ]);

        $query->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'passengers_name', $this->passengers_name])
            ->andFilterWhere(['like', 'rally_point', $this->rally_point])
            ->andFilterWhere(['like', 'date_start', $this->date_start])
            ->andFilterWhere(['like', 'time_start', $this->time_start])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'stopover', $this->stopover])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'certifier_name', $this->certifier_name])
            ->andFilterWhere(['like', 'certifier_position', $this->certifier_position])
            ->andFilterWhere(['like', 'author_id', $this->author_id])
            ->andFilterWhere(['like', 'author_position', $this->author_position])
            ->andFilterWhere(['like', 'date_end', $this->date_end])
            ->andFilterWhere(['like', 'time_end', $this->time_end])
            ->andFilterWhere(['like', 'driver', $this->driver])
            ->andFilterWhere(['like', 'car_id', $this->car_id]);

        return $dataProvider;
    }
}
