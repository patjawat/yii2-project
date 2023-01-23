<?php

namespace app\modules\vehicle\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\db\Expression;

use \yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use app\modules\usermanager\models\User;
/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $start วันเดินทาง
 * @property string|null $end วันออกเดินทาง
 * @property string|null $province_id จังหวัด
 * @property string|null $district_id อำเภอ
 * @property string|null $car_id รถ
 * @property string|null $data_json json
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','start','end','car_id'], 'required'],
            [['car_id','title'], 'string'],
            [['ref'], 'string', 'max' => 200],
            [['created_by', 'updated_by'], 'integer'],
            [['start', 'end', 'province_id', 'district_id'], 'string', 'max' => 255],
            [['data_json','status_id','driver_id','updated_at', 'created_at','booking_type'], 'safe'],
            ['start','validateDates'],
        ];
    }

    public function validateDates(){
        if(strtotime($this->end) <= strtotime($this->start)){
            $this->addError('start','โปรดระบุวันที่เริ่มต้นและวันที่สิ้นสุดให้ถูกต้อง');
            $this->addError('end','โปรดระบุวันที่เริ่มต้นและวันที่สิ้นสุดให้ถูกต้อง');
        }

        // if(strtotime($this->start) <= date('Y-m-d H')){
        //     $this->addError('start','โปรดระบุวันที่เริ่มต้นและวันที่สิ้นสุดให้ถูกต้อง');
        // }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'start' => 'วันเดินทาง',
            'end' => 'วันออกเดินทาง',
            'province_id' => 'จังหวัด',
            'district_id' => 'อำเภอ',
            'car_id' => 'รถ',
            'data_json' => 'json',
            'booking_type' => 'ประเภทการจอง'
        ];
    }


    // public function init() {
    //     if ($this->isNewRecord) {
    //         $this->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
    //     }
    //     parent::init();
    // }


    public function behaviors() {
        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at']],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at'],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ]
        ];
     }

    public function afterFind() {
        $this->data_json = Json::decode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return parent::afterFind();
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->data_json = Json::encode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            return true;
        } else {
            return false;
        }
    }


    public function driversMap() 
    {
        $sql = "SELECT u.id,u.fullname FROM auth_assignment a INNER JOIN user u ON u.id = a.user_id WHERE item_name = 'driver'";
        $driver = Yii::$app->db->createCommand($sql)->queryAll();
        return yii\helpers\ArrayHelper::map($driver, 'id', 'fullname');
    }

    public function carsMap() 
    {
        return yii\helpers\ArrayHelper::map(Category::find()->where(['type_name' => 'car'])->all(), 'id', function ($model) {
            return $model->data_json['band'] .' ทะเบียน '.$model->data_json['car_regis'];
        });
    }

    public function statusMap() 
    {
        return yii\helpers\ArrayHelper::map(Category::find()->where(['type_name' => 'booking_sttaus'])->all(), 'id', function ($model) {
            return $model->title;
        });
    }


    public function driverName() 
    {
        $sql = "SELECT fullname FROM user WHERE id = :id";
        $driver = Yii::$app->db->createCommand($sql)
        ->bindValue(':id', $this->driver_id)
        ->queryScalar();
        return $driver;
    }

    // คำนวนระยะทาง
    public function MileageRang()
    {
        $start = isset($this->data_json['mileage_start']) ? $this->data_json['mileage_start'] : null;
        $end = isset($this->data_json['mileage_end']) ? $this->data_json['mileage_end'] : null;
        if($start !== null && $end !== null){
            return (int)$end - (int)$start;;
        }else{
            return '-';
        }
    }

    // เลขไมค์จากครั้งที่แล้ว
    public function MileageLast()
    {
            $model = self::find()->where(['status_id' => 'success','car_id' => $this->car_id])->orderBy(['id' =>SORT_DESC])->one();
            if($model){
                return isset($model->data_json['mileage_end']) ? $model->data_json['mileage_end'] : null;
            }else{
                return null;
            }
    }

    public function CountByStatus()
    {
        return self::where(['status_id' => $this->status_id])->count();
    }


    public function getCar() {
        return $this->hasOne(Category::className(), ['id' => 'car_id']);
    }

    public function getDriver() {
        return $this->hasOne(User::className(), ['id' => 'driver_id']);
    }

    public function getStatus() {
        return $this->hasOne(Category::className(), ['code' => 'status_id']);
    }

    public function getCreateBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }


}
