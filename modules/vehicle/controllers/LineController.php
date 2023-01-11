<?php

namespace app\modules\vehicle\controllers;

use app\models\Amphures;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
use app\modules\vehicle\models\CategorySearch;
use dominus77\sweetalert2\Alert;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use \yii\db\Expression;
use app\components\UserHelper;

class LineController extends \yii\web\Controller

{
    public function actionIndex()
    {
        $this->layout = 'line';
        $searchModel = new BookingSearch([
            'start' => date("Y-m-d") . ' 08:00:00',
            'end' => date("Y-m-d") . ' 16:30:00',
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $searchModelCar = new CategorySearch();
        $dataProviderCar = $searchModelCar->search($this->request->queryParams);
        $dataProviderCar->query->where(['type_name' => 'car']);
        if (isset($searchModel->data_json['car_type'])) {
            $dataProviderCar->query->andFilterWhere(['like', new Expression("JSON_EXTRACT(data_json, '$.car_type')"), $searchModel->data_json['car_type']]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelCar' => $searchModelCar,
            'dataProviderCar' => $dataProviderCar,
        ]);
    }

    public function actionQrcode(){
        $this->layout = 'line';
        return $this->render('qrcode');
    }


    public function actionBooking()
    {
        $this->layout = 'line';
        $status = $this->request->get('status');
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // isset($status) ? $dataProvider->query->where(['status_id' => $status]) : '';
        // if(!Yii::$app->user->can('driver')){
        // $dataProvider->query->andWhere(['created_by' => Yii::$app->user->id]);
        // $dataProvider->query->andWhere(['<>','status_id','cancel']);
        // $dataProvider->setSort([
        //     'defaultOrder' => [
        //         'created_at' => SORT_ASC,
        //     ]
        // ]);
        // }

        return $this->render('booking', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionView($id)
    {
        $this->layout = 'line';
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionCreate()
    {
        $this->layout = 'line';
        $user  = UserHelper::getUser();
        $car_id = $this->request->get('car_id');
        $start = $this->request->get('start');
        $end = $this->request->get('end');
        
        $model = new Booking([
            'ref' => substr(Yii::$app->getSecurity()->generateRandomString(), 10),
            'car_id' => $car_id,
            'start' => $start,
            'end' => $end,
        ]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status_id = 'await';
                $model->save();
                Yii::$app->session->setFlash('position', [
                    'position' => 'center',
                    'icon' => Alert::TYPE_SUCCESS,
                    'title' => 'บันทึกสำเร็จ!',
                    'showConfirmButton' => false,
                    'timer' => 1500,
                ]);
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('view', [
                    'model' => $this->findModel($model->id),
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            
            'model' => $model,
            'car_id' => $car_id,
        ]);
    }

    public function actionUpdate($id)
    {
        $this->layout = 'line';
        $model = $this->findModel($id);

        $sql = "SELECT u.id,u.fullname FROM auth_assignment a INNER JOIN user u ON u.id = a.user_id;";
        $driver = Yii::$app->db->createCommand($sql)->queryAll();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('position', [
                'position' => 'center',
                'icon' => Alert::TYPE_SUCCESS,
                'title' => 'บันทึกสำเร็จ!',
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('view', [
                'model' => $this->findModel($model->id),
            ]);
        }

        if (Yii::$app->user->can('user') && $model->status_id == 'approve') {
            Yii::$app->session->setFlash('position', [
                'icon' => Alert::TYPE_WARNING,
                'title' => 'ไม่สามารถแก้ไขได้!',
                'text' => 'เนื่องจากอนุมัติแล้วกรุณาติดต่อผู้กูแลระบบ!',
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'driver' => $driver,
            ]);
        }
    }

    public function actionCancel($id)
    {
        $this->layout = 'line';
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('position', [
                'position' => 'center',
                'icon' => Alert::TYPE_SUCCESS,
                'title' => 'บันทึกสำเร็จ!',
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);
            return $this->redirect(['index']);
        }

        return $this->render('cancel_booking', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Booking::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDistrictList()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                foreach (Amphures::find()->where(['province_id' => $province_id])->orderBy(['name_th' => SORT_ASC])->all() as $district) {
                    $out[] = ['id' => $district->id, 'name' => $district->name_th];
                }

                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionMenu(){
        $this->layout = 'line';

        return $this->render('menu');
    }

}
