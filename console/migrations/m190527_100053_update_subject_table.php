<?php

use yii\db\Migration;

/**
 * Class m190527_100053_update_subject_table
 */
class m190527_100053_update_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('subject', 'seo_tool_id', $this->integer());
        $this->addForeignKey('fk_subject_seo_tool', 'subject', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_100053_update_subject_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_100053_update_subject_table cannot be reverted.\n";

        return false;
    }
    */
}
