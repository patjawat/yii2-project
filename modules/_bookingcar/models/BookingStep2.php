<?php

namespace app\modules\bookingcar\models;

use Yii;

class BookingStep2 extends \yii\db\ActiveRecord
{


public $passengers_number;
public $car_van;
public $car_truck;
    public function rules()
    {
        return [
            [['passengers_number', 'car_van', 'car_truck'], 'required'],
        ];
    }

}
