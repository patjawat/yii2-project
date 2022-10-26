<?php

namespace app\modules\bookingcar\models;

use Yii;

class BookingStep1 extends \yii\db\ActiveRecord
{


public $date_start;
public $date_end;
public $car_truck;
    public function rules()
    {
        return [
            [['date_start', 'date_end', 'car_truck'], 'required'],
        ];
    }

}
