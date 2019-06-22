<?php

if(isset($_POST['create_post'])) {
        
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('m-d-y');
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query ="INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    
    $query .= "VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
        
    $create_post_query = mysqli_query($connection, $query);
    
    confirm($create_post_query);
}

?>
  
   

   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    
<div class="form-group">
        <h5>Post Category</h5>   
        <select name="post_category" id="post_category"> 
        <?php

        $query = "SELECT * FROM categories";
        $selectCategoriesID = mysqli_query($connection,$query);
            
            confirm($selectCategoriesID);

        while($row = mysqli_fetch_assoc($selectCategoriesID)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
            
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
            
        }
            
            if(isset($_POST['update_post'])) {
                
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
                
        move_uploaded_file($post_image_temp, "../images/$post_image");
                
        if(empty($post_image)) {
            
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            
            $select_image = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_array($select_image)) {
                
                $post_image = $row['post_image'];
                
            }
        }
                
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id} ";
                
        $update_post = mysqli_query($connection, $query);
                
        confirm($update_post);
    }
                
            

        ?>
           
            
            
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control" name="post_content" id="" cols="30" rows="10">
        </textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
    
</form>