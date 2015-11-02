<?php
App::uses('AppHelper', 'View/Helper');

class InjectHelper extends AppHelper {
	private $injects = array();

	public function setup($injects) {
		$this->injects = $injects;
	}

	public function get($inject_id) {
		$this->_ensureInjects();

		foreach ( $this->injects AS $inject ) {
			if ( $inject['Inject']['id'] == $inject_id ) return $inject;
		}

		throw new InternalErrorException('Unknown Inject ID');
	}

	public function started($inject_or_id) {
		$inject = (is_array($inject_or_id) ? $inject_or_id : $this->get($inject_or_id));

		return $inject['Inject']['time_start'] == 0 || $inject['Inject']['time_start'] <= time();
	}

	public function expired($inject_or_id) {
		$inject = (is_array($inject_or_id) ? $inject_or_id : $this->get($inject_or_id));

		return $inject['Inject']['time_end'] > 0 && $inject['Inject']['time_end'] <= time();
	}

	public function completed($inject_or_id) {
		$inject = (is_array($inject_or_id) ? $inject_or_id : $this->get($inject_or_id));

		return isset($inject['CompletedInject']) ? $inject['CompletedInject']['id'] !== null : false;
	}

	public function checkRequested($inject_or_id) {
		$inject = (is_array($inject_or_id) ? $inject_or_id : $this->get($inject_or_id));

		return isset($inject['RequestedCheck']) ? $inject['RequestedCheck']['id'] !== null : false;
	}

	public function completedOrExpired($inject_or_id) {
		return $this->completed($inject_or_id) || $this->expired($inject_or_id);
	}

	public function canShow($inject_or_id) {
		$inject = (is_array($inject_or_id) ? $inject_or_id : $this->get($inject_or_id));

		// Has it started?
		if ( !$this->started($inject) ) {
			debug($inject);
			return false;
		}

		// Does the inject have a dependency, and is it completed?
		if ( $inject['Inject']['dependency'] != 0 && !$this->completed($inject['Inject']['dependency'])) {
			return false;
		}

		// Finally, we can show it
		return true;
	}

	public function getPanelClass($inject_or_id) {
		$inject = (is_array($inject_or_id) ? $inject_or_id : $this->get($inject_or_id));

		switch ( true ) {
			case $this->completed($inject):
				return 'panel-success';
			break;

			case $this->expired($inject):
				return 'panel-warning';
			break;

			default:
				return 'panel-primary';
			break;
		}
	}

	public function getElementNameFromType($type_id) {
		switch ( $type_id ) {
			case 1:
				return 'flag';
			break;

			case 2;
				return 'response';
			break;

			case 3:
				return 'manual';
			break;

			default:
				return 'none';
			break;
		}
	}

	private function _ensureInjects() {
		if ( empty($this->injects) ) {
			throw new InternalErrorException('InjectHelper requires the setup method to be called first!');
		}
	}
}
