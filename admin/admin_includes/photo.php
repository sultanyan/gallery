<?php 
	class Photo extends Db_object{

		#PROPERTIES FOR PICS
		protected static $db_table = "photos";
		protected static $db_table_fields = array('title', 'caption', 'description', 'filename', 'alternative_text', 'type', 'size', 'date_uploaded');
		public    $id,
				  $title,
				  $caption,
				  $description,
				  $filename,
				  $alternative_text,
				  $type,
				  $size,
				  $date_uploaded,
				  $tmp_path,
				  $upload_directory="images";

		#PASSING $_FILES['uploadable_file'] AS AN ARGUMENT. HERE IS A SMILEY FACE FOR U :) 
		public function  set_file($file){
			if (empty($file) || !$file || !is_array($file)) {
				$this->errors[] = "An error occured while uploading the file. Contact the sysadmin.";
				return false;
			}elseif ($file['error'] != 0) {
				$this->errors[] = $this->upload_errors_array[$file['error']]; 
				return false;
			}else {
				$this->filename = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = ceil($file['size']);				
				$this->date_uploaded = date('Y-m-d:h-m-s');
			}
		}

		#DINAMIC PATH THING
		public function picture_path(){
			return $this->upload_directory.DS.$this->filename;
		}

		#METHOD FOR SAVING PICS IN DATABASE
		public function save(){
			if ($this->id) {
				$this->update();
			}else {
				if (!empty($this->errors)) {
					echo 'smth went wrong'; #delete this line
					return false;
				}

				if (empty($this->filename) || empty($this->tmp_path)) {
					$this->errors[] = "File is not available";
					return false;
				}

				$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

				if (file_exists($target_path)) {
					$this->errors[] = "The file {$this->filename} already exists";
					return false;
				}

				if (move_uploaded_file($this->tmp_path, $target_path)) {
					if ($this->create()) {
						unset($this->tmp_path);
						return true;
					}
				}else {
					$this->errors[] = "Some real shit happend. Something wrong with directories. You, me and others are fucked.";
				}
			} #HUGE ELSE STATEMENT ENDED
		} #SAVE METHOD ENDED

		#DELETE PHOTO FROM SERVER AND DB
		public function delete_photo(){
			if ($this->delete()) {
				$target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
				return unlink($target_path) ? true : false;
			}else {
				return false;
			}
		}

	} #CLASS PHOTO ENDED
?>