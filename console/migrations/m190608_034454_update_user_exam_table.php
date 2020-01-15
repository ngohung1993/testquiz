<?php

use yii\db\Migration;

/**
 * Class m190608_034454_update_user_exam_table
 */
class m190608_034454_update_user_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_exam', 'type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190608_034454_update_user_exam_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190608_034454_update_user_exam_table cannot be reverted.\n";

        return false;
    }
    */
}
