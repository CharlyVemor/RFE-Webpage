<?php

function check_login($con)
{
    if(isset($_SESSION['ID_User']))
    {
        $id = $_SESSION['ID_User'];
        $query = "select * from usuarios where ID_User = '$id' limit 1";
        
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
    $query = "select * from videojuegos";
    $result = mysqli_query($con,$query);
    return $result;
}
function display_reviews($videogame_id){
    global $con;
    $query = "select * from reviews where ID_Vid = $videogame_id";
    $result = mysqli_query($con,$query);
    return $result;
}
?>