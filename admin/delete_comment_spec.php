<?php include 'admin_includes/init.php'; ?>
<?php 
	if (empty($_GET['id'])) {
		redirect('comment_photo.php');
	}

	if (!$session->is_signed_in()) {
        redirect("comment_photo.php");
    }

	$comment = Comment::find_by_id($_GET['id']);
	if ($comment) {
		$comment->delete();
		redirect("comment_photo.php?id={$comment->photo_id}");
	}
?>