<?php

use yii\db\Migration;

/**
 * Class m190502_074242_classroom_detail_data_table
 */
class m190502_074242_classroom_detail_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%classroom_detail}}', [
            'classroom_id',
            'subject_id',
            'created_at',
            'updated_at'
        ], [
            [1 , 1, time(), time()],
            [1, 2, time(), time()],
            [1 , 3, time(), time()],
            [3, 6, time(), time()],
            [3 , 7, time(), time()],
            [2, 1, time(), time()],
            [2, 2, time(), time()],
            [4, 2, time(), time()],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190502_074242_classroom_detail_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190502_074242_classroom_detail_data_table cannot be reverted.\n";

        return false;
    }
    */
}
