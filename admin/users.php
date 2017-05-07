<?php include 'admin_includes/header.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }
?>
<?php 
	$users = User::find_all();
?>
	<div id="wrapper">
		<?php include 'admin_includes/top_nav.php'; ?>
		<?php include 'admin_includes/left_nav.php'; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
			    <!-- Page Heading -->
			    <div class="row">
			        <div class="col-lg-12">
			            <h1 class="page-header">Users <br>
			            <a href="add_user.php" class="btn btn-primary"> Add user</a>
			            </h1>
			            <div class="col-md-12">
			            	<table class="table table-bordered">
			            		<thead>
			            			<tr>
			            				<th>ID</th>
			            				<th>Photo</th>
			            				<th>Username</th>
			            				<th>Password</th>
			            				<th>First Name</th>
			            				<th>Last Name</th>
			            			</tr>
			            		</thead>
			            		<tbody>
			            		<?php foreach ($users as $user): ?>
			            			<tr>
			            				<td><?php echo $user->id; ?></td>
			            				<td><img src="<?php echo $user->image_path_and_placeholder(); ?>" alt="Format Not Supported" class="all_users_image img-responsive"></td>
			            				<td><?php echo $user->username; ?>
				            				<div class="actions">
					            				<a href="edit_user.php?id=<?php echo $user->id ?>"><i class="fa fa-pencil fa-1x"></i></a>
					            				<a href="delete_user.php?id=<?php echo $user->id ?>"><i class="fa fa-trash fa-1x"></i></a>
			            					</div>
		            					</td>
		            					<td><?php echo $user->password; ?></td>
			            				<td><?php echo $user->first_name; ?></td>
			            				<td><?php echo $user->last_name; ?></td>
			            			</tr>
			            		<?php endforeach ?>	
			            		</tbody>
			            	</table>
			            </div>			
			        </div>
			    </div>
			    <!-- /.row -->
			</div>
		</div>
		<!-- /#page-wrapper -->
	</div>
	<!-- /#wrapper -->
<?php include 'admin_includes/footer.php'; ?>