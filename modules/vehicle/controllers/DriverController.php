<?php

namespace app\modules\vehicle\controllers;

use Yii;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
use yii\web\Response;
class DriverController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sql = "SELECT u.id,u.fullname,u.phone,u.photo,u.data_json,u.picture_url FROM auth_assignment a INNER JOIN user u ON u.id = a.user_id where item_name='driver';";
        $models = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('index',['models' => $models]);
    }

    public function actionJob()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'title' => 'ตารางงาน',
            'content' => $this->renderAjax('event',['id' => $this->request->get('id')])
        ];
    }

    public function actionEvents($id, $start, $end)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
       $dataProvider->query->where(['status_id' => 'approve']);
       
        $dataProvider->query->andWhere(['driver_id' => $id]);
        


        $datas = [];
        foreach ( $dataProvider->getModels() as $event)
        {
            $datas[] = [
				'title' => 'เรื่อง #' . $event->title,
				'start' => $event->start,
				'end' => $event->end,
			];
            
        }

		return $datas;
	}

}
