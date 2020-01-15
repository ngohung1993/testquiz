<?php

use yii\db\Migration;

/**
 * Class m190509_073559_update_user_table
 */
class m190509_073559_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'description',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190509_073559_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190509_073559_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
