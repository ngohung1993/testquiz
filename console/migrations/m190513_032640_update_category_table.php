<?php

use yii\db\Migration;

/**
 * Class m190513_032640_update_category_table
 */
class m190513_032640_update_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'type',$this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190513_032640_update_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190513_032640_update_category_table cannot be reverted.\n";

        return false;
    }
    */
}
