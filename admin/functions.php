<?php
function editPost() {
    global $connection, $post_title, $the_post_id;
    
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
    
    return $post_title;



    if(isset($_POST['update_post'])) {
                
        $post_author2 = $_POST['post_author'];
        $post_title2 = $_POST['post_title'];
        $post_category_id2 = $_POST['post_category'];
        $post_status2 = $_POST['post_status'];
        $post_image2 = $_FILES['image']['name'];
        $post_image_temp2 = $_FILES['image']['tmp_name'];
        $post_content2 = $_POST['post_content'];
        $post_tags2 = $_POST['post_tags'];
                
        move_uploaded_file($post_image_temp2, "../images/$post_image2");
                
        if(empty($post_image2)) {
            
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            
            $select_image = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_array($select_image)) {
                
                $post_image2 = $row['post_image'];
                
            }
        }
                
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title2}', ";
        $query .= "post_category_id = '{$post_category_id2}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author2}', ";
        $query .= "post_status = '{$post_status2}', ";
        $query .= "post_tags = '{$post_tags2}', ";
        $query .= "post_content = '{$post_content2}', ";
        $query .= "post_image = '{$post_image2}' ";
        $query .= "WHERE post_id = {$the_post_id} ";
                
        $update_post = mysqli_query($connection, $query);
                
        confirm($update_post);
                
        echo "<p class='bg-success'>Post Updated: <a href='../post.php?p_id={$the_post_id}'>View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
    }
    
    
}








function adminUserRoleValidation() {
    global $connection;
    
    if(!isset($_SESSION['user_role'])) {

            header("Location: ../index.php");

    }
    
}







function createUser() {
    global $connection;
    
    if(isset($_POST['create_user'])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            if(!$select_randsalt_query) {
                die("Query Failed" . mysqli_error($connection));
            }

            $row = mysqli_fetch_array($select_randsalt_query);
            $salt = $row['randSalt'];
            $hashed_password = crypt($user_password, $salt);

        $query ="INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

        $query .= "VALUES ('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$hashed_password}')";

        $create_user_query = mysqli_query($connection, $query);

        confirm($create_user_query);

        echo "User {$username} Created: " . " " . "<a href='users.php'>View Users</a> ";
    }
} 






function categoryDropdownOptions() {
    global $connection;
    
    $query = "SELECT * FROM categories";
    $selectCategoriesID = mysqli_query($connection,$query);

        confirm($selectCategoriesID);

    while($row = mysqli_fetch_assoc($selectCategoriesID)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];

        echo "<option value='{$cat_id}'>{$cat_title}</option>";

    }
}










function createPost() {
    global $connection;
    
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

        $the_post_id = mysqli_insert_id($connection);

            echo "<p class='bg-success'>Post Created: <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit Posts</a></p>";
    }
}










function createCategoryListSidebar() {
    global $connection, $selectCategoriesSidebar;
    
    while($row = mysqli_fetch_assoc($selectCategoriesSidebar)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];    

    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
    }    
}








function showCategoriesSidebar() {
    global $connection, $selectCategoriesSidebar;
    
    $query = "SELECT * FROM categories LIMIT 5";
    $selectCategoriesSidebar = mysqli_query($connection,$query);
    confirm($selectCategoriesSidebar);
}








function editPostUserRoleCheck() {
    global $connection;
    
    if(isset($_SESSION['user_role'])) {

        if(isset($_GET['p_id'])) {

        $the_post_id = $_GET['p_id'];

        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";

        }

    }     
}










function navCategoryQuery() {
    global $connection;
    
    $query = "SELECT * FROM categories";
    $selectAllCategoriesQuery = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($selectAllCategoriesQuery)) {
       $cat_title = $row['cat_title'];
       $cat_id = $row['cat_id'];

       echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
    }
}





function searchQuery() {
    global $connection;
    
    if(isset($_POST['submit'])){
        
        $search =  $_POST['search'];
        
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR ";
        $query .= "post_title LIKE '%$search%' OR ";
        $query .= "post_author LIKE '%$search%' OR ";
        $query .= "post_content LIKE '%$search%'";
        
        $searchQuery = mysqli_query($connection, $query);

        
        if(!$searchQuery) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        
        $count = mysqli_num_rows($searchQuery);
        
        if($count == 0) {
            echo "<h1>No Results</h1>" ;  
        } else{
                $query = "SELECT * FROM posts";
    $selectAllPostsQuery = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($searchQuery)) {
        $post_title = $row['post_title'];
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,100);
     ?>
                     <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?>
                    </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
     <?php   }
        
        
    }

                
                

                 }
}







