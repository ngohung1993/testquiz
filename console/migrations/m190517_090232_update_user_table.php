<?php

use yii\db\Migration;

/**
 * Class m190517_090231_update_user_table
 */
class m190517_090232_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'auth', $this->integer());
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
