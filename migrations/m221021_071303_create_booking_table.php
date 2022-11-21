<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking}}`.
 */
class m221021_071303_create_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(200),
            'title' => $this->string(500),
            'start' => $this->string()->comment('วันเดินทาง'),
            'end' => $this->string()->comment('วันออกเดินทาง'),
            'province_id' => $this->string()->comment('จังหวัด'),
            'district_id' => $this->string()->comment('อำเภอ'),
            'car_id' => $this->json()->comment('รถ'),
            'data_json' => $this->json()->comment('json'),
            'status_id' => $this->string(200)->comment('สถานะ'),
            'driver_id' => $this->string(50)->comment('คนขับ'),
            'booking_type' => $this->string(50)->comment('ประเภทการจอง'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_at' => $this->timestamp(),   
            'created_by' => $this->integer()->comment('ผู้สร้าง'),
            'updated_by' => $this->integer()->comment('ผู้แก้ไข')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking}}');
    }
}
