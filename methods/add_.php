<?php 

function add_prize($mysqli, $data) {
	$prizes_table = PRIZES_TABLE;
	if (isset($data['title'], $data['message'], $data['user_ids'])) {
		$title = $data['title'];
		$message = $data['message'];
		$user_ids = $data['user_ids'];
		$sql = "INSERT INTO `{$prizes_table}` (`id`, `title`, `message`, `user_ids`) VALUES ('', '{$title}', '{$message}', '{$user_ids}');";
		if ($result = $mysqli->query($sql) == 1) {
			// print_r('Success');
			echo '{"response": 1}';
		}
	}
}

switch ($REQ->method) {
	case 'prize':
		add_prize($mysqli, $REQ);
		break;
}

?>