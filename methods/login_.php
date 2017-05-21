<?php 


function login($mysqli, $data) {
	$admins_table = ADMINS_TABLE;
	$login = $data->login;
	$password = $data->password;

	$result = $mysqli->query("SELECT access_token, name 
							  FROM {$admins_table}
							  WHERE login='{$login}' AND password='{$password}'
							  LIMIT 1");

	if ($result && $result->num_rows == 1) {
		$js = $result->fetch_all(1)[0];
	    // Вывод всех значений в виде JSON
	    echo json_encode(array("response" => $js));
	} else {
	    echo '{"error": "Login or Password invalid"}';
	}
}

function check_token($mysqli, $data) {
	$admins_table = ADMINS_TABLE;
	if (isset($data->access_token)) {
		$token = $data->access_token;

		$result = $mysqli->query("SELECT login 
								  FROM {$admins_table}
								  WHERE access_token='{$token}'
								  LIMIT 1");

		if ($result && $result->num_rows == 1) {
			return true;
		} else {
		    return false;
		}
	} else {
		return false;
	}
}

switch ($REQ->method) {
	case 'login':
		login($mysqli, $REQ);
		break;
}

?>
