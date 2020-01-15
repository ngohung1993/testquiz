<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_exam`.
 */
class m190508_072321_create_user_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('user_exam', [
            'id' => $this->primaryKey(),
            'exam_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);
        $this->addForeignKey('fk_user_exam_exam', 'user_exam', 'exam_id', 'exam', 'id', 'CASCADE');
        $this->addForeignKey('fk_user_exam_user', 'user_exam', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_exam');
    }
}
