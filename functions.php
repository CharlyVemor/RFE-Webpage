<?php

function check_login($con)
{
    if(isset($_SESSION['ID_User']))
    {
        $id = $_SESSION['ID_User'];
        $query = "SELECT * FROM usuarios WHERE ID_User = '$id' LIMIT 1";
        
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}

function display_videogames(){
    global $con;
    $query = "SELECT * FROM videojuegos";
    $result = $con->execute_query($query);
    return $result;
}
function display_reviews($videogame_id){
    global $con;
    $query = "SELECT reviews.Review, reviews.Rating, usuarios.Username FROM reviews INNER JOIN usuarios ON reviews.ID_User = usuarios.ID_User INNER JOIN videojuegos ON reviews.ID_Vid = videojuegos.ID_Vid WHERE reviews.ID_Vid = ? ";
    $result = $con->execute_query($query, [$videogame_id]);
    return $result;
}
?>