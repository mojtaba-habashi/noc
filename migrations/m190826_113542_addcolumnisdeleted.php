<?php

use yii\db\Migration;

/**
 * Class m190826_113542_addcolumnisdeleted
 */
class m190826_113542_addcolumnisdeleted extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn(
            'service',
            'is_deleted',
            $this->integer()->defaultValue(0)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            'service',
            'is_deleted'
        );
    }



    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190826_113542_addcolumnisdeleted cannot be reverted.\n";

        return false;
    }
    */
}
