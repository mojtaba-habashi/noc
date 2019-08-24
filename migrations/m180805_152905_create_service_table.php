<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `station`
 * - `service_type`
 */
class m180805_152905_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'station_id' => $this->integer()->notNull(),
            'service_type_id' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'phone' => $this->char('11')->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-service-user_id',
            'service',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-service-user_id',
            'service',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `station_id`
        $this->createIndex(
            'idx-service-station_id',
            'service',
            'station_id'
        );

        // add foreign key for table `station`
        $this->addForeignKey(
            'fk-service-station_id',
            'service',
            'station_id',
            'station',
            'id',
            'CASCADE'
        );

        // creates index for column `service_type_id`
        $this->createIndex(
            'idx-service-service_type_id',
            'service',
            'service_type_id'
        );

        // add foreign key for table `service_type`
        $this->addForeignKey(
            'fk-service-service_type_id',
            'service',
            'service_type_id',
            'service_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-service-user_id',
            'service'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-service-user_id',
            'service'
        );

        // drops foreign key for table `station`
        $this->dropForeignKey(
            'fk-service-station_id',
            'service'
        );

        // drops index for column `station_id`
        $this->dropIndex(
            'idx-service-station_id',
            'service'
        );

        // drops foreign key for table `service_type`
        $this->dropForeignKey(
            'fk-service-service_type_id',
            'service'
        );

        // drops index for column `service_type_id`
        $this->dropIndex(
            'idx-service-service_type_id',
            'service'
        );

        $this->dropTable('service');
    }
}
