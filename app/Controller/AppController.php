<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $uses = array('User', 'Log');
	public $components = array(
		'DebugKit.Toolbar',
		'Flash' => array(
			'className' => 'BootstrapFlash',
		),
		'Session',
		'AuthTicket',
	);

	// User Information
	protected $userinfo  = array();
	protected $groupinfo = array();

	// Logged in
	protected $logged_in = false;

	public function beforeFilter() {
		parent::beforeFilter();

		// Load DebugKit (if available)
		if ( CakePlugin::loaded('DebugKit') ) {
			$this->Components->load('DebugKit.Toolbar');
		}

		// Do we have a session, and are we still logged in?
		if ( $this->Session->check('User') && !$this->AuthTicket->isLoggedIn() ) {
			$this->Session->destroy();
		} else if ( !$this->Session->check('User') && $this->AuthTicket->isLoggedIn() ) {
			// Process a new login
			$userinfo = $this->User->findByUsername($this->AuthTicket->getUsername());
			
			$this->populateInfo($userinfo);
		} else if ( $this->Session->check('User') ) {
			$this->userinfo = $this->Session->read('User');
			$this->groupinfo = $this->Session->read('Group');
		}

		// Set important instance variables
		$this->logged_in        = !empty($this->userinfo);

		// Git version (because it looks cool)
		exec('git describe --tags --always', $mini_hash);
		exec('git log -1', $line);

		$this->set('version', trim($mini_hash[0]));
		$this->set('version_long', str_replace('commit ','', $line[0]));

		// Set template information
		$this->set('userinfo', $this->userinfo);
		$this->set('groupinfo', $this->groupinfo);
	}

	public function afterFilter() {
		parent::afterFilter();

		// Output compression on all requests
		$parser = \WyriHaximus\HtmlCompress\Factory::construct();
		$compressedHtml = $parser->compress($this->response->body());

		$this->response->compress();
		$this->response->body($compressedHtml);
	}

	protected function requireAuthenticated($redirect_to='/user/login') {
		$this->Session->write('auth.from', $this->request->here);

		if ( !$this->logged_in ) {
			$this->redirect($redirect_to);
		}
	}

	protected function populateInfo($userid) {
		// Fetch user info
		if ( is_array($userid) ) {
			$userinfo = $userid;
		} else {
			$userinfo = $this->User->findById($userid);
		}

		if ( empty($userinfo) ) {
			throw new InternalErrorException('Unknown UserID.');
		}

		// Destroy the current session (if any)
		$this->Session->destroy();

		// Verify the account is enabled/not expired
		if ( $userinfo['User']['active'] != 1 ) {
			$this->redirect('/?account_disabled');
		}

		// Generate logout token
		$userinfo['User']['logout_token'] = Security::hash(CakeText::uuid());

		// Clean the password (remove it from the array)
		unset($userinfo['User']['password']);

		// Set the new information
		$this->Session->write($userinfo);

		// Update our arrays
		$this->userinfo  = $userinfo['User'];
		$this->groupinfo = $userinfo['Group'];
	}

	// Helper function for funky cases
	protected function barf($ajax=false, $message='Stop trying to hack the AuthEngine!') {
		$this->logMessage('BARF', 'Barf triggered by user on '.$this->request->params['controller'].'@'.$this->request->params['action']);

		if ( $ajax ) {
			return $this->ajaxResponse($message, 400);
		}

		throw new BadRequestException($message);
	}

	protected function ajaxResponse($data, $status=200) {
		$this->layout = 'ajax';

		return new CakeResponse(array(
			'body' => (is_array($data) ? json_encode($data) : $data),
			'status' => $status
		));
	}

	protected function logMessage($type, $message, $ip=-1, $user_id=-1) {
		if ( $ip === -1 ) $ip = env('REMOTE_ADDR', 'UNKNOWN');
		if ( $user_id === -1 && !empty($this->userinfo) ) $user_id = $this->userinfo['id'];

		$this->Log->create();
		$this->Log->save(array(
			'type' => strtoupper($type),
			'message' => $message,
			'ip_address' => $ip,
			'user_id' => $user_id,
			'time' => time(),
		));
	}
}
