<?php

use yii\db\Migration;

/**
 * Class m190514_072639_update_exam_table
 */
class m190514_072638_update_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('exam', 'disable',$this->integer()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190514_072639_update_exam_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190514_072639_update_exam_table cannot be reverted.\n";

        return false;
    }
    */
}
