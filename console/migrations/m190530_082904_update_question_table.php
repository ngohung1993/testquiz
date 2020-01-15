<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190530_082904_update_question_table.php
 */
class m190530_082904_update_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('question', 'media', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190530_082904_update_question_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190530_082904_update_question_table cannot be reverted.\n";

        return false;
    }
    */
}
