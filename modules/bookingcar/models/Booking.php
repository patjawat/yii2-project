<?php

namespace app\modules\bookingcar\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $date_start วันเดินทาง
 * @property string|null $time_start วันเดินทาง
 * @property string|null $date_end วันออกเดินทาง
 * @property string|null $time_end วันออกเดินทาง
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
            [['car_id', 'data_json'], 'string'],
            [['ref'], 'string', 'max' => 200],
            [['date_start', 'time_start', 'date_end', 'time_end', 'province_id', 'district_id'], 'string', 'max' => 255],
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
            'date_start' => 'วันเดินทาง',
            'time_start' => 'วันเดินทาง',
            'date_end' => 'วันออกเดินทาง',
            'time_end' => 'วันออกเดินทาง',
            'province_id' => 'จังหวัด',
            'district_id' => 'อำเภอ',
            'car_id' => 'รถ',
            'data_json' => 'json',
        ];
    }

    public function init() {
        if ($this->isNewRecord) {
            $this->ref = substr(Yii::$app->getSecurity()->generateRandomString(), 10);
        }
        parent::init();
    }

    public function afterFind() {
        $this->data_json = Json::decode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $this->cars = Json::decode($this->cars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return parent::afterFind();
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->data_json = Json::encode($this->data_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $this->cars = Json::encode($this->cars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
         
            return true;
        } else {
            return false;
        }
    }
}
