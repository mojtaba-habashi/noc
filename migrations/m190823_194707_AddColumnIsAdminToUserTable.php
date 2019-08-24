<?php

use yii\db\Migration;

/**
 * Class m190823_194707_AddColumnIsAdminToUserTable
 */
class m190823_194707_AddColumnIsAdminToUserTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'user',
            'is_admin',
            $this->integer()->defaultValue(0)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            'user',
            'is_admin'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190823_194707_AddColumnIsAdminToUserTable cannot be reverted.\n";

        return false;
    }
    */
}
