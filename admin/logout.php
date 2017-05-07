<?php require_once 'admin_includes/init.php'; ?>
<?php 
	$session->logout();
	redirect("login.php");
?>