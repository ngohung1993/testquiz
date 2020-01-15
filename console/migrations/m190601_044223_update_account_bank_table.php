<?php

use yii\db\Migration;

/**
 * Class m190601_044223_update_account_bank_table
 */
class m190601_044223_update_account_bank_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('account_bank', 'type', $this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190601_044223_update_account_bank_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190601_044223_update_account_bank_table cannot be reverted.\n";

        return false;
    }
    */
}
