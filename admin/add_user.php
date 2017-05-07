<?php include 'admin_includes/header.php'; ?>
<?php 
$msg = "";
	if (isset($_POST['signup']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {
		$user = new User();
		$user->username = $_POST['username'];
		$user->set_file($_FILES['user_image']);
		$user->save_user_image();
		$user->password = $_POST['password'];
		$user->first_name = $_POST['first_name'];
		$user->last_name = $_POST['last_name'];
		$user->save();
		$msg = "<div class='alert alert-success'>User added. You can add more or <a href='users.php'>view all.</a></div>";
	}
?>
	<div id="wrapper">
		<?php include 'admin_includes/top_nav.php'; ?>
		<?php include 'admin_includes/left_nav.php'; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
			    <!-- Page Heading -->
			    <div class="row">
			        <div class="col-lg-12 enlarge">
			            <h1 class="page-header">Add User</h1>
			           <?php echo $msg; ?>
			        <form action="" method="POST" enctype="multipart/form-data">
			            <div class="col-md-8">
				            <div class="form-group">
				            	<label for="username" class="label label-primary">Username</label>
				            	<input type="text" name="username" id="username" class="form-control">
				            </div>

				            <div class="form-group">
				            	<label for="picture" class="label label-primary">Picture</label> <br> 
				            	<input type="file" name="user_image" id="picture">
				            </div>

				            <div class="form-group">
				            	<label for="password" class="label label-primary">Password</label>
				            	<input type="password" name="password" id="password" class="form-control">
				            </div>	
				            <div class="form-group">
				            	<label for="first_name" class="label label-primary">First name</label>
				            	<input type="text" name="first_name" id="first_name" class="form-control">
				            </div>
				            <div class="form-group">
				            	<label for="last_name" class="label label-primary">Last name</label>
				            	<input class="form-control" name="last_name" id="last_name">
				            </div>
				            <input type="submit" name="signup" value="Sign up" class="btn btn-primary">
				        </div>
				        </div>
				    </form>    



			        </div>
			    </div>
			    <!-- /.row -->
			</div>
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
<?php include 'admin_includes/footer.php'; ?>