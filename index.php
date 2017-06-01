<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$VK_CALLBACK = json_decode(file_get_contents('php://input'));
if (!$VK_CALLBACK) {
	exit();
}

$CONFIRMATION_TOKEN = '6fef10a5';
$ACCESS_TOKEN = 'dc102d4c63f9a4ff49c849ed1200a4cdf365e1c6489a2ced96a03d7cfb1c631d06e174085f48a90d8a04e';


// Create earray of plugins
$plugins = array();

// Get all plugins by callback type
$plugins_include = glob("plugins/{$VK_CALLBACK->type}.*.php");

// Include plugins by type
foreach ($plugins_include as $plugin) {
	include $plugin;
}

// Running included plugins
foreach ($plugins as $plugin) {
	$plugin->start();
}

echo 'ok';

?>