<?php

use yii\db\Migration;

/**
 * Class m190522_090742_updated_account_bank_table
 */
class m190522_090742_updated_account_bank_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('account_bank', 'status', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190522_090742_updated_account_bank_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190522_090742_updated_account_bank_table cannot be reverted.\n";

        return false;
    }
    */
}
