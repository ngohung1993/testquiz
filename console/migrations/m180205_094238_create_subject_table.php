<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subjects}}`.
 */
class m180205_094238_create_subject_table extends Migration
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
        $this->createTable('{{%subject}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'description' => $this->text(),
            'serial' => $this->integer()->defaultValue(0),
            'status' => $this->integer()->defaultValue(0),
            'slug' => $this->string(),
            'icon' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subject}}');
    }
}
