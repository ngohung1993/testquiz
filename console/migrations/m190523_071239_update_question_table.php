<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190523_071239_update_question_data_table
 */
class m190523_071239_update_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->addColumn('question', 'type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190523_071239_update_question_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190523_071239_update_question_table cannot be reverted.\n";

        return false;
    }
    */
}
