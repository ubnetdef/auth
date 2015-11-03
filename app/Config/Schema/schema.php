<?php
App::uses('ClassRegistry', 'Utility');
App::uses('Security', 'Utility');

class AppSchema extends CakeSchema {

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

	public $groups = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key' => 'primary',
		),
		'machine_name' => array(
			'type' => 'string',
			'null' => false,
		),
		'human_name' => array(
			'type' => 'string',
			'null' => false,
		),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		)
	);
	
	public $groups_users = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'key' => 'primary',
		),
		'user_id' => array(
			'type' => 'integer',
			'null' => false,
		),
		'group_id' => array(
			'type' => 'integer',
			'null' => false,
		),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
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
			case 'groups':
				$this->_create('Group', array(
					'machine_name' => 'admin',
					'human_name' => 'Administrators',
				));
			break;
			
			case 'groups_users':
				// Doing something special here
				$tbl = ClassRegistry::init('Group');
				$tbl->query('INSERT INTO groups_users (group_id, user_id) VALUES(1,1)');
			break;
			
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
					'message'    => 'AuthServer was just installed.',
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
