<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%topic}}`.
 */
class m180205_094240_create_topic_table extends Migration
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
        $this->createTable('{{%topic}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'avatar' => $this->string(),
            'description' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'active' => $this->smallInteger()->defaultValue(0),
            'classroom_detail_id' => $this->integer()->notNull(),
            'hot' => $this->integer()->defaultValue(0),
            'seo_tool_id' => $this->integer(),
            'slug' => $this->string(),
            'tags' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_topic_classroom_detail', 'topic', 'classroom_detail_id', 'classroom_detail', 'id', 'CASCADE');
        $this->addForeignKey('fk_topic_seo_tool', 'topic', 'seo_tool_id', 'seo_tool', 'id', 'CASCADE');
        $this->addForeignKey('fk_topic_user', 'topic', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%topic}}');
    }
}
