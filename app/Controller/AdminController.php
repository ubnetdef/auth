<?php
App::uses('AppController', 'Controller');

class AdminController extends AppController {

	public function index() {
		$this->set('users', $this->User->find('all', array(
			'fields' => array(
				'User.id', 'User.username', 'User.active'
			),
		)));
	}

	public function create() {

	}

	public function edit($uid=false) {

	}

	public function toggleActive($uid=false) {

	}

	public function groups() {

	}
}
