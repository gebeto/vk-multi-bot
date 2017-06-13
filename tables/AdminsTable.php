<?php

include 'AbstractTable.php';

class AdminsTable extends AbstractTable {

	public function __construct() {
		$name = 'bot_admins_table';
		$this->params_arr = array('`id` INT AUTO_INCREMENT NOT NULL', '`name` TEXT', '`login` TEXT', '`password` TEXT', '`access_token` TEXT', 'primary key (id)');
		parent::__construct($name);
		if (!$this->getFirst()) {
			$this->addItem(array(null, 'admin', 'admin', 'admin', 'admin:admin'));
		}
	}

}

$table = new AdminsTable();
print_r( $table->getWhere('login', 'admin') );
// echo $table->addItem(array(null, 'Slavik Gebeto', 'gebeto', 'gebeto', 'gebeto:gebeto'));
// echo $table->removeWhere('id', 6);
// echo json_encode( $table->getWhere('id', 1) );
// echo json_encode( $table->getFewWhere('id', array(7, 8, 9, 10)) );

?>