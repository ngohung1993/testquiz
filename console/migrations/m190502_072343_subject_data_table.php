<?php

use yii\db\Migration;

/**
 * Class m190502_072343_subject_data_table
 */
class m190502_072343_subject_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%subject}}', [
            'title',
            'status',
            'created_at',
            'updated_at'
        ], [
            ['Toán ', 1, time(), time()],
            ['Môn Tiếng việt', 1, time(), time()],
            ['Môn Đại số', 1, time(), time()],
            ['Môn văn lớp 2', 1, time(), time()],
            ['Môn hóa', 1, time(), time()],
            ['Môn sinh', 1, time(), time()],
            ['Môn Lịch sử', 1, time(), time()],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190502_072343_subject_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190502_072343_subject_data_table cannot be reverted.\n";

        return false;
    }
    */
}
