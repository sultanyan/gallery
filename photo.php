<?php require_once 'admin/admin_includes/init.php'; ?>
<?php include "includes/header.php" ?>
<?php include 'includes/navigation.php'; ?>
<?php 
    $photo = Photo::find_by_id($_GET['id']);
?>
<?php 
$msg = "";
    if (empty($_GET['id'])) {
        redirect("index.php");
    }
    if (isset($_POST['submit'])) {
        $author = trim($_POST['author']);
        $body = trim($_POST['body']);
        $new_comment = Comment::create_comment($photo->id, $author, $body);
        if ($new_comment && $new_comment->save()) {
            redirect("photo.php?id={$photo->id}");
        }else {
            $msg = "<div class='alert alert-danger'>Comment was not posted. Our poor sysadmin is working on this problem :( </div>";
        }
    }else {
        $author = "";
        $body = "";
    }

    $comments = Comment::find_the_comments($photo->id);
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                
                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $photo->date_uploaded; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path() ?>">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>

                <hr>

                <!-- Blog Comments -->






                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <?php echo $msg; ?>
                    <form role="form" method="POST" action="">
                        <div class="form-group">
                            <label for="author" class="label label-primary">Author</label>
                            <input type="author" name="author" id="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body" class="label label-primary">Comment</label>
                            <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>
                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <?php foreach ($comments as $comment): 
                    ?>
                    
                    <div class="well">
                        <h4 class="media-heading"> <?php echo $comment->author; ?>
                            <small><!-- August 25, 2014 at 9:30 PM --></small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
<?php include 'includes/footer.php'; ?>
</div>