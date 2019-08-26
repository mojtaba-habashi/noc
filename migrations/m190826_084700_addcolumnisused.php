<?php

use yii\db\Migration;

/**
 * Class m190826_084700_addcolumnisused
 */
class m190826_084700_addcolumnisused extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

            $this->addColumn(
                'station',
                'is_used',
                $this->integer()->defaultValue(0)
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            'station',
            'is_used'
        );
    }

}
