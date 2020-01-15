<?php

use yii\db\Migration;

/**
 * Class m190527_071717_update_general_infomation_table
 */
class m190527_071717_update_general_infomation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('general_information', 'meta_keyword', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_071717_update_general_infomation_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_071717_update_general_infomation_table cannot be reverted.\n";

        return false;
    }
    */
}
