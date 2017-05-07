<?php include 'admin_includes/header.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }
?>
<?php 
$msg = "";
	if (empty($_GET['id'])) {
		redirect('photos.php');
	}else {
		$photo = Photo::find_by_id($_GET['id']);
		if (isset($_POST['update'])) {
			if ($photo) {
				$photo->title = $_POST['title'];
				$photo->caption = $_POST['caption'];
				$photo->alternative_text = $_POST['alternative_text'];
				$photo->description = $_POST['description'];
				$photo->save();
				$msg = "<div class='alert success-msg alert-success'>Photo updated. Now you can continue or <a href='photos.php'>view all photos</a></div>";
			}
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
			            <h1 class="page-header">
			          	Edit Photos
			            </h1>
			           <?php echo $msg; ?>
			        <form action="" method="POST">
			            <div class="col-md-8">
				            <div class="form-group">
				            	<label for="title" class="label label-primary">Image title</label>
				            	<input type="text" name="title" id="title" class="form-control" value="<?php echo $photo->title; ?>">
				            </div>

				            <div class="form-group imgEditBox">
				            	<a href="#"> <img class="thumbnail pull-right inEditBox" src="<?php echo $photo->picture_path(); ?>"> </a>
				            </div>	

				            <div class="form-group">
				            	<label for="caption" class="label label-primary">Caption</label>
				            	<input type="text" name="caption" id="caption" class="form-control" value="<?php echo $photo->caption; ?>">
				            </div>	
				            <div class="form-group">
				            	<label for="alternative_text" class="label label-primary">Alternative text</label>
				            	<input type="text" name="alternative_text" id="alternative_text" class="form-control" value="<?php echo $photo->alternative_text; ?>">
				            </div>
				            <div class="form-group">
				            	<label for="description" class="label label-primary">Description</label>
				            	<textarea class="form-control" name="description" id="description"><?php echo $photo->description; ?></textarea>
				            </div>
				        </div>

				        <div class="col-md-4">
				        	<div class="photo-info-box">
				        		<div class="info-box-header">
				        			<h4>Save <span id="toggle" class="glyphicon glyphicon-menu-down pull-right"></span></h4>
				        		</div>
				        		<div class="inside">
				        			<div class="box-inner">
				        				<p class="text">
				        					<span class="glyphicon glyphicon-calendar"></span> <?php echo $photo->date_uploaded; ?>
				        				</p>
				        				<p class="text">
				        					Photo ID: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
				        				</p>
				        				<p class="text">
				        					Filename: <span class="data"><?php echo substr($photo->filename, 0, 5) . '...' ?></span>
				        				</p>
				        				<p class="text">
				        					File type: <span class="data"><?php echo $photo->type ?></span>
				        				</p>
				        				<p class="text">
				        					File size: <span class="data"><?php
			            					if ($photo->size <= 1000000) {
			            						echo ceil(($photo->size)/1000) . ' KB';
			            					}else if($photo->size >= 1000000) {
			            						echo '~' . floor(($photo->size)/1000000) . ' MB';
			            					}
			            				?></span>
				        				</p>
				        			</div>
				        				<!-- <div class="info-box-footer clearfix"> -->
				        				<div class="info-box-delete pull-left">
				        					<input type="submit" name="update" value="Update" class="btn btn-success">
				        				</div>
				        				<div class="info-box-delete pull-right">
				        					<a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">Delete</a>
				        				</div>
				        				
				        			</div>
				        		</div>
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