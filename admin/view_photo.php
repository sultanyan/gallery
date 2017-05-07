<link rel="stylesheet" type="text/css" href="css/modal-style.css">
<script type="text/javascript" src="js/modal-script.js"></script>
<?php include 'admin_includes/init.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("photos.php");
    }
    if (empty($_GET['id'])) {
         redirect("photos.php");
    }
?>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <!--MODAL CONTAINER-->
                <div id="modal-container">
                    <!-- Trigger the Modal -->
                    <img id="myImg" src="img.jpg" alt="Trolltunga, Norway" width="300" height="200">

                    <!-- The Modal -->
                    <div id="myModal" class="modal">

                      <!-- The Close Button -->
                      <span class="close">&times;</span>

                      <!-- Modal Content (The Image) -->
                      <img class="modal-content" id="image">

                      <!-- Modal Caption (Image Text) -->
                      <div id="caption"></div>
                    </div>
                </div>
            <!--MODAL CONTAINER END-->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->