<?php

use yii\db\Migration;
use common\models\Room;

/**
 * Handles the creation of table `{{%report_question}}`.
 */
class m190426_155411_create_report_question_table extends Migration
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
        $this->createTable('{{%report_question}}', [
            'id' => $this->primaryKey(),
            'content_report' => $this->text(),
            'question_id' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_report_question_user', 'report_question', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_report_question_question', 'report_question', 'question_id', 'question', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%report_question}}');
    }
}
