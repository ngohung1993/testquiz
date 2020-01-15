<?php

use common\models\Exam;
use common\models\User;
use yii\db\Migration;

/**
 * Class m190521_094053_update_utilities_data_table
 */
class m190521_094053_update_utilities_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%utilities}}', [
            'id',
            'serial',
            'permission',
            'title',
            'icon',
            'path',
            'parent_id',
            'released',
            'status'
        ], [
            [24, 10, User::ROLE_ADMIN, 'Quản lý tài chính', 'fa fa-credit-card-alt', 'null', null, 1, 1],
            [25, 1, User::ROLE_ADMIN, 'Giao dịch mới', 'fa fa-circle-o', 'transaction-history/index', 22, 1, 1],
            [26, 2, User::ROLE_ADMIN, 'Giao dịch đã xử lý', 'fa fa-circle-o', 'transaction-history/hander', 22, 1, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190521_094053_update_utilities_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190521_094053_update_utilities_data_table cannot be reverted.\n";

        return false;
    }
    */
}
