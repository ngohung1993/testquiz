<?php

use yii\db\Migration;

/**
 * Class m190513_032750_category_data_table
 */
class m190513_032750_category_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%category}}', [
            'title',
            'status',
            'type',
            'page_id',
            'created_at',
            'updated_at'
        ], [
            ['Học tập' , 1, 1, 1, time(), time()],
            ['Trắc nghiệm' , 1, 1,1, time(), time()],
            ['IQ' , 1, 1, 2, time(), time()],
            ['Giải bài tập' , 1, 1, 2, time(), time()],



        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190513_032750_category_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190513_032750_category_data_table cannot be reverted.\n";

        return false;
    }
    */
}
