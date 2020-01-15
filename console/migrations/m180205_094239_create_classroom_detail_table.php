<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%classroom_subject}}`.
 */
class m180205_094239_create_classroom_detail_table extends Migration
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
        $this->createTable('{{%classroom_detail}}', [
            'id' => $this->primaryKey(),
            'classroom_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_classroom_detail_classroom', 'classroom_detail', 'classroom_id', 'classroom', 'id', 'CASCADE');
        $this->addForeignKey('fk_classroom_detail_subject', 'classroom_detail', 'subject_id', 'subject', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%classroom_detail}}');
    }
}
