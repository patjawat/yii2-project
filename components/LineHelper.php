<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\Json;
use app\modules\vehicle\models\Booking;

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

    public static function setDriverMenu($lineId)
    {
        // try {
            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = self::LineTokens();
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['richmenu_drivermenu']}";
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

    public static function setUserMenu($lineId)
    {
        // try {
            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = self::LineTokens();
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['richmenu_usermenu']}";
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


    public static function BroadcastMassage($msg){

        $site = self::siteConfig();
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $msg;
   
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

   public static function PushMessageCarBooking($msg){

   $sql = "SELECT * FROM auth_assignment
   INNER JOIN auth ON auth.user_id = auth_assignment.user_id
   WHERE auth_assignment.item_name = 'driver'
   AND auth.source = 'line'";
   
   $query = Yii::$app->db->createCommand($sql)->queryAll();
   foreach($query as $row){
    self::PushMessage($row['source_id'],$msg);
   }

}


public static function PushMessageOneToOne($id){

try {

    $model = Booking::findOne(['id' => $id]);

    $sql = "SELECT a.source_id FROM booking b
    INNER JOIN auth a ON a.user_id = b.created_by
    WHERE b.id = :id";
    $query = Yii::$app->db->createCommand($sql)
    ->bindValue(':id', $id)
    ->queryOne();
    if($query){
        $msg =  $msg = '#อนุมัติเรื่อง : '.$model->title."\n".'#วันที่ : '.$model->start.' ถึง '.$model->end .' พขร '.$model->driver->fullname;
        $id = $query['source_id'];
        PushMessage($id,$msg);
    }else{
        return false;
    }
        //code...
} catch (\Throwable $th) {
    //throw $th;
}

}
   public static function PushMessage($id,$msg)
   {
       // Yii::$app->response->format = Response::FORMAT_JSON;

   
   $accessToken = self::LineTokens();//copy ข้อความ Channel access token ตอนที่ตั้งค่า

   $arrayHeader = [];
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   $arrayPostData['to'] = $id;

   $arrayPostData['messages'][0]['type'] = "text";
   $arrayPostData['messages'][0]['text'] = $msg;
   
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
