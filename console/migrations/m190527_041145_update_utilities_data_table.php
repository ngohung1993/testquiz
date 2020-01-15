<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190527_041144_update_utilities_data_table
 */
class m190527_041145_update_utilities_data_table extends Migration
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
            [1, User::ROLE_ADMIN, 'Chủ đề tải lên', 'fa fa-circle-o', 'topic/index?status=0', 13, 1, 1],
            [2, User::ROLE_ADMIN, 'Chủ đề đã duyệt', 'fa fa-circle-o', 'topic/index?status=1', 13, 1, 1],
            [3, User::ROLE_ADMIN, 'Chủ đề vi phạm ', 'fa fa-circle-o', 'topic/index?status=2', 13, 1, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190527_041144_update_utilities_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190527_041144_update_utilities_data_table cannot be reverted.\n";

        return false;
    }
    */
}
