<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// function send_inline_image($image) {
// 	$ch = curl_init();

// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// 	curl_setopt($ch, CURLOPT_URL, 'http://jailgeek.ru/vk-multi-bot/api.php');

// 	curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => $image));

// 	$result = curl_exec($ch);
// 	curl_close($ch);
// 	return $result;
// }



// echo file_get_contents('https://api.vk.com/method/photos.getOwnerCoverPhotoUploadServer?group_id=147503925&crop_x=0&crop_y=0&crop_x2=1590&crop_y2=400&access_token=dc102d4c63f9a4ff49c849ed1200a4cdf365e1c6489a2ced96a03d7cfb1c631d06e174085f48a90d8a04e&v=5.64');

function curl( $url ){
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	$response = curl_exec( $ch );
	curl_close( $ch );
	return $response;
}

// $UsersGet = curl('https://api.vk.com/method/users.get?user_id=1&fields=first_name&access_token=040d24b3ce997ad2c16ca7ad0e79fde089eb98babce55e9fae4ec8206aaf3d8bf558839fb6a29ccdb3fe1');
 

	// $host = $_SERVER['HTTP_HOST'];
	// $string = $_SERVER['REQUEST_URI'];
	// $pattern = '/\w+\.php/i';
	// $replacement = '';
	// $path = preg_replace($pattern, $replacement, $string);
	// $generator_url = "http://{$host}{$path}libs/ImageCreator.php";
	// $image = file_get_contents($generator_url);
	// send_inline_image($image);

?>