<?php 

include '../tables/PrizesTable.php';

function delete_prize($mysqli, $data) {
	if (isset($data['id'])) {
			
	} else {
		echo '{"response": 0}';
	}
}

switch ($REQ->method) {
	case 'prize':
		delete_prize($mysqli, $REQ);
		break;
}

?>