<?php

use yii\db\Migration;

/**
 * Handles the creation of table `widgets`.
 */
class m180726_042928_create_widgets_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->createTable( '{{%widgets}}', [
			'id'               => $this->primaryKey(),
			'position'         => $this->integer(),
			'background_color' => $this->string(),
			'title_color'      => $this->string(),
			'text_color'       => $this->string(),
			'button_color'     => $this->string(),
			'button_text'      => $this->string(),
			'title'            => $this->string(),
			'description'      => $this->string(),
			'email'            => $this->string()
		] );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'widgets' );
	}
}
