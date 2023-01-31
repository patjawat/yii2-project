<?php

namespace app\components;

use app\modules\usermanager\models\User;
use Yii;
use yii\base\Component;
use app\models\Site;

class SiteHelper extends Component
{

    public static function Info()
    {
        $model = Site::findOne('info');
        return [
            'site_name' => isset($model->data_json['site_name']) ? $model->data_json['site_name'] : null,
            'line_token' => isset($model->data_json['line_token']) ? $model->data_json['line_token'] : null,
            'richmenu_register' => isset($model->data_json['richmenu_register']) ? $model->data_json['richmenu_register'] : null,
            'richmenu_usermenu' => isset($model->data_json['richmenu_usermenu']) ? $model->data_json['richmenu_usermenu'] : null,
            'richmenu_drivermenu' => isset($model->data_json['richmenu_drivermenu']) ? $model->data_json['richmenu_drivermenu'] : null,
        ];
    }

   

}
