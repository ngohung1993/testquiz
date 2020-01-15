<?php

use yii\db\Migration;

/**
 * Handles the creation of table `audit_log`.
 */
class m180725_182812_create_audit_log_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {

		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' ) {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable( '{{%audit_log}}', [
			'id'      => $this->primaryKey(),
			'user_id' => $this->integer(),
			'browser' => $this->string(),
			'ip'      => $this->string(),
			'time'    => $this->dateTime(),
			'total'   => $this->integer()
		], $tableOptions );

		$this->addForeignKey( 'fk_audit_log_user', 'audit_log', 'user_id', 'user', 'id', 'CASCADE' );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( 'audit_log' );
	}
}
