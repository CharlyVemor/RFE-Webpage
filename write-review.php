<?php
session_start();
    include("connection.php");
    include("functions.php");

    $videogame_id = 0;

    if(isset($_GET['videogame_id'])){
        $videogame_id=$_GET['videogame_id'];
    }

    $user_data = check_login($con);

    if($videogame_id == 0){
        header("Location: index.php");
    }
    else{
        $user_id = $user_data['ID_User'];
        $query = "select * from reviews where ID_Vid = $videogame_id and ID_User = $user_id limit 1";
        $result = mysqli_query($con, $query);
        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                header("Location: review-exists.php");
            }
        }
    }
    $query = "select * from videojuegos where ID_Vid = $videogame_id";
    $result = mysqli_query($con, $query);
    $game_data = mysqli_fetch_assoc($result);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $rating = intval($_POST['rating']);
        $review = $_POST['review'];
        $user_id = $user_data['ID_User'];
        echo $rating;
        //write to database
        $query = "insert into reviews (ID_User,ID_Vid,Rating,Review) values ($user_id,$videogame_id,$rating,'$review')";
        
        mysqli_query($con, $query);
       header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="shortcut icon" type="x-icon" href="RFG icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>RFE - Escribir Reseña</title>
        <link rel="stylesheet" type="text/css" href="styles/general.css" />
        <link rel="stylesheet" type="text/css" href="styles/header.css" />
        <link rel="stylesheet" type="text/css" href="styles/write-review.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <head>
    <body>
        <div class="RFE-header">
            <div class="left-header"></div>
            <a class="no-underline" href="index.php">
                <div class="center-header">
                    <h3>Red Fog Entertainment</h3>
                </div>
            </a>
            <div class="right-header">
                <div class="right-subcontainer">
                    <p><?php echo $user_data['Username'];?></p>
                    <i class='bx bxs-user-circle white'></i>
                </div>
                <a class="no-underline" href="logout.php">&#8594 Cerrar Sesión</a>
            </div>
        </div>
        <div class="main-page">
            <div class="center-grid">
                <div class="review-container">
                    <div class="stars">
                        <form method="post">
                            <div class="all-stars">
                                <input type="radio" name="rating" id="rate-5" value="5">
                                <label for="rate-5" class="bx bxs-star"></label>
                                <input type="radio" name="rating" id="rate-4" value="4">
                                <label for="rate-4" class="bx bxs-star"></label>
                                <input type="radio" name="rating" id="rate-3" value="3">
                                <label for="rate-3" class="bx bxs-star"></label>
                                <input type="radio" name="rating" id="rate-2" value="2">
                                <label for="rate-2" class="bx bxs-star"></label>
                                <input type="radio" name="rating" id="rate-1" value="1">
                                <label for="rate-1" class="bx bxs-star"></label>
                            </div>
                            <div class="text-area">
                                <h1><?php echo $game_data['Name']?></h1>
                                <textarea name="review" id="review" cols="30" placeholder="Escribe tu reseña..."></textarea>
                            </div>
                            <div class="btn">
                                <button type="submit">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>