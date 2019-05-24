
<?php
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
