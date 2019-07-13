<?php include "includes/admin_header.php"; ?>
<?php include "includes/admin_navigation.php"; ?>
   
    
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <small>
                            
                            <?php  showUsername(); ?> 
                            
                             </small>
                        </h1>
                        
                        <?php postPageOptions(); ?>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
        <?php include "includes/admin_footer.php"?>