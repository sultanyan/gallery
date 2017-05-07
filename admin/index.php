<?php include 'admin_includes/header.php'; ?>
<?php
    if (!$session->is_signed_in()) {
        redirect("login.php");
    }
?>
<body>
    <div id="wrapper">
        <?php include 'admin_includes/top_nav.php'; ?>
        <?php include 'admin_includes/left_nav.php'; ?>
        <div id="page-wrapper">
           <?php include 'admin_includes/admin_content.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include 'admin_includes/footer.php'; ?>