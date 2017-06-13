<?php
	header("Content-Type: image/png");
	$im = @imagecreate(795, 200) or die("Невозможно создать поток изображения");
	$background_color = imagecolorallocate($im, 0, 0, 0);
	$text_color = imagecolorallocate($im, 233, 14, 91);
	$text = 'Hello world';
	if (isset($_GET['text'])) {
		$text = $_GET['text'];
	}
	if (isset($_GET['user_id'])) {
		$resp = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$_GET['user_id']}&lang=en"));
		$text = "{$resp->response[0]->first_name} {$resp->response[0]->last_name}";
	}
	imagestring($im, 1, 5, 5, $text, $text_color);
	$image = NULL;
	imagepng($im);
	imagedestroy($im);
?>