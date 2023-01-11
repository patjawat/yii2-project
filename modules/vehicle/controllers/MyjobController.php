<?php

namespace app\modules\vehicle\controllers;

use Yii;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use dominus77\sweetalert2\Alert;

class MyjobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $status = $this->request->get('status');
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        isset($status) ? $dataProvider->query->where(['status_id' => $status]) : '';
        $dataProvider->query->andWhere(['driver_id' => Yii::$app->user->id]);
        $dataProvider->query->andWhere(['<>','status_id','cancel']);
      

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sql = "SELECT u.id,u.fullname FROM auth_assignment a INNER JOIN user u ON u.id = a.user_id;";
        $driver = Yii::$app->db->createCommand($sql)->queryAll();

        if ($this->request->isPost && $model->load($this->request->post())) {
           
            if($model->save(false)){

                Yii::$app->session->setFlash('position', [
                    'position' => 'center',
                    'icon' => Alert::TYPE_SUCCESS,
                    'title' => 'บันทึกสำเร็จ!',
                    'showConfirmButton' => false,
                    'timer' => 1500
                ]);
                return $this->redirect(['index']);
            }
        }
            return $this->render('../booking/update', [
                'model' => $model,
                'driver' => $driver
            ]);
    
    }

    protected function findModel($id)
    {
        if (($model = Booking::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
