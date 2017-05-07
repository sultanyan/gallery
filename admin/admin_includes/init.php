<?php 
	#DIRECTORY SEPARATOR
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

	#SITE ROOT
	define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'gallery');

	#INCLUDES PATH
	define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'admin_includes');

	#REQUIRING THINGS, PUTTING THEM INTO OTHERS :) THAAAATS' NASTYYYYYYYYYYYYYYYYYYYY 
	require_once 'functions.php';
	require_once 'new_config.php';
	require_once 'database.php';
	require_once 'db_object.php';
	require_once 'comment.php';
	require_once 'user.php';
	require_once 'photo.php';
	require_once 'session.php';
	require_once 'paginate.php';
?>