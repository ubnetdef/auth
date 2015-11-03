<?php
App::uses('AppShell', 'Console/Command');

class ServerShell extends AppShell {

	public function startup() {
		$this->stdout->styles('header', array('underline' => true));
	}

	public function install() {
		$this->out('Installing AuthServer');

		// Run the schema create tool
		$this->dispatchShell('schema', 'create', '--yes', '--quiet');

		// Done!
		$this->out('Installation completed!');
		$this->hr();
		$this->out('<header>Administrator Credentials</header>');
		$this->out('Username: admin');
		$this->out('Password: admin');
	}

	public function getOptionParser() {
		$parser = parent::getOptionParser();

		$parser->addArgument('install', array(
			'help' => 'Installs the AuthServer - Sets up the database'
		));

		return $parser;
	}
}
