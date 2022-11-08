<?php

namespace app\modules\bookingcar\models;

use Yii;
use yii\helpers\Json;
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
            [['start', 'end', 'province_id', 'district_id'], 'string', 'max' => 255],
            [['data_json','status_id'], 'safe'],
        ];
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
        ];
    }


    // public function init() {
    //     if ($this->isNewRecord) {
    //         $this->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
    //     }
    //     parent::init();
    // }

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

    public function getCar() {
        return $this->hasOne(Category::className(), ['id' => 'car_id']);
    }

    public function getStatus() {
        return $this->hasOne(Category::className(), ['keycode' => 'status_id']);
    }


}
