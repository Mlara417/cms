<?php
    if(isset($_GET['p_id'])){

    $the_post_id =  $_GET['p_id'];

    }


    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $selectPostsById = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($selectPostsById)) {
        $post_author = $row['post_author'];
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }



?>
  
   

         <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input  value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
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
                
        echo "Post Updated: " . " " . "<a href='posts.php'>View Posts</a> ";
    }
                
            

        ?>
           
            
            
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
    <select name="post_status" id="">
        <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
        
        <?php
if($post_status == 'published'){
    
    echo "<option value='draft'>draft</option>";
    
} else {
    
    echo "<option value='published'>publish</option>";
    
}


        ?>
       
        
    </select>
             </div>
    
<!--     <div class="form-group">
        <label for="post_status">Post Status</label>
        <input  value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div> -->
    
    <div class="form-group">
       <h5>Post Image</h5>
        <img width="150" src= "../images/<?php echo $post_image; ?>" alt= "" />
        
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input  value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
<label for="post_content">Post Content</label>
<textarea  class="form-control" name="post_content" id="body2" cols="30" rows="10"><?php echo $post_content; ?></textarea>
           <script>
    ClassicEditor
        .create( document.querySelector( '#body2' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
    
</form>