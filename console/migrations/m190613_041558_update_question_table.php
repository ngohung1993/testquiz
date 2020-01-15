<?php

use yii\db\Migration;

/**
 * Class m190613_041558_update_question_table
 */
class m190613_041558_update_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('question', 'parent_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190613_041558_update_question_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190613_041558_update_question_table cannot be reverted.\n";

        return false;
    }
    */
}
