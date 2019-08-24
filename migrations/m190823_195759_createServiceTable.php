<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m190823_195759_createServiceTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'service_type' =>$this->string(),
            'address' => $this->string(),
            'user_id' => $this->integer(),
            'tel' => $this->string(),
            'station_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%service}}');
    }
}
