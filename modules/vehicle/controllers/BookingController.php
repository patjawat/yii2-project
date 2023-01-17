<?php

namespace app\modules\vehicle\controllers;

use Yii;
use app\models\Amphures;
use app\modules\vehicle\models\Booking;
use app\modules\vehicle\models\BookingSearch;
// use yii\web\Controller;
use app\modules\usermanager\components\CheckUpController as Controller;
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
use app\components\SystemHelper;
use app\components\UserHelper;
use app\components\LineHelper;
use yii\helpers\Json;
use app\modules\usermanager\models\Auth;

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
        //if(Yii::$app->user->can('user')){
        // $dataProvider->query->andWhere(['created_by' => Yii::$app->user->id]);
        $dataProvider->query->andWhere(['<>','status_id','cancel']);
    //}
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_ASC,
            ]
        ]);
        
   

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionConfirmJob()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = $this->request->get('id');
        $model = $this->findModel($id);
        if ($model->driver_id == '') {
            $model->driver_id = Yii::$app->user->identity->id;
            $model->status_id = 'approve';
        }
        if ($model->save()) {
            return $this->redirect(['/vehicle/myjob/update', 'id' => $model->id]);
        }

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
            if ($model->load($this->request->post()) && $model->validate()) {
                if($model->car->checkCar($model->start,$model->end,$model->car_id) > 0){
                    return $this->render('_notnull');
                   
                }

                $model->status_id =  Yii::$app->user->can('driver') ? 'approve' : 'await';
                $model->driver_id = Yii::$app->user->can('driver') ? Yii::$app->user->identity->id : '';
                if($model->save()){
                    $msg = '#จองรถทะเบียน : '.$model->car->data_json['car_regis']."\n".'#ผู้ขอ : '.$model->createBy->fullname."\n".'#เรื่อง : '.$model->title."\n".'#วันที่ : '.$model->start.' ถึง '.$model->end;
                    LineHelper::PushMessageCarBooking($msg);
                    Yii::$app->session->setFlash('position', [
                        'position' => 'center',
                        'icon' => Alert::TYPE_SUCCESS,
                        'title' => 'บันทึกสำเร็จ!',
                        'showConfirmButton' => false,
                        'timer' => 1500
                    ]);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
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


        if ($this->request->isPost && $model->load($this->request->post())) {

            $oldModel = $this->findModel($id);
            // ถ้ามีการเลือกรถคันไหมตรวจสอบว่าว่างหรือไม่
            if($oldModel->car_id != $model->car_id){
                if($model->car->checkCar($model->start,$model->end,$model->car_id) > 0){
                    return $this->render('_notnull');
                }
            }

            if($model->save(false)){
            Yii::$app->session->setFlash('position', [
                'position' => 'center',
                'icon' => Alert::TYPE_SUCCESS,
                'title' => 'บันทึกสำเร็จ!',
                'showConfirmButton' => false,
                'timer' => 1500
            ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
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
        // Yii::$app->response->format = Response::FORMAT_JSON;

            // return json_decode($model->data_json)->cancel_note;
            // return $a->cancel_note;
            $msg = '#ยกเลิกจอง  : '.$model->car->data_json['car_regis']."\n".'#ผู้ขอ : '.$model->createBy->fullname."\n".'#เหตุผลการยกลิก : '.json_decode($model->data_json)->cancel_note;
            LineHelper::BroadcastMassage($msg);
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
        $templateProcessor = new Processor(Yii::getAlias('@webroot').'/msword/template_in_2.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        // $templateProcessor->setValue('date1', $date1);
        $time = time();
        $dateTime = DateTimeHelper::Duration($model->start,$model->end)['hour'];
        // return $dateTime;
        // $create_doc = Yii::$app->thaiFormatter->asDate($time, 'full');
        $date = Yii::$app->thaiFormatter->asDate($time, 'medium');
        $date_long = Yii::$app->thaiFormatter->asDate($time, 'long');

        $doc_day = explode(' ',$date)[0];
        $doc_month = explode(' ',$date)[1];
        $doc_month_long = explode(' ',$date_long)[1];
        $doc_year = explode(' ',$date)[2];

        $dateTimeStart = explode(" ",$model->start);
        $dateTimeEnd = explode(" ",$model->end);
        $total_day = DateTimeHelper::Duration($model->start,$model->end)['day'];
        $total_hour = DateTimeHelper::Duration($model->start,$model->end)['hour'];
        $total_minute = DateTimeHelper::Duration($model->start,$model->end)['minute'];
        $fix_day = $total_day != null ? $total_day : 1;

        $travel_allowance = isset($model->data_json['travel_allowance']) ? (int)$model->data_json['travel_allowance'] : '-';
        $travel_allowance_sum = isset($model->data_json['travel_allowance']) ? ((int)$model->data_json['travel_allowance'] * (int)$fix_day) : '-';
        $vehicle_cost = isset($model->data_json['travel_allowance'])  ? (int)$model->data_json['vehicle_cost'] * (int)$fix_day : '-';
        $rent = isset($model->data_json['rent']) ? (int)$model->data_json['rent'] : '-';
        $rent_sum = isset($model->data_json['rent']) ? (int)$model->data_json['rent'] * (int)$fix_day : '-';
        $other_cost = isset($model->data_json['other_cost']) ? $model->data_json['other_cost'] : '-';
        $total = (int)((int)$travel_allowance_sum+(int)$vehicle_cost+(int)$rent_sum+(int)$other_cost);
        $templateProcessor->setValue('title', $model->title);
        $templateProcessor->setValue('created_at', $date_long);
        $templateProcessor->setValue('doc_number', isset($model->data_json['doc_number']) ? $model->data_json['doc_number'] : '-');
        $templateProcessor->setValue('doc_number_date', isset($model->data_json['doc_number_date']) ? Yii::$app->thaiFormatter->asDate($model->data_json['doc_number_date'], 'long') : '-');
        $templateProcessor->setValue('member', isset($model->data_json['member']) ? $model->data_json['member'] : '-');
        $templateProcessor->setValue('d', $doc_day);
        $templateProcessor->setValue('doc_month', $doc_month);
        $templateProcessor->setValue('m_long', $doc_month_long);
        $templateProcessor->setValue('year', $doc_year);
        $templateProcessor->setValue('start_d', Yii::$app->thaiFormatter->asDate($dateTimeStart[0],'medium'));
        $templateProcessor->setValue('st_t',substr($dateTimeStart[1], 0, -3));
        $templateProcessor->setValue('end_d', Yii::$app->thaiFormatter->asDate($dateTimeEnd[0],'medium'));
        $templateProcessor->setValue('en_t', substr($dateTimeEnd[1], 0, -3));
        $templateProcessor->setValue('day',$total_day != null ?  $total_day  : ($total_hour == 8 ? 1  : '-' ));
        $templateProcessor->setValue('hour', $total_hour != null ?  ($total_hour == 8 ? '-' : $total_hour ) : '-');
        $templateProcessor->setValue('minute', $total_minute != null ? $total_minute :'-');
        $templateProcessor->setValue('fd',$fix_day);
        $templateProcessor->setValue('fullname', 'นายปัจวัฒน์ ศรีบุญเรือง');
        $templateProcessor->setValue('position_name', isset($model->data_json['position_name']) ? $model->data_json['position_name'] : '-');
        $templateProcessor->setValue('group_name', isset($model->data_json['group_name']) ? $model->data_json['group_name'] : '-');
        $templateProcessor->setValue('tra', number_format((int)$travel_allowance),2);
        $templateProcessor->setValue('tra_sum',number_format((int)$travel_allowance_sum,2));
        $templateProcessor->setValue('v_cost',number_format((int)$vehicle_cost,2));
        $templateProcessor->setValue('rent',number_format((int)$rent,2));
        $templateProcessor->setValue('rent_sum',number_format((int)$rent_sum,2));
        $templateProcessor->setValue('other_cost',number_format((int)$other_cost,2));
        $templateProcessor->setValue('total', number_format((int)$total,2));
        $templateProcessor->setValue('total_string', SystemHelper::Convert($total));
        $templateProcessor->setImg('img1', ['src' => Yii::getAlias('@webroot') . '/images/logo2.jpg','swh'=>'250']);



        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/msword/ms_word_result.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่
        return '<p>' . Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx'), ['class' => 'btn btn-info']) .
        '</p><iframe src="https://docs.google.com/viewerng/viewer?url=' . Url::to(Yii::getAlias('@web') . '/msword/ms_word_result.docx', true) . '&embedded=true"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
   
        }
}
