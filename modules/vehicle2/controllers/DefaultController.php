<?php

namespace app\modules\vehicle2\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use \yii\db\Expression;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
use app\modules\vehicle\models\Category;
use app\modules\vehicle\models\CategorySearch;

/**
 * Default controller for the `vehicle2` module
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
            'start' => date("Y-m-d").' 08:00:00',
            'end' => date("Y-m-d").' 16:30:00',
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $searchModelCar = new CategorySearch();
        $dataProviderCar = $searchModelCar->search($this->request->queryParams);
        $dataProviderCar->query->where(['type_name' => 'car']);
        if(isset($searchModel->data_json['car_type'])){
            $dataProviderCar->query->andFilterWhere(['like', new Expression("JSON_EXTRACT(data_json, '$.car_type')"),$searchModel->data_json['car_type']]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
        ]);
    }
}
