<?php 
	#A FUNCTION FOR AUTOMATICALLY LOADING CLASSES
	function __autoload($class){
		$class = strtolower($class);
		$file = "admin_includes/{$class}.php";
		if (file_exists($file)) {
			require_once ($file);
		}else {
			die("File was not found.");
		}
	}

	#A FUNCTION FOR QUICK REDIRECTING
	function redirect($location){
		header("Location:{$location}");
	}
?>