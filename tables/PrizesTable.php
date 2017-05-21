<?php

include 'AbstractTable.php';

class PrizesTable extends AbstractTable {

	private static $_instance = null;

	public function __construct() {
		$name = 'bot_prizes_table';
		$this->params_arr = array('`id` INT AUTO_INCREMENT NOT NULL', '`title` TEXT', '`message` TEXT', '`user_ids` JSON', 'primary key (id)');
		parent::__construct($name);
		if (!$this->getFirst()) {
			$this->addItem(array(null, 'Lazy Tools Key', 'My congrat! You win a Lazy KEY!!!', '[{"user_id": 1, "prize": "qwe5lf"}]'));
		}
	}

	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
}

// $table = PrizesTable::getInstance();
// echo $table->addItem(array(null, 'Lazy TOOOOL!', 'HELLLO MY FRIEND YOU WIN LAZYY!)', '[1,2,3,4,5,6]'));
// echo $table->removeWhere('id', 6);
// echo json_encode( $table->getWhere('id', 1) );
// echo json_encode( $table->getFewWhere('id', array(7, 8, 9, 10)) );

?>