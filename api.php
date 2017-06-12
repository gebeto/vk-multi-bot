<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$REQ = json_decode(file_get_contents('php://input'));
	
if (!isset($REQ->type, $REQ->method)) {
	// header("HTTP/1.0 404 Looks Like Shit");
	exit();
}

switch ($REQ->type) {
	
	// ADD case
	case 'add':
		include_once 'methods/add_.php';
		break;
	
	// GET case
	case 'get':
		include_once 'methods/get_.php';
		break;
		
	// DELETE case
	case 'delete':
		include_once 'methods/delete_.php';
		break;

	// AUTH case
	case 'auth':
		include_once 'methods/login_.php';
		break;

	// BOT case
	case 'bot':
		include_once 'methods/bot_.php';
		break;
	
	// DEFAULT case
	default:
		echo '{"error": "Unknown type"}';
		break;
}

?>