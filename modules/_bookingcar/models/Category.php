<?php

namespace app\modules\bookingcar\models;

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
            [['data_json','code'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\upload\UploadBehavior',
                'attribute' => 'file', // required, use to receive input file
                'savedAttribute' => 'id', // optional, use to link model with saved file.
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



}
