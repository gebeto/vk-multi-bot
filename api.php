<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

function getREQ()
{
	$REQF = json_decode(file_get_contents('php://input'));
	if (isset($REQF->type, $REQF->method)) {
		return $REQF;
	} else if (isset($_GET['type'], $_GET['method'])) {
		return (object)$_GET;
	} else if (isset($_POST['type'], $_POST['method'])) {
		return (object)$_POST;
	} else {
		header("HTTP/1.0 404 Looks Like Shit");
		exit();
	}
}

$REQ = getREQ();

include_once "methods/{$REQ->type}_.php";

?>