<?php

namespace app\modules\vehicle\controllers;

use Yii;
use app\modules\vehicle\models\Category;
use app\modules\vehicle\models\CategorySearch;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['type_name' => 'car']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
