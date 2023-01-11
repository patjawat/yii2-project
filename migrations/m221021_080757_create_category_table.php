<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m221021_080757_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'ref' => $this->string(200),
            'sort' => $this->string(200),
            'code' => $this->string(50),
            'group_name' => $this->string()->comment('กลุ่มตาราง'),
            'type_name' => $this->string()->comment('ประภทตาราง'),
            'title' => $this->text()->comment(''),
            'description' => $this->text()->comment(''),
            'status' => $this->boolean()->comment('สถานะ'),
            'photo' => $this->integer(),
            'data_json' => $this->json()
        ]);

        $this->insert('category',['group_name' => 'booking_sttaus','type_name' => 'booking_sttaus','sort' => 1,'title' => 'ขอใช้รถ','code' => 'await']);
        $this->insert('category',['group_name' => 'booking_sttaus','type_name' => 'booking_sttaus','sort' => 2,'title' => 'จัดสรรคแล้ว','code' => 'allocate']);
        $this->insert('category',['group_name' => 'booking_sttaus','type_name' => 'booking_sttaus','sort' => 3,'title' => 'อนุมัติ','code' => 'approve']);
        $this->insert('category',['group_name' => 'booking_sttaus','type_name' => 'booking_sttaus','sort' => 4,'title' => 'เสร็จสิ้น','code' => 'success']);
        $this->insert('category',['group_name' => 'booking_sttaus','type_name' => 'booking_sttaus','sort' => 5,'title' => 'ยกเลิก','code' => 'cancel']);
        $this->insert('category',['group_name' => 'car','type_name' => 'car_type','sort' => 0,'title' => 'รถตู้','code' => '']);
        $this->insert('category',['group_name' => 'car','type_name' => 'car_type','sort' => 0,'title' => 'รถกระบะ','code' => '']);
        $this->insert('category',['group_name' => 'car','type_name' => 'car_type','sort' => 0,'title' => 'รถ 6 ล้อ','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'พนักงานขับรถยนต์','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'นักวิชาการคอมพิวเตอร์','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'เจ้าพนักงานเครื่องคอมพิวเตอร์','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'นักวิชาการสาธารณสุข','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'พยาบาลวิชาชีพ','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'ผู้ช่วยพยาบาลวิชาชีพ','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'นักกายภาพบำบัติ','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'ทันตแพทย์','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'ผู้่ช่วยทันตแพทย์','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'แพทย์','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'เภสัชกร','code' => '']);
        // $this->insert('category',['group_name' => 'user_position','type_name' => 'user_position','sort' => 0,'title' => 'เจ้าพนักงานบัญชี','code' => '']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
