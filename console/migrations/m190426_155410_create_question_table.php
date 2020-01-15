<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%questions}}`.
 */
class m190426_155410_create_question_table extends Migration
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
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'answer'  => $this->text(),
            'content' => $this->text(),
            'answer_correct'=> $this->string(),
            'status'=> $this->integer(),
            'explain' => $this->text(),
            'user_id' => $this->integer(),
            'topic_id'=> $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('fk_question_user', 'question', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_question_topic', 'question', 'topic_id', 'topic', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
