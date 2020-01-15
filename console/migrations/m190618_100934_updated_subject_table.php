<?php

use yii\db\Migration;

/**
 * Class m190618_100934_updated_subject_table
 */
class m190618_100934_updated_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('subject', 'disable', $this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190618_100934_updated_subject_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190618_100934_updated_subject_table cannot be reverted.\n";

        return false;
    }
    */
}
