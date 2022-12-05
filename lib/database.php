<?php
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../config/config.php');
?>
<?php
class Database {
	public $host = db_host;
	public $user = db_user;
	public $pass = db_pass;
	public $dbname = db_name;

	public $link;
	public $error;

	public function __construct() {
		$this->connectDB();
	}

	private function connectDB() {
		$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

		if(!$this->link) {
			$this->error = "Connect fail" .$this->link->maxdb_connect_error;
			return false;
		}
	}

	// Select or Read data
	public function select($query) {
		$result = $this->link->query($query) or 
		die($this->link->error.__LINE__);
		if($result->num_rows > 0) {
			return $result;
		} else {
			return false;
		}
	}

	// Insert data
	public function insert($query) {
		$insert_row = $this->link->query($query) or
		die($this->link->error.__LINE__);
		if($insert_row){
			return $insert_row;
		} else {
			return false;
		}
	}

	// Update data
	public function update($query) {
		$update_row = $this->link->query($query) or 
		die($this->link->error.__LINE__);
		if($update_row){
			return $update_row;
		} else {
			return false;
		}
	}

	// Delete data 
	public function delete($query) {
		$delete_row = $this->link->query($query) or 
		die($this->link->error.__LINE__);
		if($delete_row){
			return $delete_row;
		} else {
			return false;
		}
	}
}


?>