<?php

use yii\db\Migration;

/**
 * Handles the creation of table `station`.
 */
class m180804_112258_create_station_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('station', [
            'id' => $this->primaryKey(),
            'type' => "ENUM('point', 'pop_site')",
            'name' => $this->string(),
            'description' => $this->text(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('station');
    }
}
