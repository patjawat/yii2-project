<?php

namespace app\modules\usermanager\components;
use Yii;
use app\components\UserHelper;
use yii\web\Controller;

class CheckUpController extends Controller {

    public function beforeAction($action) {
        $user = UserHelper::getUserById(Yii::$app->user->id);
        
        if ($user->phone == '' || (isset($user->data_json['position_name'])  ? $user->data_json['position_name'] : '') == '') {
            return $this->redirect(['/me/update']);
        }

        return parent::beforeAction($action);
    }

}