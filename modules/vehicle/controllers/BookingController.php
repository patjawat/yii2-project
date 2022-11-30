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
use yii\web\Response;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Settings;
use app\components\Processor;
use app\components\DateTimeHelper;

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
        $status = $this->request->get('status');
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        isset($status) ? $dataProvider->query->where(['status_id' => $status]) : '';
        if(!Yii::$app->user->can('driver')){
        $dataProvider->query->andWhere(['created_by' => Yii::$app->user->id]);
        $dataProvider->query->andWhere(['<>','status_id','cancel']);
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_ASC,
            ]
        ]);
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
        $model = $this->findModel($id);
    
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

       
    }

    public function actionViewAjax($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);
            return[
                'title' =>'เรื่อง # '.$model->title,
                'content' =>  $this->renderAjax('view-ajax', [
                    'model' =>$model,
                ])
                ];
            

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
            'end' => $end,
            'data_json' =>  ['fullname' => Yii::$app->user->identity->fullname],
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


        if(Yii::$app->user->can('user') && $model->status_id == 'approve')
        {
            Yii::$app->session->setFlash('position', [
                'icon' => Alert::TYPE_WARNING,
                'title' => 'ไม่สามารถแก้ไขได้!',
                'text' => 'เนื่องจากอนุมัติแล้วกรุณาติดต่อผู้กูแลระบบ!',
                'showConfirmButton' => false,
                'timer' => 1500
            ]);
            return $this->render('view', [
                'model' => $model,
            ]);
        }else{

            return $this->render('update', [
                'model' => $model,
                'driver' => $driver
            ]);
        }
    }

    public function actionCancel($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('position', [
                'position' => 'center',
                'icon' => Alert::TYPE_SUCCESS,
                'title' => 'บันทึกสำเร็จ!',
                'showConfirmButton' => false,
                'timer' => 1500
            ]);
            return $this->redirect(['index']);
        }

        return $this->render('cancel_booking', [
            'model' => $model
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


    // public function actionMyjob() 
    // {

    //     $searchModel = new BookingSearch();
    //     $dataProvider = $searchModel->search($this->request->queryParams);
    //     $dataProvider->query->where(['driver_id' => Yii::$app->user->id]);
    //     $dataProvider->query->andWhere(['in', 'status_id',['approve']]);

    //     return $this->render('myjob', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }


    public function actionEvents($start, $end)
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
       $dataProvider->query->where(['status_id' => 'approve']);
       
        


        $datas = [];
        foreach ( $dataProvider->getModels() as $event)
        {
            $datas[] = [
                'id' => $event->id,
				'title' => 'เรื่อง #' . $event->title,
				'start' => $event->start,
				'end' => $event->end,
			];
            
        }

		return $datas;
	}


    public function actionDocument(){

        // Settings::setTempDir(Yii::getAlias('@webroot').'/temp/');
        $id = $this->request->get('id');

        $model = $this->findModel($id);
        // $date2 = $this->request->get('date2');

        // $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        $templateProcessor = new Processor(Yii::getAlias('@webroot').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        // $templateProcessor->setValue('date1', $date1);
        $time = time();
        $dateTime = DateTimeHelper::Duration($model->start,$model->end)['hour'];
        // return $dateTime;
        $date = Yii::$app->thaiFormatter->asDate($time, 'medium');

        $dateTimeStart = explode(" ",$model->start);
        $dateTimeEnd = explode(" ",$model->end);
        $total_day = DateTimeHelper::Duration($model->start,$model->end)['day'];
        $total_hour = DateTimeHelper::Duration($model->start,$model->end)['hour'];
        $total_minute = DateTimeHelper::Duration($model->start,$model->end)['minute'];

        $templateProcessor->setValue('title', $model->title);
        $templateProcessor->setValue('created_at', $date);
        $templateProcessor->setValue('start_date', Yii::$app->thaiFormatter->asDate($dateTimeStart[0],'medium'));
        $templateProcessor->setValue('start_time',substr($dateTimeStart[1], 0, -3));
        $templateProcessor->setValue('end_date', Yii::$app->thaiFormatter->asDate($dateTimeEnd[0],'medium'));
        $templateProcessor->setValue('end_time', substr($dateTimeEnd[1], 0, -3));
        $templateProcessor->setValue('total_day',$total_day != null ? $total_day : '-');
        $templateProcessor->setValue('total_hour', $total_hour != null ?  $total_hour : '-');
        $templateProcessor->setValue('total_minute', $total_minute != null ? $total_minute :'-');
        $templateProcessor->setValue('fullname', 'นายปัจวัฒน์ ศรีบุญเรือง');
        $templateProcessor->setValue('position_name', 'เจ้าพนักงานคอมพิวเตอร์');
        $templateProcessor->setValue('group_name', 'กองป้องกันและรักษาความปลอดภัย');
        // $templateProcessor->setValue('src1', Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg');
        // $templateProcessor->setImageValue('img1', ['src' => Yii::getAlias('@webroot') . '/images/logo2.jpg','swh'=>'250']);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        $templateProcessor->setImg('img1', ['src' => Yii::getAlias('@webroot') . '/images/logo2.jpg','swh'=>'250']);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImageValue('img1', ['src' => Yii::getAlias('@webroot') . '/images/moph_logo.png','swh'=>'250']);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImageValue('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImageValue('img1', ['src' => Yii::getAlias('@webroot') . '/images/auth/login-bg.jpg', 'swh' => 150]);//ที่อยู่รูป frontend/web/img/logo.png, swh ความกว้าง/สูง 150 
        // $templateProcessor->setImg('img2', ['src' => Yii::getAlias('@webroot') . '/images/cctv.png', 'swh' => 350]);//ที่อยู่รูป frontend/web/images/cell.jpg, swh ความกว้าง/สูง 350



        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/msword/ms_word_result.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
   
        }
}
