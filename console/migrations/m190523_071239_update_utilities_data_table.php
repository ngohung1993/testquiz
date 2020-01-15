<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190523_071239_update_utilities_data_table
 */
class m190523_071239_update_utilities_data_table extends Migration
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
            [27, 3, User::ROLE_ADMIN, 'Nạp tiền cho thành viên', 'fa fa-circle-o', 'account-bank/index', 20, 1, 1],
            [28, 4, User::ROLE_ADMIN, 'Tài khoản ngân hàng', 'fa fa-circle-o', 'recharge/index', 20, 1, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190523_071239_update_utilities_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190523_071239_update_utilities_data_table cannot be reverted.\n";

        return false;
    }
    */
}
