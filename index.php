<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'libs/TelegramBot.php';
include_once 'libs/DBTable.php';

$CONFIRMATION_TOKEN = '6fef10a5';
$ACCESS_TOKEN = 'dc102d4c63f9a4ff49c849ed1200a4cdf365e1c6489a2ced96a03d7cfb1c631d06e174085f48a90d8a04e';
$VK_CALLBACK = json_decode(file_get_contents('php://input'));

/**
* Plugin Manager
*/
class PluginManager {

	private static $plugins = array();

	public static function registerPlugin($plugin) {
		array_push(self::$plugins, $plugin);
	}

	public static function runPlugins($VK_CALLBACK, $CONFIRMATION_TOKEN, $ACCESS_TOKEN) {
		if (!$VK_CALLBACK) {
			exit();
		}

		// Get all plugins by callback type
		$plugins_include = glob("plugins/{$VK_CALLBACK->type}.*.php");

		// Include plugins by type
		foreach ($plugins_include as $plugin) {
			include_once $plugin;
		}

		// Running included plugins
		foreach (self::$plugins as $plugin) {
			$plugin->start();
		}
	}

}

if ($VK_CALLBACK) {
	PluginManager::runPlugins($VK_CALLBACK, $CONFIRMATION_TOKEN, $ACCESS_TOKEN);

	echo 'ok';
} else {
	$plugins = glob("plugins/*.php");
	foreach ($plugins as $key => $value) {
		$key += 1;
		echo "<p>{$key}: {$value}</p>";
	}
}

$host = $_SERVER['HTTP_HOST'];
$path = $_SERVER['REQUEST_URI'];
$generator_url = "http://{$host}{$path}libs/ImageCreator.php?text=Slavik%20Nychkalo";
echo '<img src="data:image/png;base64,';
echo base64_encode(file_get_contents($generator_url));
echo '" alt="">';

?>