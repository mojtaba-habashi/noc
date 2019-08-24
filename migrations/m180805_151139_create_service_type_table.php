<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_type`.
 */
class m180805_151139_create_service_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service_type');
    }
}
