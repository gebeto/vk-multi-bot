<?php 

function set_enabled($mysqli, $data) {
	$status_table = STATUS_TABLE;
	if (isset($data->enabled)) {
		$enabled = $data->enabled;
		$sql = "UPDATE `{$status_table}` SET `value` = \"{$enabled}\" WHERE `{$status_table}`.`key` = 'enabled'";
		if ($result = $mysqli->query($sql) == 1) {
			if ($enabled == '0') {
				echo '{"response": "Bot Disabled"}';
			} else {
				echo '{"response": "Bot Enabled"}';
			}
		}
	}
}

function set_key_word($mysqli, $data) {
	$status_table = STATUS_TABLE;
	if (isset($data->value)) {
		$value = $data->value;
		$sql = "UPDATE `{$status_table}` SET `value` = \"{$value}\" WHERE `{$status_table}`.`key` = 'key_word'";
		if ($result = $mysqli->query($sql) == 1) {
			echo '{"response": "Keyword changed to \'' . $value . '\'"}';
		}
	}
}

switch ($REQ->method) {
	case 'enabled':
		set_enabled($mysqli, $REQ);
		break;
	case 'key_word':
		set_key_word($mysqli, $REQ);
		break;
}

?>