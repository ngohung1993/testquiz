<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m190530_082904_update_utilities_data_table
 */
class m190530_082904_update_utilities_data_table extends Migration
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
            [11, User::ROLE_ADMIN, 'Thông báo', 'fa fa-bell-o', 'message/index', null, 1, 1],

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
