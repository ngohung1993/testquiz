<?php

use yii\db\Migration;

/**
 * Class m190608_034804_update_exam_table
 */
class m190608_034804_update_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('exam', 'views', 'count_bought');
        $this->renameColumn('exam', 'view', 'views');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190608_034804_update_exam_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190608_034804_update_exam_table cannot be reverted.\n";

        return false;
    }
    */
}
