<?php

function runMessageBot($data, $access_token) {
	$config = ConfigTable::getInstance();
    $key_word = $config->getWhere('key', 'key_word')[0]['value'];

    switch ($data->object->body) {
    	case $key_word:
	    	include 'VKBotTestMessage.php';
    		$bot = new VKBotTestMessage($access_token, $data->object);
			$bot->run();
    		break;
    	
    	default:
    		# code...
    		break;
    }
}

?>