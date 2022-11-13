<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\modules\usermanager\models\User;
use app\modules\soc\models\Events;


class BookingHelper extends Component{
    
    public static function Myjob(){
            $sql = "SELECT COUNT(id) as total FROM `booking` WHERE driver_id = :id AND status_id IN('approve')";
            $model = Yii::$app->db->createCommand($sql)
            ->bindValue(':id',Yii::$app->user->id)
            ->queryScalar();
            return $model;

    }
    
    public static function MyBooking(){
        $sql = "SELECT COUNT(id) as total FROM `booking` WHERE created_by = :id";
        $model = Yii::$app->db->createCommand($sql)
        ->bindValue(':id',Yii::$app->user->id)
        ->queryScalar();
        return $model;

}

}

