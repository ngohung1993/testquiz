<?php

use yii\db\Migration;

/**
 * Class m190527_031638_update_exam_table
 */
class m190527_031638_update_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('exam', 'view', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_031638_update_exam_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_031638_update_exam_table cannot be reverted.\n";

        return false;
    }
    */
}
