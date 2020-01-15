<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190530_082904_update_utilities_data_table
 */
class m190530_082956_update_utilities_data_table extends Migration
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
            [4, User::ROLE_ADMIN, 'Chủ đề thành viên xóa', 'fa fa-circle-o', 'topic/user-delete', 13, 1, 1],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190530_082904_update_utilities_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190530_082904_update_utilities_data_table cannot be reverted.\n";

        return false;
    }
    */
}
