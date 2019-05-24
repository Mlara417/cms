<form action="" method="post">
                                <label for="cat_title">Edit Category</label>
                                <div class="form-group">

                                <?php
                                    
                        if(isset($_GET['update_category'])){
                            
                            $cat_id = $_GET['update_category'];    
                        
                        $query = "SELECT * FROM categories";
                        $selectCategoriesID = mysqli_query($connection,$query);
                                
                        while($row = mysqli_fetch_assoc($selectCategoriesID)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            
                            ?>
                                   
                <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>
" type="text" class="form-control" name="cat_title">
                                    
                      <?php  }} ?>
                           
                    <?php //UPDATE QUERY
                                
                        if(isset($_POST['update_category'])) {
                            $the_cat_title = $_POST['cat_title'];
                            
                            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id} ";
                            $update_query = mysqli_query($connection, $query);
                            
                            if(!$update_query){
                                die("Query failed" . mysqli_error($connection));
                            }
                            
                            header("Location: categories.php"); //sends another request for page and refreshes page
                            
                        }



                    ?>
                            

                                   
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            </form>