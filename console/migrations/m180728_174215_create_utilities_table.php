<?php

use yii\db\Migration;

/**
 * Handles the creation of table `utilities`.
 */
class m180728_174215_create_utilities_table extends Migration
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
        $this->createTable('{{%utilities}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'icon' => $this->string(),
            'path' => $this->string(),
            'serial' => $this->integer(),
            'parent_id' => $this->integer(),
            'permission' => $this->integer(),
            'released' => $this->integer(),
            'status' => $this->integer()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('utilities');
    }
}
