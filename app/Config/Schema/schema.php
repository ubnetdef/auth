<?php
App::uses('ClassRegistry', 'Utility');
App::uses('Security', 'Utility');

class AppSchema extends CakeSchema {

	public $attachments = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key' => 'primary',
		),
		'inject_id' => array(
			'type' => 'integer',
			'null' => false,
		),
		'data' => array(
			'type' => 'binary',
			'null' => false,
		),
		'active' => array(
			'type' => 'boolean',
			'default' => true,
			'null' => false,
		),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		)
	);

	public $logs = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key' => 'primary',
		),
		'time' => array(
			'type' => 'integer',
			'length' => 10,
			'null' => false,
		),
		'type' => array(
			'type' => 'integer',
			'langth' => 10,
			'null' => false,
		),
		'user_id' => array(
			'type' => 'integer',
		),
		'related_id' => array(
			'type' => 'integer',
		),
		'extra_data' => array(
			'type' => 'text',
		),
		'ip' => array(
			'type' => 'string',
			'length' => 15,
		),
		'message' => array(
			'type' => 'text',
			'null' => false,
		),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'idx_type' => array('column' => 'type'),
		)
	);

	public $users = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key' => 'primary',
		),
		'username' => array(
			'type' => 'string',
			'null' => false,
		),
		'password' => array(
			'type' => 'string',
			'null' => false,
		),
		'active' => array(
			'type' => 'boolean',
			'default' => false,
			'null' => false,
		),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		)
	);

	// ================================

	public function before($event = array()) {
		ConnectionManager::getDataSource('default')->cacheSources = false;

		return true;
	}

	public function after($event = array()) {
		if ( !isset($event['create']) ) return;

		switch ( $event['create'] ) {
			case 'users':
				$this->_create('User', array(
					'username' => 'admin',
					'password' => 'admin',
					'active'   => 1,
				));
			break;

			case 'logs':
				$this->_create('Log', array(
					'time'       => time(),
					'type'       => 1,
					'user_id'    => 1,
					'related_id' => 0,
					'extra_data' => json_encode(array()),
					'ip'         => '127.0.0.1',
					'message'    => 'UpdateServer was just installed.',
				));
			break;
		}
	}

	private function _create($tbl, $data) {
		$table = ClassRegistry::init($tbl);

		$table->create();
		$table->save(array($tbl => $data));
	}

}
