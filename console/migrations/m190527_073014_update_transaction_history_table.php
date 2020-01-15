<?php

use yii\db\Migration;

/**
 * Class m190527_073014_update_transaction_history_table
 */
class m190527_073014_update_transaction_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('transaction_history', 'exam_id', $this->integer());
        $this->addForeignKey('fk_transaction_history_exam', 'transaction_history', 'exam_id', 'exam', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_073014_update_transaction_history_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_073014_update_transaction_history_table cannot be reverted.\n";

        return false;
    }
    */
}
