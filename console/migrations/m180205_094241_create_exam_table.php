<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%exams}}`.
 */
class m180205_094241_create_exam_table extends Migration
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

        $this->createTable('{{%exam}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'price' => $this->double(),
            'price_discount' => $this->double(),
            'description' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'reason_reject' => $this->string(),
            'type' => $this->smallInteger()->defaultValue(0),
            'topic_id' => $this->integer()->notNull(),
            'seo_tool_id' => $this->integer(),
            'slug' => $this->string(),
            'tags' => $this->string(),
            'file_exam' => $this->string(),
            'file_answer' => $this->string(),
            'number_question' => $this->integer()->notNull()->defaultValue(0),
            'answer' => $this->text(),
            'views' => $this->integer()->defaultValue(0),
            'download' => $this->integer()->defaultValue(0),
            'classify' => $this->smallInteger()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'time' => $this->time(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_exam_topic', 'exam', 'topic_id', 'topic', 'id', 'CASCADE');
        $this->addForeignKey('fk_exam_seo_tool', 'exam', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
        $this->addForeignKey('fk_exam_user', 'exam', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%exam}}');
    }
}
