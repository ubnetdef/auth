<?php
App::uses('AppController', 'Controller');

class AdminController extends AppController {
	public $uses = array('Group');

	public function beforeFilter() {
		parent::beforeFilter();

		if ( $this->is_admin == false ) {
			throw new ForbiddenException('You do not have administrator access');
		}
	}

	public function index() {
		$this->set('users', $this->User->find('all', array(
			'fields' => array(
				'User.id', 'User.username', 'User.active'
			),
		)));
	}

	public function create() {
		if ( $this->request->is('post') ) {

		}

		$this->set('groups', $this->Group->find('all'));
	}

	public function edit($uid=false) {
		if ( $uid === false || !is_numeric($uid) || $uid < 0 ) throw new ForbiddenException('Unauthorized attempt');

		if ( $this->request->is('post') ) {

		}

		$user = $this->User->findById($uid);

		if ( empty($user) ) throw new NotFoundException('Unknown UID');

		$this->set('user', $user);
		$this->set('groups', $this->Group->find('all'));
	}

	public function toggleActive($uid=false) {
		if ( $uid === false || !is_numeric($uid) || $uid < 0 || $uid == $this->userinfo['id'] ) throw new ForbiddenException('Unauthorized attempt');

		$user = $this->User->findById($uid);

		if ( empty($user) ) throw new NotFoundException('Unknown UID');

		$this->User->id = $uid;
		$this->User->saveField('active', ($user['User']['active'] == 1 ? 0 : 1));

		$this->redirect('/admin');
	}

	public function groups() {
		$this->Group->bindModel(array(
			'hasAndBelongsToMany' => array(
				'User' => array(
					'joinTable' => 'groups_users',
				),
			),
		));

		$this->set('groups', $this->Group->find('all'));
	}
}
