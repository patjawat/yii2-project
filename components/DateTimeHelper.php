<?php

namespace app\components;

use app\models\Uploads;
use Yii;
use yii\base\Component;
use yii\helpers\Html;
use app\modules\usermanager\models\User;
use app\modules\usermanager\models\Auth;

//use yii\helpers\Url;

/**
 * ฟังก์ชั่นสนับสนุนงานเอกสาร
 * @author suchart bunhachirat <suchartbu@gmail.com>
 */
class DateTimeHelper extends Component
{
// คำนวน วัน เวลา ที่ผ่านมา
    public static function Duration($begin,$end){
        $remain=intval(strtotime($end)-strtotime($begin));
        $wan=floor($remain/86400);
        $l_wan=$remain%86400;
        $hour=floor($l_wan/3600);
        $l_hour=$l_wan%3600;
        $minute=floor($l_hour/60);
        $second=$l_hour%60;
        // return ($wan > 0 ? $wan." วัน " : "").($hour > 0 ? $hour ." ชั่วโมง " : "").($minute > 0 ? $minute ." นาที " : "").$second." วินาที";
        return [
            'full' => ($wan > 0 ? $wan." วัน " : "").($hour > 0 ? $hour ." ชั่วโมง " : "").($minute > 0 ? $minute ." นาที " : ""),
            'day' => $wan > 0 ? $wan:null,
            'hour' => $hour > 0 ? $hour:null,
            'minute' => $minute > 0 ? $minute:null,
        ];
        
    }

}