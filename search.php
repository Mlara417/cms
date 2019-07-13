<?php include "includes/db.php"?>
<?php include "includes/header.php"?>
    

    <!-- Navigation -->

    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php searchQuery(); ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"?>
                   
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

       <?php include "includes/footer.php"?>
        