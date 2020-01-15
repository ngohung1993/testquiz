<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%classrooms}}`.
 */
class m180205_094237_create_classroom_table extends Migration
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
        $this->createTable('{{%classroom}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'avatar' => $this->string(),
            'description' => $this->text(),
            'serial' => $this->integer()->defaultValue(0),
            'parent_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(0),
            'seo_tool_id' => $this->integer(),
            'slug' => $this->string(),
            'icon' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_classroom_parent', 'classroom', 'parent_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk_classroom_seo_tool', 'classroom', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%classroom}}');
    }
}
