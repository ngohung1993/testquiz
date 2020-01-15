<?php

use yii\db\Migration;

/**
 * Class m190502_072330_classroom_data_table
 */
class m190502_072330_classroom_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%classroom}}', [
            'title',
            'status',
            'created_at',
            'updated_at'
        ], [
            ['Lớp 1', 1, 1513866397, 1513866397],
            ['Lớp 2', 1, 1513866397, 1513866397],
            ['Lớp 3', 1, 1513866397, 1513866397],
            ['Lớp 4', 1, 1513866397, 1513866397],
            ['Lớp 5', 1, 1513866397, 1513866397],
            ['Lớp 6', 1, 1513866397, 1513866397],
            ['Lớp 7', 1, 1513866397, 1513866397],
            ['Lớp 8', 1, 1513866397, 1513866397],
            ['Lớp 9', 1, 1513866397, 1513866397],
            ['Lớp 10', 1, 1513866397, 1513866397],
            ['Lớp 11', 1, 1513866397, 1513866397],
            ['Lớp 12', 1, 1513866397, 1513866397],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190502_072330_classroom_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190502_072330_classroom_data_table cannot be reverted.\n";

        return false;
    }
    */
}
