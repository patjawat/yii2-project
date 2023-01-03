<?php

namespace app\components;

use app\modules\usermanager\models\User;
use app\modules\usermanager\models\Auth;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class UserHelper extends Component
{
    public static function isUserReadyLogin()
    {
        return !\Yii::$app->user->isGuest;
    }

    public static function getUser($field = null)
    {
        $model = User::findOne(['id' => Yii::$app->user->id]);
        if ($field) {
            if ($model) {
                return $model->$field;
            } else {
                return null;
            }
        } else {
            return $model;
        }
    }
    public static function getDoctorIs($id = null)
    {
        if ($id) {
            $model = User::findOne(['doctor_id' => $id]);
        } else {
            $model = User::findOne(['id' => Yii::$app->user->id]);
        }

        if ($model) {
            return $model;
        } else {
            return '';
        }
    }

    public static function getUserAll()
    {
        return ArrayHelper::map(User::find()->all(), 'id', 'fullname');
    }

    public static function getUserById($id)
    {
        $model = User::findOne(['id' => $id]);
        if ($model) {
            return $model;
        } else {
            return null;
        }
    }

    public static function getUserByPhone($phone)
    {
        $model = User::findOne(['phone' => $phone]);
        $line = Auth::findOne(['user_id' => $model->id, 'source' => 'line']);

        if ($model) {
            return [
                'user' => $model,
                'line_id' => isset($line) ?  $line->source_id : null,
            ];
        } else {
            return null;
        }
    }

}
