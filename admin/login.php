<?php require_once 'admin_includes/header.php'; ?>
<?php 
	if ($session->is_signed_in()) {
		redirect("index.php");
	}

	if (isset($_POST['submit'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		#METHOD TO CHECK DATABASE FOR USER
		$user_found = User::verify_user($username, $password);

		if ($user_found) {
			$session->login($user_found);
			redirect('index.php');
		}else {
			$msg = "Your username or password are incorrect.";
		}
	}else {
		$msg="";
		$username = "";
		$password = "";
	}
?>
<!-- LOGIN FORM -->
	<div class="col-md-4 col-md-offset-4">
		<h3 class="danger"><?php echo $msg; ?></h3>
		<form id="loginForm" action="" method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo htmlentities($username); ?>">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo htmlentities($password); ?>">
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			</div>
		</form>
	</div>