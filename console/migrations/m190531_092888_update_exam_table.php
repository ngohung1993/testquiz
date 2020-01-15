<?php

use yii\db\Migration;

/**
 * Class m190531_092856_update_exam_table
 */
class m190531_092888_update_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('exam', 'set_date_time_end', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190531_092856_update_exam_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190531_092856_update_exam_table cannot be reverted.\n";

        return false;
    }
    */
}
