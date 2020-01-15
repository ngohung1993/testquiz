<?php

use yii\db\Migration;

/**
 * Class m190513_025258_update_topic_table
 */
class m190513_025258_update_topic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('topic', 'category_id',$this->integer());
        $this->addForeignKey('fk_topic_category', 'topic', 'category_id', 'category', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190513_025258_update_topic_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190513_025258_update_topic_table cannot be reverted.\n";

        return false;
    }
    */
}
