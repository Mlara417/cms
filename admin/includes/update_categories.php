<form action="" method="post">
                                <label for="cat_title">Edit Category</label>
                                <div class="form-group">

                                <?php showCategory(); ?>
                                <?php updateCategory(); ?>
                            

                                   
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                </div>
                            </form>