<?php 
	function __autoload($class){
		$class = strtolower($claass);
		$file = "admin_includes/{$class}.php";
		if (file_exists($file)) {
			require_once ($file);
		}else {
			die("File was not found.");
		}
	}
?>