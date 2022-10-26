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
            'province_id' => $this->string()->comment('จังหวัด'),
            'district_id' => $this->string()->comment('อำเภอ'),
            'passengers_number' => $this->integer()->comment('จำนวนผู้โดยสาร'),
            'cars' => $this->json()->comment('รถ'),
            'data_json' => $this->json()->comment('json'),
            'passengers_name' => $this->json()->comment('ชื่อผู้โดยสาร'),
            'contact_name' => $this->integer()->comment('ผู้ติดต่อ'),
            'contact_phone' => $this->integer()->comment('เบอร์โทรผู้ติดต่อ'),
            'rally_point' => $this->string()->comment('สถานที่รับ'),
            'date_start' => $this->string()->comment('วันเดินทาง'),
            'time_start' => $this->string()->comment('วันเดินทาง'),
            'title' => $this->text()->comment('ภาระกิจ'),
            'description' => $this->text()->comment('มีความประสงค์จะขอใช้รถเพื่อ'),
            'stopover' => $this->json()->comment('จุดหมายอื่นที่สำคัญ(จุดแวะ)'),
            'cost_type' => $this->integer()->comment('ค่าเชื้อเพลิง'),
            'person_name' => $this->string()->comment('ผู้รับรองและผู้ยื่นคำขอ'),
            'certifier_name' => $this->string()->comment('ชื่อผู้รับรอง'),
            'certifier_position' => $this->string()->comment('ตำแหน่งผู้รับรอง'),
            'author_id' => $this->string()->comment('ผู้ขอใช้บริการ'),
            'author_position' => $this->string()->comment('ตำแหน่งของผู้ใช้บริการ'),
            'date_end' => $this->string()->comment('วันออกเดินทาง'),
            'time_end' => $this->string()->comment('วันออกเดินทาง'),
            'receive' => $this->boolean()->comment('ผู้รับเรื่อง'),
            'driver' => $this->json()->comment('ผู้ขับรถ'),
            'car_id' => $this->json()->comment('รถ'),
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