function registerUserQuery() {
    global $connection, $message;
    
    if(isset($_POST['submit'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($password)) {

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);


        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        if (!$select_randsalt_query) {

            die("Query Failed" . mysqli_error($connection));

        }


        $row = mysqli_fetch_array($select_randsalt_query);

        $salt = $row['randSalt'];

        $password = crypt($password, $salt);


        $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber' ) ";
        $register_user_query = mysqli_query($connection, $query);
        if(!$register_user_query) {

            die("QUERY FAILED" . mysqli_error($connection) . '' . mysqli_errno($connection));

        }

            $message = "Your Registration has been submitted";


        } else {

            $message = "Fields cannot be empty";

        }



    } else {

        $message = "";

    }
    
}






function showApprovedComments() {
    global $connection;
    if(isset($_GET['p_id'])) {
        
        $the_post_id = $_GET['p_id'];
        
    }
    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id } ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC ";
    $select_comment_query = mysqli_query($connection, $query);
    confirm($select_comment_query);

    while ($row = mysqli_fetch_array($select_comment_query)) {

        $comment_date = $row['comment_date'];
        $comment_content = $row['comment_content'];
        $comment_author = $row['comment_author'];



        ?>


                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                               <?php echo $comment_author; ?>
                                <small>
                                <?php echo $comment_date; ?>
                                </small>
                            </h4>

                            <?php echo $comment_content; ?>

                        </div>
                    </div>    







    <?php }     
}





function createCommentQuery() {
    global $connection;
    
    if(isset($_POST['create_comment'])){

        $the_post_id = $_GET['p_id'];

        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];


        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){


            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

            $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

            $create_comment_query = mysqli_query($connection, $query);

            if(!$create_comment_query) {

                die('QUERY FAILED' . mysqli_error($connection));

            }

        } else {

            echo "<script>alert('Fields cannot be empty')</script>";

        }

    }
}





function singlePostQuery() {
    global $connection, $the_post_id;
    
    if(isset($_GET['p_id'])) {
        
        $the_post_id = $_GET['p_id'];
        
    }
                
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_all_posts_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,100);
        
        
     ?>


                <!-- First Blog Post -->
                <h2>
                    <?php echo $post_title; ?>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img src= "./images/<?php echo $post_image; ?>" alt= "" />
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
                <?php }

}











function selectAllPostsQuery() {
    global $connection;

    $query = "SELECT * FROM posts";
    $selectAllPostsQuery = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
        $post_title = $row['post_title'];
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,100);
        $post_status = $row['post_status'];
        
        if( $post_status == 'published')
        {
          
        
     ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?>
               </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img src= "./images/<?php echo $post_image; ?>" alt= "" />
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Keep Reading <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php }  }

}











function categorySpecificPostsQuery() {
    global $connection;
    
    
        if(isset($_GET['category'])){
        
        $post_category_id = $_GET['category'];
        
    }
                
                
    $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
    $selectAllPostsQuery = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectAllPostsQuery)) {
        $post_title = $row['post_title'];
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,100);
        
        
     ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?>
               </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img src= "./images/<?php echo $post_image; ?>" alt= "" />
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Keep Reading <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php }
}










function userPageOptions() {
    global $connection;
    
    if (isset($_GET['source'])){

        $source = $_GET['source'];

    } else {

        $source = '';
    }

        switch($source) {
                case 'add_user';
                include "includes/add_user.php";
                break;

                case 'edit_user';
                include "includes/edit_user.php";
                break;

                case '200';
                echo "200";
                break;

                default;

                include "includes/view_all_users.php";

                break;

        }
    
}








function userRoleAdminCheck($role) {
    global $connection;
    
    if($role === 'admin') {

        echo "<option value='subscriber'>subscriber</option>"; 

    } else {

        echo "<option value='admin'>admin</option>";

    }
}








function updateUserQuery() {
    global $connection, $user_firstname, $user_lastname, $user_role, $username, $user_email, $user_password;
    
    if(isset($_POST['update_user'])) {

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];    
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];


        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE username = '{$username}' ";

        $edit_user_query = mysqli_query($connection, $query);

        confirm($edit_user_query);
    }
}





function userProfileQuery() {
	global $connection, $user_id, $username, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $user_role;

	if(isset($_SESSION['username'])){
	    
	    $username = $_SESSION['username'];
	    
	    $query = "SELECT * FROM users WHERE username = '{$username}' ";
	    $select_user_profile_query = mysqli_query($connection, $query);
	    
	    while($row = mysqli_fetch_array($select_user_profile_query)) {
	        
	        $user_id = $row['user_id'];
	        $username = $row['username'];
	        $user_password = $row['user_password'];
	        $user_firstname = $row['user_firstname'];
	        $user_lastname = $row['user_lastname'];
	        $user_email = $row['user_email'];
	        $user_image = $row['user_image'];
	        $user_role = $row['user_role'];
	                                
	        
	    }
	    
	}
}








