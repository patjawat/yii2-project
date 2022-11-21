<?php

namespace app\modules\meeting\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use \yii\db\Expression;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
use app\modules\vehicle\models\Category;
use app\modules\vehicle\models\CategorySearch;

/**
 * Default controller for the `meeting` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new BookingSearch([
            'start' => date("Y-m-d").' 08:00:00',
            'end' => date("Y-m-d").' 16:30:00',
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $searchModelRoom = new CategorySearch();
        $dataProviderRoom = $searchModelRoom->search($this->request->queryParams);
        $dataProviderRoom->query->where(['type_name' => 'room']);
        if(isset($searchModel->data_json['car_type'])){
            $dataProviderRoom->query->andFilterWhere(['like', new Expression("JSON_EXTRACT(data_json, '$.car_type')"),$searchModel->data_json['car_type']]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelRoom' => $searchModelRoom,
            'dataProviderRoom' => $dataProviderRoom,
        ]);
    }

}
