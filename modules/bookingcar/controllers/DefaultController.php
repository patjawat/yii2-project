<?php

namespace app\modules\bookingcar\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use \yii\db\Expression;
use app\modules\bookingcar\models\Booking;
use app\modules\bookingcar\models\BookingSearch;
use app\modules\bookingcar\models\Category;
use app\modules\bookingcar\models\CategorySearch;

/**
 * Default controller for the `Bookingcar` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch([
            'start' => date("Y-m-d H:i:s"),
            'end' => date("Y-m-d H:i:s")
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $searchModelCar = new CategorySearch();
        $dataProviderCar = $searchModelCar->search($this->request->queryParams);
        $dataProviderCar->query->where(['type_name' => 'car']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
        ]);
    }

    public function actionEvents($id, $start, $end)
    {
        $models = Booking::find()
        ->select(['id', 'start','end','title'])
        ->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $datas = [];
        foreach ($models as $model){
            $datas[] = [
                'id' => $model->id,
                'start' => $model->start,
                'end' => $model->end,
                'title' => $model->title,
                'editable'         => true,
				'startEditable'    => true,
				'durationEditable' => true,
            ];
        }
        return $datas;
    }


    public function actionDriverList()
    {
      
        $sql = "SELECT u.id,u.fullname FROM auth_assignment a 
        INNER JOIN user  u ON u.id = a.user_id
        WHERE a.item_name = 'driver'";
        $querys = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('driver_list',[
            'querys' => $querys
        ]);
    }
}
