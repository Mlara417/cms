<?php bulkOptionsCheckboxArray(); ?>
                         
<form action="" method="post">
                           

    <table class="table table-bordered table-hover">
                           
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select name="bulk_options" class="form-control" name="" id="">
                
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                
            </select>
            
        </div>
                         
        <div class="col-xs-4">
                          
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
                           
                           
                            <thead>
                                <tr>
                                   <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody> 
                                               
                            <?php viewAllPosts(); ?>
                            
                        </tbody>                            
                        </table>
                        
</form>

<?php deletePost(); ?>