<?php

use yii\db\Migration;

/**
 * Class m190823_210919_addForeignKeyToServiceTable
 */
class m190823_210919_addForeignKeyToServiceTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-service-user_id',
            'service',
            'user_id',
            'user',
            'id'
        );
        $this->addForeignKey(
            'fk-service-station_id',
            'service',
            'station_id',
            'station',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-service-user_id',
            'service'
        );
        $this->dropForeignKey(
            'fk-service-station_id',
            'service'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190823_210919_addForeignKeyToServiceTable cannot be reverted.\n";

        return false;
    }
    */
}
