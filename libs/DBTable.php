<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);


abstract class DBTable {
	public $name;
	public $params;
	public $params_arr;
	public $fields;
	public $mysqli;

	public function __construct($name) {
		$this->mysqli = new mysqli("c97006xu.beget.tech", "c97006xu_1", "c97006xu_1", "c97006xu_1");
		if ($this->mysqli->connect_errno) {
			echo '{"error": "' . $this->mysqli->connect_error . '"}';
			exit();
		}
		$this->name = $name;
		$this->params = join(', ', $this->params_arr);
		preg_match_all('/\`(\w+)\`/', $this->params, $this->fields);
		$this->fields = join(', ', $this->fields[0]);

		if (!$this->isCorrect()) {
			$this->deleteTable();
			$this->createTable();
			echo "TABLE CREATED!";
			exit();
		}
	}

	public function deleteTable() {
		$res = $this->mysqli->query("DROP TABLE IF EXISTS `{$this->name}`;");
		return $this->mysqli->error;
	}

	public function createTable() {
		$res = $this->mysqli->query("CREATE TABLE IF NOT EXISTS `{$this->name}`({$this->params})");
		return $this->mysqli->error;
	}

	public function isCorrect() {
		$res = $this->mysqli->query("SELECT {$this->fields} FROM {$this->name} LIMIT 1");
		return ($this->mysqli->error ? false : true);
	}

	public function addItem($values) {
		$vals = '';
		foreach ($values as $key => $value) {
			if ($value == null) {
				$vals = $vals . 'NULL';
			} else if (is_numeric($value)){
				$vals = $vals . "'{$value}'";
			} else if (is_string($value)) {
				$vals = $vals . "'{$value}'";
			}
			if ($key < count($values)-1) {
				$vals = $vals . ', ';
			}
		}
		$q = "INSERT INTO `{$this->name}` ({$this->fields}) VALUES ({$vals})";
		$res = $this->mysqli->query($q);
		return ($res ? 'Added' : 'Something went wrong!');		
	}

	public function removeWhere($field, $val) {
		$q = "DELETE FROM `{$this->name}` WHERE `{$this->name}`.`{$field}` = '{$val}'";
		$res = $this->mysqli->query($q);
		return ($res ? 'Removed' : 'Something went wrong!');				
	}

	public function getFirst() {
		$q = "SELECT * FROM `{$this->name}` LIMIT 1";
		$res = $this->mysqli->query($q);
		return $res->fetch_all(1);			
	}

	public function getAll() {
		$q = "SELECT * FROM `{$this->name}`";
		$res = $this->mysqli->query($q);
		return $res->fetch_all(1);			
	}

	public function getWhere($field, $val) {
		$q = "SELECT * FROM `{$this->name}` WHERE `{$this->name}`.`{$field}` = '{$val}'";
		$res = $this->mysqli->query($q);
		return $res->fetch_all(1);				
	}

	public function getFewWhere($field, $vals) {
		$val = join(', ', $vals);
		$q = "SELECT * FROM `{$this->name}` WHERE `{$this->name}`.`{$field}` IN ({$val})";
		$res = $this->mysqli->query($q);
		return $res->fetch_all(1);				
	}
	
}

?>
