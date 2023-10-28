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
    $query = "select * from videojuegos where ID_Vid = $videogame_id";
    $result = mysqli_query($con, $query);
    $game_data = mysqli_fetch_assoc($result);

    $reviews = display_reviews($videogame_id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="shortcut icon" type="x-icon" href="RFG icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>RFE - Ya existe</title>
        <link rel="stylesheet" type="text/css" href="styles/general.css" />
        <link rel="stylesheet" type="text/css" href="styles/header.css" />
        <link rel="stylesheet" type="text/css" href="styles/reviews.css" />
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <head>
    <body>
        <div class="dummy-header"></div>
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
                    <i class='bx bxs-user-circle'></i>
                </div>
                <a class="no-underline" href="logout.php">&#8594 Cerrar Sesión</a>
            </div>
        </div>
        <div class="main-page">
            <div class="game-title">
                <p>
                    Reseñas de: <?php echo $game_data['Name']?>
                </p>
            </div>
            <?php
                if(mysqli_num_rows($reviews) == 0){
                    echo 
                    '
                    <div class="center-container">
                        <p>Este juego no tiene reseñas aún</p>
                        <a href="index.php">Regresar</a>
                    <div>
                    ';
                }
                else{
                    while ($row = mysqli_fetch_assoc($reviews))
                    {
                        echo
                        '
                        <div class="review-grid">
                            <div class="review">
                                <div class="top-container">
                                    <div class="username">
                                        <i class="bx bxs-user-circle"></i>
                                        <p>'.$row['Username'].'</p>
                                    </div>
                                    <div class="stars">';
                                    $gray_stars = 5 - (int)$row['Rating'];
                                    for($i = 0; $i < $row['Rating']; $i++){
                                        echo '<i class="bx bxs-star yellow-star"></i>';
                                    }
                                    for($i = 0; $i < $gray_stars; $i++){
                                        echo '<i class="bx bxs-star gray-star"></i>';
                                    }
                                echo '
                                    </div>
                                </div>
                                
                                <div class="review-text">
                                    <p>'.$row['Review'].'</p>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
            ?>
        </div>
    </body>
</html>