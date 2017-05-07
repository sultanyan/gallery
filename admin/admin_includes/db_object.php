<?php 
	class Db_object{
		protected static $db_table = "users";
		public $errors = array();
		public $upload_errors_array = array(
				  	UPLOAD_ERR_OK => "There is no errors",
				  	UPLOAD_ERR_INI_SIZE => "Filesize is bigger than upload_max_filesize directive",
				  	UPLOAD_ERR_FORM_SIZE => "The uploaded file size exceeds MAX_FILE_SIZE",
				  	UPLOAD_ERR_PARTIAL => "The file was uploaded partially",
				  	UPLOAD_ERR_NO_FILE => "No file was uploaded. Shit happens, don't worry.",
				  	UPLOAD_ERR_NO_TMP_DIR => "No temp folder",
				  	UPLOAD_ERR_CANT_WRITE => "Failed to write on the disk",
				  	UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
				  );
		
		#FIND ALL METHOD
		public static function find_all(){
			return static::find_by_query("SELECT * FROM ".static::$db_table." ");
		}

		#FIND BY ID METHOD 
		public static function find_by_id($id){
			global $database;
			$results_array = static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id= '".$id."' LIMIT 1");
			return !empty($results_array) ? array_shift($results_array) : false;
		}

		#FIND THIS QUERY METHOD
		public static function find_by_query($sql){
			global $database;
			$result_set = $database->query($sql);
			$array = array();
			while ($row = mysqli_fetch_array($result_set)) {
			    $array[] = static::records($row);
			}
			return $array;
		}

		#AUTOMATATION FOR ASSIGNING AND STUFF
		public static function records($record){
			$call = get_called_class();
			$obj = new $call;
			foreach ($record as $attr => $value) {
				if ($obj->hasAttr($attr)) {
					$obj->$attr=$value;
				}
			}
			return $obj;
		}

		#HAS ATTRIBUTE OR NOT
		private function hasAttr($attr){
			$properties = get_object_vars($this);
			return array_key_exists($attr, $properties);
		}

		#GET ALL OBJECT PROPERTIES BACK
		protected function properties(){
			#return get_object_vars($this);
			$properties = array();
			foreach (static::$db_table_fields as $db_field) {
				if (property_exists($this, $db_field)) {
					$properties[$db_field] = $this->$db_field;
				}
			}
			return $properties;
		}

		#CLEAN PROPERTIES
		protected function clean_properties(){
			global $database;
			$clean_properties = array();
			foreach ($this->properties() as $key => $value) {
				$clean_properties[$key] = $database->escape($value);
			}
			return $clean_properties;
		}

		#THIS METHOD CHECKS TO SEE IF USER IS CREATED. IF IT IS-UPDATE, IF NOT-CREATE.
		public function save(){
			return isset($this->id) ? $this->update() : $this->create();
		}

		#CREATE USER
		public function create(){
			global $database;
			$properties = $this->clean_properties();
			$sql = "INSERT INTO " . static::$db_table . "(".implode(",", array_keys($properties)) . ")";
			$sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";
			if ($database->query($sql)) {
				$this->id = $database->the_insert_id();
				return true;
			}else {
				return false;
			}
		}

		#UPDATE USER
		public function update(){
			global $database;
			$properties = $this->clean_properties();
			$properties_pairs = array();
			foreach ($properties as $key => $value) {
				$properties_pairs[] = "{$key}='{$value}'";
			}
			$sql = "UPDATE " . static::$db_table . " SET ";
			$sql .= implode(", ", $properties_pairs);
			$sql .= " WHERE id= " . $database->escape($this->id); 
			$database->query($sql);
			return (mysqli_affected_rows($database->connection)==1) ? true : false;
		}

		#DELETE USER
		public function delete(){
			global $database;
			$sql = "DELETE FROM ".static::$db_table." WHERE id = '{$this->id}' LIMIT 1";
			$database->query($sql);
			return (mysqli_affected_rows($database->connection)==1) ? true : false;
		}

		#COUNT SHITTY PHOTOS AND EVERYTHIG
		public static function count_all(){
			global $database;
			$sql = "SELECT COUNT(*) FROM " . static::$db_table;
			$result_set = $database->query($sql);
			$row = mysqli_fetch_array($result_set);
			return array_shift($row);
		}
	}#PHOTO CLASS ENDED
?>