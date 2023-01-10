<?php

namespace app\components;

use app\modules\usermanager\models\User;
use Yii;
use yii\base\Component;

class BookingHelper extends Component
{

    public static function Myjob()
    {
        // $sql = "SELECT COUNT(id) as total FROM `booking` WHERE driver_id = :id AND status_id IN('approve')";
        $sql = "SELECT COUNT(id) as total FROM `booking` WHERE driver_id = :id AND status_id NOT IN('cancel','success')";
        $model = Yii::$app->db->createCommand($sql)
            ->bindValue(':id', Yii::$app->user->id)
            ->queryScalar();
        return $model;

    }

    public static function MyBooking()
    {
        if(Yii::$app->user->can('user')){
            $sql = "SELECT COUNT(id) as total FROM `booking` WHERE created_by = :id AND status_id  NOT IN('cancel','success')";
            $model = Yii::$app->db->createCommand($sql)
                ->bindValue(':id', Yii::$app->user->id)
                ->queryScalar();
            
        }else{
            $sql = "SELECT COUNT(id) as total FROM `booking` WHERE  status_id NOT IN('cancel','success')";
            $model = Yii::$app->db->createCommand($sql)
                ->queryScalar();
        }
        return $model;
    }

    public static function CountByStatus()
    {

        $all = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking")->queryScalar();
        $await = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'await'")->queryScalar();
        $approve = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'approve'")->queryScalar();
        $success = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'success'")->queryScalar();
        $cancel = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'cancel'")->queryScalar();

        return [
            'all' => $all,
            'await' => $await,
            'approve' => $approve,
            'success' => $success,
            'cancel' => $cancel,
            'allBadgeTotal' => self::BadgeTotal($all),
            'awaitBadgeTotal' => self::BadgeTotal($await),
            'approveBadgeTotal' => self::BadgeTotal($approve),
            'successBadgeTotal' => self::BadgeTotal($success),
            'cancelBadgeTotal' => self::BadgeTotal($cancel),
        ];

    }

    public static function CountByStatusDriver()
    {

        $all = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE driver_id = :id")
        ->bindValue(':id', Yii::$app->user->id)
        ->queryScalar();
        $await = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'await' AND driver_id = :id")
        ->bindValue(':id', Yii::$app->user->id)
        ->queryScalar();
        $approve = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'approve' AND driver_id = :id")
        ->bindValue(':id', Yii::$app->user->id)
        ->queryScalar();
        $success = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'success' AND driver_id = :id")
        ->bindValue(':id', Yii::$app->user->id)
        ->queryScalar();
        $cancel = Yii::$app->db->createCommand("SELECT COUNT(id) as total FROM booking WHERE status_id = 'cancel' AND driver_id = :id")
        ->bindValue(':id', Yii::$app->user->id)
        ->queryScalar();

        return [
            'all' => $all,
            'await' => $await,
            'approve' => $approve,
            'success' => $success,
            'cancel' => $cancel,
            'allBadgeTotal' => self::BadgeTotal($all),
            'awaitBadgeTotal' => self::BadgeTotal($await),
            'approveBadgeTotal' => self::BadgeTotal($approve),
            'successBadgeTotal' => self::BadgeTotal($success),
            'cancelBadgeTotal' => self::BadgeTotal($cancel),
        ];

    }

    public static function BadgeTotal($count)
    {
        if($count > 0 )
        {
            return '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$count.'<span class="visually-hidden">unread messages</span></span>';
        }
    }
    


}
