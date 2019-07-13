<?php
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
