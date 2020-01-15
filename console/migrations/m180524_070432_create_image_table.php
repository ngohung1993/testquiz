<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m180524_070432_create_image_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%image}}', [
			'id'                => $this->primaryKey(),
			'title'             => $this->string(),
			'avatar'            => $this->string()->notNull(),
			'sub_photo'         => $this->string(),
			'serial'            => $this->integer()->defaultValue( 0 ),
			'link'              => $this->string(),
			'describe'          => $this->text(),
			'featured'          => $this->integer()->defaultValue( 0 ),
			'content'           => $this->text(),
			'post_id'           => $this->integer(),
			'category_id'       => $this->integer(),
			'setting_id'        => $this->integer(),
			'tab_id'            => $this->integer(),
			'status'            => $this->integer()->defaultValue( 0 ),
			'code'              => $this->text()
		], $tableOptions );

		$this->addForeignKey( 'fk_image_setting', 'image', 'setting_id', 'setting', 'id', 'CASCADE' );
		$this->addForeignKey( 'fk_image_post', 'image', 'post_id', 'post', 'id', 'CASCADE' );

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'image' );
	}
}
