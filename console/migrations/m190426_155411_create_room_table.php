<?php

use yii\db\Migration;
use common\models\Room;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m190426_155411_create_room_table extends Migration
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
        $this->createTable('{{%room}}', [
            'id' => $this->primaryKey(),
            'completion_time' => $this->time(),
            'questions' => $this->text(),
            'answers' => $this->text(),
            'scores' => $this->integer(),
            'exam_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(Room::STATUS_OPENING),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('fk_room_exam', 'room', 'exam_id', 'exam', 'id', 'CASCADE');
        $this->addForeignKey('fk_room_user', 'room', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%room}}');
    }
}
