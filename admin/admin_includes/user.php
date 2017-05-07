<?php 
	class User extends Db_object {
		#PROPERTIES FOR USER
		protected static $db_table = "users";
		protected static $db_table_fields = array('username', 'password', 'user_image', 'first_name', 'last_name');
		public    $id,
				  $username,
				  $user_image,
				  $first_name,
				  $last_name,
				  $password,
				  $upload_directory = "images",
				  $image_placeholder = "images/placeholder.png";

		#PLACEHOLD IT
		public function image_path_and_placeholder(){
			return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory .DS. $this->user_image;
		}

		#METHOD TO CHECK DATABASE FOR USER
		public static function verify_user($username, $password){
			global $database;
			$username = $database->escape($username);
			$password = $database->escape($password);
			$sql = "SELECT * FROM ".self::$db_table." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
			$result_array = self::find_by_query($sql);
			return !empty($result_array) ? array_shift($result_array) : false;
		}

		#PASSING $_FILES['uploadable_file'] AS AN ARGUMENT. HERE IS A SMILEY FACE FOR U :) 
		public function  set_file($file){
			if (empty($file) || !$file || !is_array($file)) {
				$this->errors[] = "An error occured while uploading the file. Contact the sysadmin.";
				return false;
			}elseif ($file['error'] != 0) {
				$this->errors[] = $this->upload_errors_array[$file['error']]; 
				return false;
			}else {
				$this->user_image = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = ceil($file['size']);				
				$this->date_uploaded = date('Y-m-d:h-m-s');
			}
		}

		#METHOD FOR SAVING PICS IN DATABASE
		public function upload_image(){
				if (!empty($this->errors)) {
					echo 'smth went wrong'; #delete this line
					return false;
				}

				if (empty($this->user_image) || empty($this->tmp_path)) {
					$this->errors[] = "File is not available";
					return false;
				}

				$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

				if (file_exists($target_path)) {
					$this->errors[] = "The file {$this->user_image} already exists";
					return false;
				}

				if (move_uploaded_file($this->tmp_path, $target_path)) {
						unset($this->tmp_path);
						return true;
				}else {
					$this->errors[] = "Some real shit happend. Something wrong with directories. You, me and others are fucked.";
				}
		} #SAVE METHOD ENDED

		public function ajax_save_user_image($user_image, $user_id){
			global $database;
			$user_image = $database->escape($_POST['image_name']);
			$user_id = $database->escape($_POST['user_id']);
			$this->user_id = $user_id;
			$this->user_image = $user_image;
			$sql = "UPDATE " . self::$db_table. " SET user_image = '{$this->user_image}' ";
			$sql .= "WHERE id = '{$this->id}' ";
			$update_image = $database->query($sql);
			echo $this->image_path_and_placeholder();
		}
	} #CLASS USER ENDED.
?>