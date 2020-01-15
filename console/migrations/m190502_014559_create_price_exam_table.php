<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price_exam}}`.
 */
class m190502_014559_create_price_exam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price_exam}}', [
            'id' => $this->primaryKey(),
            'price' => $this->integer(),
            'price_discount' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price_exam}}');
    }
}
