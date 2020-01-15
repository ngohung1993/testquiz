<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account_branks}}`.
 */
class m190424_043030_create_account_bank_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%account_bank}}', [
            'id' => $this->primaryKey(),
            'account_name'=>$this->string()->notNull(),
            'name_bank' =>$this->string()->notNull(),
            'account_number' => $this->string()->notNull(),
            'bank_branch'   => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_account_bank_user', 'account_bank', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%account_bank}}');
    }
}
