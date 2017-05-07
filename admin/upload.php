<?php include 'admin_includes/header.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }
?>
<?php 
$msg = "";
	if (isset($_FILES['file'])) {
		$photo = new Photo();
		$photo->title = $_POST['title'];
		$photo->description = $_POST['description'];
		$photo->set_file($_FILES['file']); 
		if ($photo->save()) {
			$msg = "
					<div class='alert alert-success'>Photo uploaded successfully. Now you can upload more or <a href='photos.php'>View all photos</>

					</div>";
		}else {
			$msg = join("<br>", $photo->errors);
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
			        <div class="col-lg-12">
			            <h1 class="page-header">
			          	Upload
			            </h1>
			            <div class="row">
			            <div class="col-md-6">
			            <?php echo $msg; ?>
				            <form action="" method="POST" enctype="multipart/form-data">
				            	<div class="form-group">
				            		<label for="title" class="label label-primary">Image title</label>
				            		<input type="text" name="title" id="title" class="form-control" placeholder="Title">
				            	</div>
				            	<div class="form-group">
					            	<label for="description" class="label label-primary">Image description</label>
				            		<textarea name="description" class="form-control" cols="3" rows="3" placeholder="Description"></textarea>
				            	</div>
				            	<div class="form-group">
				            		<input type="file" name="file">
				            	</div>
				            	<input type="submit" value="Upload" name="submit" class="btn btn-primary">
				            </form>
				        </div>
				        </div> <!-- Row ended  -->
				        <div class="row">
				        	<div class="col-lg-12">
				        		<form action="upload.php" class="dropzone"></form>
				        	</div>
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