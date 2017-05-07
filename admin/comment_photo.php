<?php include 'admin_includes/header.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }
    if (empty($_GET['id'])) {
    	redirect("photos.php");
    }
    $comments = Comment::find_the_comments($_GET['id'])
?>
	<div id="wrapper">
		<?php include 'admin_includes/top_nav.php'; ?>
		<?php include 'admin_includes/left_nav.php'; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
			    <!-- Page Heading -->
			    <div class="row">
			        <div class="col-lg-12">
			            <h1 class="page-header">Comments</h1>
			            <div class="col-md-12">
			            	<table class="table table-bordered">
			            		<thead>
			            			<tr>
			            				<th>ID</th>
			            				<th>Author</th>
			            				<th>Body</th>			            				
			            			</tr>
			            		</thead>
			            		<tbody>
			            		<?php foreach ($comments as $comment): ?>
			            			<tr>
			            				<td><?php echo $comment->id; ?>
			            					<div class="actions">
					            				<a href="delete_comment_spec.php?id=<?php echo $comment->id ?>"><i class="fa fa-trash fa-1x"></i></a>
			            					</div>
			            				</td>
			            				<td><?php echo $comment->author; ?></td>
		            					<td><?php echo $comment->body; ?></td>
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