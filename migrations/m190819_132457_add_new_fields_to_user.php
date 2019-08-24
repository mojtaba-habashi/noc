<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m190819_132457_add_new_fields_to_user
 */
class m190819_132457_add_new_fields_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'first_name', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('{{%user}}', 'last_name', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('{{%user}}', 'address', Schema::TYPE_TEXT . ' NOT NULL');
        $this->addColumn('{{%user}}', 'mobile', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('{{%user}}', 'isadmin', Schema::TYPE_STRING . ' NOT NULL');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'address');
        $this->dropColumn('{{%user}}', 'mobile');
        $this->dropColumn('{{%user}}', 'isadmin');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190819_132457_add_new_fields_to_user cannot be reverted.\n";

        return false;
    }
    */
}
