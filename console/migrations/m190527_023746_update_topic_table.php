<?php

use yii\db\Migration;

/**
 * Class m190527_023746_update_topic_table
 */
class m190527_023746_update_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('topic', 'reason_reject', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_023746_update_topic_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_023746_update_topic_table cannot be reverted.\n";

        return false;
    }
    */
}
