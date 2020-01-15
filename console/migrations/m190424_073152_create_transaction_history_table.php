<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction_history}}`.
 */
class m190424_073152_create_transaction_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%transaction_history}}', [
            'id' => $this->primaryKey(),
            'images' => $this->string(),
            'code' => $this->string(),
            'amount' => $this->integer(),
            'message' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'type' =>  $this->integer()->defaultValue(0),
            'note' =>  $this->string(),
            'user_id' => $this->integer()->notNull(),
            'account_id' => $this->integer()->notNull(),
            'time' => $this->date(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ], $tableOptions);
        $this->addForeignKey('fk_transaction_history_user', 'transaction_history', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_transaction_history_account_bank', 'transaction_history', 'account_id', 'account_bank','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction_history}}');
    }
}
