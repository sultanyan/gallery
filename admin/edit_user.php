<?php include 'admin_includes/header.php'; ?>
<?php include 'admin_includes/modal.php'; ?>
<?php 
$msg = "";
if (!$_GET['id']) {
	redirect("users.php");
}
	$user = User::find_by_id($_GET['id']);
	if (isset($_POST['update'])) {
		if ($user) {
			$user->username = $_POST['username'];
			$user->password = $_POST['password'];
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			if (empty($_FILES['user_image'])) {
				$user->save();
			}else {
				 $user->set_file($_FILES['user_image']);
				 $user->upload_image();
				 $user->save();
			}
			$msg = "<div class='alert alert-success'>User updated. You can continue or <a href='users.php'>view all.</a></div>";
		}
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
			            <h1 class="page-header">Edit User</h1>

		            <div class="form-group col-md-6">
		            	<div class="user_image_box">
		            		<a href="#" data-toggle="modal" data-target="#photo-library">
		            			<img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>">
		            		</a>
		            	</div>
		            	<br>
		            	<input type="file" name="user_image" id="picture">
		            </div>
		            
			        <form action="" method="POST" enctype="multipart/form-data">
			            <div class="col-md-6">
			            <?php echo $msg; ?>
				            <div class="form-group">
				            	<label for="username" class="label label-primary">Username</label>
				            	<input type="text" name="username" id="username" class="form-control" value="<?php echo $user->username; ?>">
				            </div>

				            <div class="form-group">
				            	<label for="password" class="label label-primary">Password</label>
				            	<input type="password" name="password" id="password" class="form-control" value="<?php echo $user->password; ?>">
				            </div>	
				            <div class="form-group">
				            	<label for="first_name" class="label label-primary">First name</label>
				            	<input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
				            </div>
				            <div class="form-group">
				            	<label for="last_name" class="label label-primary">Last name</label>
				            	<input class="form-control" name="last_name" id="last_name" value="<?php echo $user->last_name; ?>">
				            </div>
				            <a id="user-id" class="btn btn-danger pull-right" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
				            <input type="submit" name="update" value="Update" class="btn btn-success">
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