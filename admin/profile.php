<?php include "includes/admin_header.php"; ?>

<?php userProfileQuery(); ?>
<?php updateUserQuery(); ?>

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
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        
                            <div class="form-group">
                                <label for="user_firstname">Firstname</label>
                                <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                            </div>
    
                            <div class="form-group">
                                <label for="user_lastname">Lastname</label>
                                <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                            </div>
    
                            <div class="form-group">
                                <h5>User Role</h5>   
                                <select name="user_role" value="<?php echo $user_role; ?>" id=""> 
                                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>   
                                    <?php userRoleAdminCheck($user_role); ?>
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="post_tags">Username</label>
                                <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                            </div>
    
                            <div class="form-group">
                                <label for="post_content">Email</label>
                                <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                            </div>

                            <div class="form-group">
                                <label for="post_content">Password</label>
                                <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
                            </div>
                        </form>
                           
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
        <?php include "includes/admin_footer.php"?>