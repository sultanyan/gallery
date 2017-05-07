<?php 
require_once 'new_config.php';
	class Database{
		public $connection; #FOR BEING AVAILABLE IN THE HOLE CLASS, NOT ONLY IN open_connection METHOD

		public function __construct(){
			$this->open_connection();
		}

		#ESTABLISHING CONNECTION
		public function open_connection(){
			$this->connection = new mysqli(HOST, USER, PASSWORD, NAME);
			if ($this->connection->connect_errno) {
				die("Connection to the database failed.") . mysqli_error();
			}
		}

		#QUERY METHOD 
		public function query($sql){
			$result = mysqli_query($this->connection, $sql);
			return $result;
		}

		#CONFIRM HELPER
		private function confirm_query($result){
			if (!$result) {
				die("Query failed") . mysqli_error();
			}
		}

		#ESCAPE HELPER
		public function escape($string){
			$escaped_string = mysqli_real_escape_string($this->connection, $string);
			return $escaped_string;
		}

		#LAST INSERTED
		public function the_insert_id(){
			return mysqli_insert_id($this->connection);
		}
	}	#DATABASE CLASS ENDED HERE
	$database = new Database();
?>