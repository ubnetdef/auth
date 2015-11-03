<?php
App::uses('AppController', 'Controller');

class UserController extends AppController {
	public $uses = array('User');

	public function login() {
		// Require unauthenticated users
		if ( $this->logged_in ) {
			$this->redirect('/');
		}

		$username = null;

		if ( $this->request->is('post') ) {
			// Attempt Login
			$username = $this->request->data['username'];
			$password = $this->request->data['password'];

			$attempted_user = $this->User->findByUsername($username);

			if ( !empty($attempted_user) ) {
				$actual_password = $attempted_user['User']['password'];
				$attempted_password = Security::hash($password, 'blowfish', $actual_password);

				if ( $actual_password === $attempted_password ) {
					// Get the redirect information
					$redirect_to = ($this->Session->check('auth.from') ? $this->Session->read('auth.from') : '/');

					// Populate information
					$this->populateInfo($attempted_user['User']['id']);

					// Generate the tokens
					$tokens = array();
					foreach ( $attempted_user['Group'] AS $group ) {
						$tokens[] = $group['machine_name'];
					}
					$tokens = implode(' ', $tokens);

					// Generate AuthTicket token
					$this->AuthTicket->makeTicket($this->userinfo['username'], $tokens, '', env('REMOTE_ADDR'));

					// Log it
					$this->logMessage('AUTH', 'User just logged in');

					// Redirect
					$this->redirect($redirect_to);
				} else {
					// Log it
					$this->logMessage('AUTH', 'Attempted login for '.$attempted_user['User']['username'].' - incorrect password given');
				}
			} else {
				// Log it
				$this->logMessage('AUTH', 'Attempted login for "'.htmlentities($username).'" - no such user');
			}

			$this->Flash->danger('The username or password you entered is incorrect.');
		}

		$this->set('username', $username);
	}

	public function logout($token=false) {
		$this->requireAuthenticated('/');

		if ( $token === $this->userinfo['logout_token'] ) {
			// Destroy the session
			$this->Session->destroy();

			// Kill the AuthTicket
			$this->AuthTicket->destroy();

			// Log it
			$this->logMessage('AUTH', 'User just logged out');

			// Message it
			$this->Flash->success('Sucessfully logged out');

			// Redirect home
			$this->redirect('/');
		}

		// Otherwise display a nice message saying they failed in life
	}

	public function profile() {
		$this->requireAuthenticated();

		if ( $this->request->is('post') ) {
			// Update Password
			$old_password = $this->request->data['old_password'];
			$new_password = $this->request->data['new_password'];

			// Fetch the current password
			$user = $this->User->findById($this->userinfo['id']);
			$cur_password = $user['User']['password'];

			if ( Security::hash($old_password, 'blowfish', $cur_password) === $cur_password ) {
				// Update password
				$this->User->id = $this->userinfo['id'];
				$this->User->saveField('password', Security::hash($new_password, 'blowfish'));

				// Log it
				$this->logMessage('USER', 'User just updated his/her password');

				// Message it
				$this->Flash->success('Profile updated!');
			} else {
				$this->Flash->danger('You entered the wrong current password.');
			}
		}
	}
}
