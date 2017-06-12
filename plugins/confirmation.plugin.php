<?php

/**
* Confirmation
*/
class Confirmation {
	
	public $data;
	public $conf_token;

	public function __construct($data, $conf_token, $access_token) {
		$this->data = $data;
		$this->conf_token = $conf_token;
	}

	public function start() {
		echo $this->conf_token;
		exit();
	}
}

PluginManager::registerPlugin(new Confirmation($VK_CALLBACK, $CONFIRMATION_TOKEN, $ACCESS_TOKEN));

?>