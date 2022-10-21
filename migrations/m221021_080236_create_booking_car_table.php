<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking_car}}`.
 */
class m221021_080236_create_booking_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_car}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(200)->comment('ref'),
            'car_type_id' => $this->integer()->comment('ประเภทรถ'),
            'car_regis' => $this->string()->comment('ทะเบียน'),
            'band' => $this->string()->comment('ยี่ห้อ'),
            'model' => $this->string()->comment('รุ่น'),
            'seat' => $this->integer()->comment('จำนวนที่นั่ง'),
            'mileage' => $this->integer()->comment('เลขไมล์'),
            'photo' => $this->string(200)->comment('รูปภาพ'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking_car}}');
    }
}
