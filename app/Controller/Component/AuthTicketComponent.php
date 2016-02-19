<?php
App::uses('Component', 'Controller');

class AuthTicketComponent extends Component {	
	private $_key = '';
	private $_defaultExpiration = (60*60*12);
	private $_domain = '';

	private $_cookieName = 'auth_tkt';

	public function initialize(Controller $controller) {
		// Verify AuthTicket Config exists & we have a secret
		Configure::load('auth_ticket');

		if ( Configure::read('auth_ticket.secret') == null ) {
			// FAILZOR
			throw new InternalErrorException('AuthTicketComponent was unable to setup sucessfully. Missing secret.');
		}
		
		$this->_key = Configure::consume('auth_ticket.secret');
		
		$this->_defaultExpiration = (Configure::read('auth_ticket.default_expiration') != null ? 
			Configure::read('auth_ticket.default_expiration') : $this->_defaultExpiration);
		
		$this->_cookieName = (Configure::read('auth_ticket.cookie_name') != null ? 
					Configure::read('auth_ticket.cookie_name') : $this->_cookieName);

		$this->_domain = (Configure::read('auth_ticket.domain') != null ? 
					Configure::read('auth_ticket.domain') : $this->_cookieName);
	}
	
	public function getUsername() {
		return env('REMOTE_USER', 'guest');
	}
	
	public function isLoggedIn() {
		return $this->getUsername() !== 'guest';
	}
	
	public function makeTicket($user, $tokens='', $data='', $ip='0.0.0.0', $ts=false) {
		if ( $ts === false ) $ts = time() + $this->_defaultExpiration;
	
		$ipts = pack('NN', ip2long($ip), $ts);
	
		// Make digest0 and digest
		$digest0 = hash('md5', $ipts . $this->_key . $user . chr(0) . $tokens . chr(0) . $data);
		$digest  = hash('md5', $digest0 . $this->_key);
	
		// Generate the ticket
		if ( !empty($tokens) ) {
			$tkt = sprintf('%s%08x%s!%s!%s', $digest, $ts, $user, $tokens, $data);
		} else {
			$tkt = sprintf('%s%08x%s!%s', $digest, $ts, $user, $data);
		}
		
		$this->setCookie(base64_encode($tkt), time() + $this->_defaultExpiration);
	}
	
	public function destroy() {
		$this->setCookie('', time() - $this->_defaultExpiration);
	}
	
	private function setCookie($value, $expiration) {
		setrawcookie($this->_cookieName, $value, $expiration, '/', $this->_domain);
	}
}