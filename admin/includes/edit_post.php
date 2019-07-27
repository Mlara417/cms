<?php list($post_author, $post_id, $post_title, $post_category_id, $post_status, $post_image, $post_content, $post_tags, $post_comment_count, $post_date) = editMyPost(); ?>
<?php updatePost(); ?>
           
            
            
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
    <select name="post_status" id="">
        <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
        
        <?php postStatusToggleUpdate($post_status); ?>
        
    </select>
             </div>
    <div class="form-group">
       <h5>Post Image</h5>
        <img width="150" src= "../images/<?php echo $post_image; ?>" alt= "" />
        
        <input type="file" name="image">
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