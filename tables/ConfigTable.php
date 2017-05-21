<?php

include 'AbstractTable.php';

class ConfigTable extends AbstractTable {

	private static $_instance = null;

	public function __construct() {
		$name = 'bot_config_table';
		$this->params_arr = array('`id` INT AUTO_INCREMENT NOT NULL', '`title` TEXT', '`type` TEXT', '`key` TEXT', '`value` TEXT', 'primary key (id)');
		parent::__construct($name);
		if (!$this->getWhere('key', 'enabled')) {
			$this->addItem(array(null, 'Enabled', 'checkbox', 'enabled', '1'));
		}
	}

	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
}

// $table = ConfigTable::getInstance();
// echo $table->addItem(array(null, 'Enable', 'checkbox', 'enabled', 'val'));
// echo $table->removeWhere('id', 6);
// echo json_encode( $table->getWhere('id', 1) );
// echo json_encode( $table->getFewWhere('id', array(7, 8, 9, 10)) );

?>