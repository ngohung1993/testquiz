<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%exam_questions}}`.
 */
class m190426_155453_create_exam_question_table extends Migration
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
        $this->createTable('{{%exam_question}}', [
            'id' => $this->primaryKey(),
            'exam_id'=>$this->integer(),
            'question_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('fk_exam_question_exam', 'exam_question', 'exam_id', 'exam', 'id', 'CASCADE');
        $this->addForeignKey('fk_exam_question_question', 'exam_question', 'question_id', 'question', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%exam_question}}');
    }
}
