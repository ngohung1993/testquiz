<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190612_043647_update_utilities_data_table
 */
class m190612_043648_update_utilities_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%utilities}}', [
            'serial',
            'permission',
            'title',
            'icon',
            'path',
            'parent_id',
            'released',
            'status'
        ], [
            [4, User::ROLE_ADMIN, 'Đề thi báo lỗi', 'fa fa-circle-o', 'exam/error', 14, 1, 1],
            [4, User::ROLE_ADMIN, 'Đề thi thành viên xóa', 'fa fa-circle-o', 'exam/user-delete', 14, 1, 1],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190612_043647_update_utilities_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_043647_update_utilities_data_table cannot be reverted.\n";

        return false;
    }
    */
}
