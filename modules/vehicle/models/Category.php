<?php

namespace app\modules\vehicle\models;

use Yii;
use yii\helpers\Json;
/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $group_name กลุ่มตาราง
 * @property string|null $type_name ประภทตาราง
 * @property string|null $title
 * @property string|null $description
 * @property int|null $status สถานะ
 * @property string|null $data_json
 */
class Category extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public $file;
    public $q;
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'string'],
            [['status'], 'integer'],
            [['ref'], 'string', 'max' => 200],
            [['group_name', 'type_name'], 'string', 'max' => 255],
            [['data_json','code','photo','q'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\upload\UploadBehavior',
                'attribute' => 'file', // required, use to receive input file
                'savedAttribute' => 'photo', // optional, use to link model with saved file.
                'uploadPath' => Yii::getAlias('@webroot').'/uploads', // saved directory. default to '@runtime/upload'
                'autoSave' => true, // when true then uploaded file will be save before ActiveRecord::save()
                'autoDelete' => true, // when true then uploaded file will deleted before ActiveRecord::delete()
            ],
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
            'group_name' => 'กลุ่มตาราง',
            'type_name' => 'ประภทตาราง',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'สถานะ',
            'data_json' => 'Data Json',
            'q' => 'ค้นหา'
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



    public function CheckCar($start, $end,$car_id) 
    {
        // $sql = "SELECT count(id) FROM booking WHERE start >= :start or end <= :end AND car_id = :car_id AND status_id in ('cancel','success')";
        // $sql = "SELECT count(c.id) FROM `category` c LEFT JOIN booking b ON b.car_id = c.id WHERE c.type_name = 'car' AND c.id = :car_id AND b.start <= :end";
        // $sql = "SELECT count(c.id) FROM `category` c LEFT JOIN booking b ON b.car_id = c.id WHERE c.type_name = 'car' AND c.id = :car_id AND b.end < :start";
        $sql = "SELECT count(c.id) FROM `category` c 
        LEFT JOIN booking b ON b.car_id = c.id WHERE c.type_name = 'car' AND c.id = :car_id
        AND ( (b.start >= :start AND b.end <= :start) 
        OR (b.start <= :end AND b.end >= :end ) 
        OR (b.start <= :start AND b.end >= :start) 
        OR (b.start >= :end AND b.end <= :end ))";
        $query = Yii::$app->db->CreateCommand($sql)
        ->bindValue(':start', $start)
        ->bindValue(':end', $end)
        ->bindValue(':car_id', $car_id)
        ->queryScalar();
        // ->getRawSql();
        return $query;
    }



}
