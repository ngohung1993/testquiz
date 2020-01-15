<?php

use yii\db\Migration;

/**
 * Class m190517_090231_update_topic_table
 */
class m190517_090232_update_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('topic', 'display',$this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190517_090231_update_topic_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190517_090231_update_topic_table cannot be reverted.\n";

        return false;
    }
    */
}
