<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php singlePostQuery(); ?>
                
                 <!-- Blog Comments -->
                 
                <?php createCommentQuery(); ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                           <label for="Author">Author</label>
                            <input type="text" name="comment_author" class="form-control" name="comment_author">
                        </div>
                       
                        <div class="form-group">
                           <label for="Email">Email</label>
                            <input type="text" name="comment_email" class="form-control" name="comment_email">
                        </div>
                        
                        <div class="form-group">
                           <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control"  rows="3"></textarea>
                                    
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php showApprovedComments(); ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"?>



        </div>
        </div>
        <!-- /.row -->

        <hr>

       <?php include "includes/footer.php"?>