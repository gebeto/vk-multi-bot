<?php 

include 'tables/PrizesTable.php';
include 'tables/ConfigTable.php';

function get_all_prizes() {
	$table = PrizesTable::getInstance();
	$res = $table->getAll();
	if (true) {
		echo json_encode(array('response' => $res));
	} else {
	    echo '{"response": []}';
	}
}

function get_bot_state() {
	$table = ConfigTable::getInstance();
	$res = $table->getAll();
	if (true) {
		echo json_encode(array('response' => $res));
	} else {
	    echo '{"response": []}';
	}
}

switch ($REQ->method) {
	case 'all_prizes':
		get_all_prizes();
		break;

	case 'bot_state':
		get_bot_state();
		break;
}

?>
