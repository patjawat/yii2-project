<?php

namespace app\modules\vehicle\controllers;

use app\modules\vehicle\models\Booking;
use Yii;
use yii\web\Response;

class CommentController extends \yii\web\Controller

{
    public function actionIndex()
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;

        // $searchModel = new BookingSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider->query->andWhere(['created_by' => Yii::$app->user->id]);
        // $dataProvider->query->andWhere(['status_id' => 'success']);
        $model = Booking::find()->where(['status_id' => 'success', 'created_by' => Yii::$app->user->id])->One();
        // $dataProvider->setSort([
        //     'defaultOrder' => [
        //         'created_at' => SORT_ASC,
        //     ]
        // ]);
        // return $model;

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
