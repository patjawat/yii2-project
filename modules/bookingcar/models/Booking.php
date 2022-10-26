<?php

namespace app\modules\bookingcar\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $province_id จังหวัด
 * @property string|null $district_id อำเภอ
 * @property int|null $passengers_number จำนวนผู้โดยสาร
 * @property string|null $cars รถ
 * @property string|null $data_json json
 * @property string|null $passengers_name ชื่อผู้โดยสาร
 * @property int|null $contact_name ผู้ติดต่อ
 * @property int|null $contact_phone เบอร์โทรผู้ติดต่อ
 * @property string|null $rally_point สถานที่รับ
 * @property string|null $date_start วันเดินทาง
 * @property string|null $time_start วันเดินทาง
 * @property string|null $title ภาระกิจ
 * @property string|null $description มีความประสงค์จะขอใช้รถเพื่อ
 * @property string|null $stopover จุดหมายอื่นที่สำคัญ(จุดแวะ)
 * @property int|null $cost_type ค่าเชื้อเพลิง
 * @property string|null $person_name ผู้รับรองและผู้ยื่นคำขอ
 * @property string|null $certifier_name ชื่อผู้รับรอง
 * @property string|null $certifier_position ตำแหน่งผู้รับรอง
 * @property string|null $author_id ผู้ขอใช้บริการ
 * @property string|null $author_position ตำแหน่งของผู้ใช้บริการ
 * @property string|null $date_end วันออกเดินทาง
 * @property string|null $time_end วันออกเดินทาง
 * @property int|null $receive ผู้รับเรื่อง
 * @property string|null $driver ผู้ขับรถ
 * @property string|null $car_id รถ
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
            [['passengers_number', 'contact_name', 'contact_phone', 'cost_type', 'receive'], 'integer'],
            [['cars', 'data_json', 'passengers_name', 'title', 'description', 'stopover', 'driver', 'car_id'], 'string'],
            [['ref'], 'string', 'max' => 200],
            [['province_id', 'district_id', 'rally_point', 'date_start', 'time_start', 'person_name', 'certifier_name', 'certifier_position', 'author_id', 'author_position', 'date_end', 'time_end'], 'string', 'max' => 255],
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
            'province_id' => 'จังหวัด',
            'district_id' => 'อำเภอ',
            'passengers_number' => 'จำนวนผู้โดยสาร',
            'cars' => 'รถ',
            'data_json' => 'json',
            'passengers_name' => 'ชื่อผู้โดยสาร',
            'contact_name' => 'ผู้ติดต่อ',
            'contact_phone' => 'เบอร์โทรผู้ติดต่อ',
            'rally_point' => 'สถานที่รับ',
            'date_start' => 'วันเดินทาง',
            'time_start' => 'วันเดินทาง',
            'title' => 'ภาระกิจ',
            'description' => 'มีความประสงค์จะขอใช้รถเพื่อ',
            'stopover' => 'จุดหมายอื่นที่สำคัญ(จุดแวะ)',
            'cost_type' => 'ค่าเชื้อเพลิง',
            'person_name' => 'ผู้รับรองและผู้ยื่นคำขอ',
            'certifier_name' => 'ชื่อผู้รับรอง',
            'certifier_position' => 'ตำแหน่งผู้รับรอง',
            'author_id' => 'ผู้ขอใช้บริการ',
            'author_position' => 'ตำแหน่งของผู้ใช้บริการ',
            'date_end' => 'วันออกเดินทาง',
            'time_end' => 'วันออกเดินทาง',
            'receive' => 'ผู้รับเรื่อง',
            'driver' => 'ผู้ขับรถ',
            'car_id' => 'รถ',
        ];
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
