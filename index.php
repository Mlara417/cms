<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    

    <!-- Navigation -->

    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <h1 class="page-header">
                Welcome to<br>
            <small>My Blog</small>
            </h1>
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php selectAllPostsQuery(); ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"?>
                

                <!-- Side Widget Well -->
                <?php include "widget.php";  ?>
            

            </div>

        </div>
        <!-- /.row -->

        <hr>

       <?php include "includes/footer.php"?>
        