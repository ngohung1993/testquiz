<?php

use yii\db\Migration;

/**
 * Class m190531_174403_update_general_information_table
 */
class m190531_174403_update_general_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('general_information', 'minimum_amount', $this->double()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190531_174403_update_general_information_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190531_174403_update_general_information_table cannot be reverted.\n";

        return false;
    }
    */
}
