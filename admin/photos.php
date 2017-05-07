<?php include 'admin_includes/header.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }
?>
<?php 
	$photos = Photo::find_all();
?>
<body>
	<div id="wrapper">
		<?php include 'admin_includes/top_nav.php'; ?>
		<?php include 'admin_includes/left_nav.php'; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
			    <!-- Page Heading -->
			    <div class="row">
			        <div class="col-lg-12">
			            <h1 class="page-header">
			          	Photos
			            <small>View, Edit &amp; Delete the Photo You Want</small>
			            </h1>
			            <div class="col-md-12">
			            	<table class="table table-bordered">
			            		<thead>
			            			<tr>
			            				<th>Photo</th>
			            				<th>ID</th>
			            				<th>Title</th>
			            				<th>Short description</th>
			            				<th>Filename</th>
			            				<th>Type</th>
			            				<th>Size</th>
			            				<th>Uploaded</th>
			            			</tr>
			            		</thead>
			            		<tbody>
			            		<?php foreach ($photos as $photo) : ?>
			            			<tr>
			            				<td><img src="<?php echo $photo->picture_path(); ?>" alt="Format Not Supported" class="admin-image img-responsive">
			            				<div class="actions">
			            					<a href="../photo.php?id=<?php echo $photo->id ?>"><i class="fa fa-eye fa-1x"></i></a>
				            				<a href="edit_photo.php?id=<?php echo $photo->id ?>"><i class="fa fa-pencil fa-1x"></i></a>
				            				<a class="delete_btn" href="delete_photo.php?id=<?php echo $photo->id ?>"><i class="fa fa-trash fa-1x"></i></a>
				            				<a href="comment_photo.php?id=<?php echo $photo->id ?>">
				            				<?php $comments = Comment::find_the_comments($photo->id); 
				            					echo "<i class='fa fa-comments fa-1x'></i>" . " " . "<small>" . count($comments) . "</small";
				            				?>
				            				</a>
			            				</div>
			            				</td>
			            				<td><?php echo $photo->id; ?></td>
			            				<td><?php echo $photo->title; ?></td>
			            				<td><?php echo substr($photo->description, 0, 35) . ' ...'; ?></td>
			            				<td><?php echo substr($photo->filename, 0, 7) . '...' ?></td>
			            				<td><?php echo $photo->type; ?></td>
			            				<td>
			            				<?php
			            					if ($photo->size <= 1000000) {
			            						echo ceil(($photo->size)/1000) . ' KB';
			            					}else if($photo->size >= 1000000) {
			            						echo '~' . floor(($photo->size)/1000000) . ' MB';
			            					}
			            				?></td>
			            				<td><?php echo $photo->date_uploaded; ?></td>
			            			</tr>
			            		<?php endforeach; ?>	
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