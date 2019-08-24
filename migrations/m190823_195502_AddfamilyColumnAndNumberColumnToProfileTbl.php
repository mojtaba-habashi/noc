<?php

use yii\db\Migration;

/**
 * Class m190823_195502_AddfamilyColumnAndNumberColumnToProfileTbl
 */
class m190823_195502_AddfamilyColumnAndNumberColumnToProfileTbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'profile',
            'family',
            $this->string()
        );
        $this->addColumn(
            'profile',
            'number',
            $this->string()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            'profile',
            'family'
        );
        $this->dropColumn(
            'profile',
            'number'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190823_195502_AddfamilyColumnAndNumberColumnToProfileTbl cannot be reverted.\n";

        return false;
    }
    */
}
