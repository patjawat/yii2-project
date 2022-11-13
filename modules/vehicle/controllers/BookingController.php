<?php

namespace app\modules\vehicle\controllers;

use Yii;
use app\models\Amphures;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use dominus77\sweetalert2\Alert;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Booking models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if(!Yii::$app->user->can('driver')){
        $dataProvider->query->where(['created_by' => Yii::$app->user->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Booking model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
       $car_id = $this->request->get('car_id');
       $start = $this->request->get('start');
       $end = $this->request->get('end');
        $model = new Booking([
            'ref' =>  substr(Yii::$app->getSecurity()->generateRandomString(), 10),
            'car_id' => $car_id,
            'start' => $start,
            'end' => $end
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
                    'timer' => 1500
                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'car_id' => $car_id
        ]);
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sql = "SELECT u.id,u.fullname FROM auth_assignment a INNER JOIN user u ON u.id = a.user_id;";
        $driver = Yii::$app->db->createCommand($sql)->queryAll();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('position', [
                'position' => 'center',
                'icon' => Alert::TYPE_SUCCESS,
                'title' => 'บันทึกสำเร็จ!',
                'showConfirmButton' => false,
                'timer' => 1500
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'driver' => $driver
        ]);
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
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


    public function actionMyjob() 
    {

        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['driver_id' => Yii::$app->user->id]);
        $dataProvider->query->andWhere(['in', 'status_id',['approve']]);

        return $this->render('myjob', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
