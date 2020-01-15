<?php

use yii\db\Migration;

/**
 * Class m190620_044903_update_post_table
 */
class m190620_044903_update_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'link', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190620_044903_update_post_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190620_044903_update_post_table cannot be reverted.\n";

        return false;
    }
    */
}