function postPageOptions() {
    global $connection;
    
    if (isset($_GET['source'])) {
        
        $source = $_GET['source'];
    
    } else {
        
        $source = '';
        
}
                        
    switch($source) {
        case 'add_post';
            include "includes/add_posts.php";
            break;
        
        case 'edit_post';
            include "includes/edit_post.php";
            break;
        
        default;
            include "includes/view_all_posts.php";
            break;            
    }    
    
}









function viewAllComments() {
    global $connection;

    if (isset($_GET['source'])) {
        
        $source = $_GET['source'];
        
    } else {

        $source = '';
        
    }
    
    switch($source) {
            
        default;
            include "includes/view_all_comments.php";
            break;
            
        }
}






function editCategories(){
    global $connection;
    
    if(isset($_GET['edit'])) {

        $cat_id = $_GET['edit'];

        include "includes/update_categories.php";

    }
    
}



function chartElements() {
    global $element_text, $element_count, $i,$post_counts,$post_published_counts,$post_draft_counts,$comment_counts,$unapproved_comments_counts,$user_counts,$subscriber_counts,$category_counts;
    
    $element_text = ['All Posts','Active Posts','Draft Posts','Comments','Pending Comments','Users','Subscribers','Categories'];

    $element_count = [$post_counts,$post_published_counts,$post_draft_counts,$comment_counts,$unapproved_comments_counts,$user_counts,$subscriber_counts,$category_counts];

        for($i = 0; $i < 8; $i++){

            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

        }
}





function publishedPostCountQuery() {
    global $connection, $post_published_counts;
    
    $query = "SELECT * FROM posts WHERE post_status = 'published'";
    $select_all_published_post = mysqli_query($connection, $query);
    $post_published_counts = mysqli_num_rows($select_all_published_post);
    
    return $post_published_counts;
    
}



function draftPostCountQuery() {
    global $connection, $post_draft_counts;
    
    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
    $select_all_draft_post = mysqli_query($connection, $query);
    $post_draft_counts = mysqli_num_rows($select_all_draft_post);
    
    return $post_draft_counts;
    
}




function unapprovedCommentCountQuery() {
    global $connection, $unapproved_comments_counts;
    
    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $unapproved_comments_query = mysqli_query($connection, $query);
    $unapproved_comments_counts = mysqli_num_rows($unapproved_comments_query);
    
    return $unapproved_comments_counts;
    
}







function subscriberCountQuery() {
    global $connection, $subscriber_counts;
    
    
    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $select_all_subscribers = mysqli_query($connection, $query);

    $subscriber_counts = mysqli_num_rows($select_all_subscribers);
    
    return $subscriber_counts;
    
}
                
                

                



function categoryCountQueryDashboard() {
    global $connection, $category_counts;
    
    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);

    $category_counts = mysqli_num_rows($select_all_categories);

    echo "<div class='huge'>{$category_counts}</div>";
    
}








function userCountQueryDashboard() {
    global $connection, $user_counts;
    
    $query = "SELECT * FROM users";
    $select_all_users = mysqli_query($connection, $query);

    $user_counts = mysqli_num_rows($select_all_users);

    echo "<div class='huge'>{$user_counts}</div>";
    
    
}








function commentCountQueryDashboard() {
    global $connection, $comment_counts;
    
    $query = "SELECT * FROM comments";
    $select_all_comments = mysqli_query($connection, $query);

    $comment_counts = mysqli_num_rows($select_all_comments);

    echo "<div class='huge'>{$comment_counts}</div>";
}







function postCountQueryDashboard() {
    global $connection, $post_counts;
    
    $query = "SELECT * FROM posts";
    $select_all_post = mysqli_query($connection, $query);

    $post_counts = mysqli_num_rows($select_all_post);

    echo "<div class='huge'>{$post_counts}</div>";
    
    
    
    
}






function showUsername() {
    
     echo $_SESSION['username'];
}








function confirm($result) {
    
    global $connection;
    
        if (!$result) {
        die ("QUERY FAILED ." . mysqli_error($connection));
    }
    
}








function insert_categories(){
        //CREATE CATEGORY QUERY
    
    global $connection;

    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {

            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";

            $createCategoryQuery = mysqli_query($connection, $query);

            if(!$createCategoryQuery) {
                die('Query Failed'. mysqli_error($connection));
            }
                }
    }
}










function findAllCategories() {
    
    global $connection;
                                
    $query = "SELECT * FROM categories";
    $selectCategories = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($selectCategories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }    
    
    
}








function deleteCategories(){
    global $connection;
    
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);

        header("Location: categories.php"); //sends another request for page and refreshes page

    }    
    
}

?>
