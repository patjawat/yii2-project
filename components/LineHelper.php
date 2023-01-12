<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\Json;

class LineHelper extends Component
{

    public static function siteConfig()
    {
        return SiteHelper::info();
    }


    public static function LineTokens(){
        $site = self::siteConfig();
        return $site['line_token'];
    }
    public static function setRegisterMenu($lineId)
    {
        try {
            
            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = $site['line_token'];
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['richmenu_register']}";
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Throwable$th) {
            //throw $th;
            return false;
        }
    }

    public static function setMainMenu($lineId)
    {
        // try {
            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = self::LineTokens();
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['richmenu_mainmenu']}";
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        // } catch (\Throwable$th) {
        //     //throw $th;
        //     return false;
        // }
    }


    public static function BroadcastMassage($model){

        $site = self::siteConfig();
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = '#จองรถทะเบียน : '.$model->car->data_json['car_regis']."\n".'#ผู้ขอ : '.$model->createBy->fullname."\n".'#เรื่อง : '.$model->title."\n".'#วันที่ : '.$model->start.' ถึง '.$model->end;
   
        $accessToken = $site['line_token'];//copy ข้อความ Channel access token ตอนที่ตั้งค่า
        $arrayHeader = [];
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";

       $strUrl = "https://api.line.me/v2/bot/message/broadcast";
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL,$strUrl);
       curl_setopt($ch, CURLOPT_HEADER, false);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
       curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($arrayPostData));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       $result = curl_exec($ch);
       curl_close ($ch);
   }


   public static function PushMessage($model)
   {
       // Yii::$app->response->format = Response::FORMAT_JSON;

   $accessToken = self::LineTokens();//copy ข้อความ Channel access token ตอนที่ตั้งค่า

   $arrayHeader = [];
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   $arrayPostData['to'] = 'U040cdfc8187f3203b93ba5d793830d00';

   $arrayPostData['messages'][0]['type'] = "text";
   $arrayPostData['messages'][0]['text'] = '#จองรถ';
   
   $strUrl = "https://api.line.me/v2/bot/message/push";
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL,$strUrl);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
   curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($arrayPostData));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   $result = curl_exec($ch);
   curl_close ($ch);
   }
   

}
