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
            'group_name' => $this->string()->comment('กลุ่มตาราง'),
            'type_name' => $this->string()->comment('ประภทตาราง'),
            'title' => $this->text()->comment(''),
            'description' => $this->text()->comment(''),
            'status' => $this->boolean()->comment('สถานะ'),
            'data_json' => $this->json()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
