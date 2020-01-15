<?php

use yii\db\Migration;

use common\models\User;

/**
 * Class m180313_100807_user_data
 */
class m180313_100807_user_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%user}}', [
            'username',
            'auth_key',
            'password_hash',
            'email',
            'name',
            'permission',
            'status',
            'created_at',
            'updated_at'
        ], [
            ['admin', 'h7oMctVJj5whPyxtj8L2M0_KHdH2d320', '$2y$13$sPXQ.pKp5j4qV.GboyThtuBLdvSSAS3qB0Ku.oNvHujwOHGCBcEO.','admin@gmail.com', 'Admin', User::ROLE_ADMIN, 10, 1513866397, 1513866397],
            ['member', 'h7oMctVJj5whPyxtj8L2M0_KHdH2d320', '$2y$13$sPXQ.pKp5j4qV.GboyThtuBLdvSSAS3qB0Ku.oNvHujwOHGCBcEO.','member@gmail.com', 'Member', User::ROLE_USER, 10, 1513866397, 1513866397],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180313_100807_user_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180313_100807_user_data cannot be reverted.\n";

        return false;
    }
    */
}
