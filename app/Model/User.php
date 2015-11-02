<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

	public function beforeSave($options = array()) {
		if ( !empty($this->data['User']['password']) ) {
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], 'blowfish');
		}
	}
}
