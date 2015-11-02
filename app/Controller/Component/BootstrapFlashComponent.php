<?php
App::uses('FlashComponent', 'Controller/Component');

class BootstrapFlashComponent extends FlashComponent {
	private $_bootstrapFlashClasses = array('success', 'info', 'warning', 'danger');

	public function __call($name, $args) {
		if ( in_array($name, $this->_bootstrapFlashClasses) ) {
			// Duplicating most of the parent::__call functionality
			$options = array(
				'element' => 'bootstrap_default',
				'params' => array(
					'type' => $name,
				),
			);

			if ( count($args) < 1 ) {
				throw new InternalErrorException('Flash message missing.');
			}


			if (!empty($args[1])) {
				$options += (array)$args[1];
			}

			$this->set($args[0], $options);
		} else {
			return parent::__call($name, $args);
		}
	}
}