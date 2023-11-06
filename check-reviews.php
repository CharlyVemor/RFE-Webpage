<?php
session_start();

    include("connection.php");
    include("functions.php");

    $videogame_id = 0;

    //Obtiene el ID del videojuego desde el link
    if(isset($_GET['videogame_id'])){
        $videogame_id=$_GET['videogame_id'];
    }

    $user_data = check_login($con);

    //Si el ID no existe
    if($videogame_id == 0){
        header("Location: index.php");
    }
    $query = "SELECT * FROM videojuegos WHERE ID_Vid = ?";
    $result = $con->execute_query($query, [$videogame_id]);
    $game_data = $result->fetch_assoc();

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
                    <p><?= htmlspecialchars($user_data['Username'])?></p>
                    <i class='bx bxs-user-circle'></i>
                </div>
                <a class="no-underline" href="logout.php">&#8594 Cerrar Sesión</a>
            </div>
        </div>
        <div class="main-page">
            <div class="game-title">
                <p>
                    Reseñas de: <?= htmlspecialchars($game_data['Name'])?>
                </p>
            </div>
            <?php
                if($reviews->num_rows == 0){
                    echo 
                    '
                    <div class="center-container">
                        <p>Este juego no tiene reseñas aún</p>
                        <a href="index.php">Regresar</a>
                    <div>
                    ';
                }
                else{
                    while ($row = $reviews->fetch_assoc())
                    {
            ?>
                        <div class="review-grid">
                            <div class="review">
                                <div class="top-container">
                                    <div class="username">
                                        <i class="bx bxs-user-circle"></i>
                                        <p><?= htmlspecialchars($row['Username']) ?></p>
                                    </div>
                                    <div class="stars">
            <?php 
                                    $gray_stars = 5 - (int)$row['Rating'];

                                    for($i = 0; $i < $row['Rating']; $i++){
                                        echo '<i class="bx bxs-star yellow-star"></i>';
                                    }
                                    for($i = 0; $i < $gray_stars; $i++){
                                        echo '<i class="bx bxs-star gray-star"></i>';
                                    }
            ?>
                                    </div>
                                </div>
                                
                                <div class="review-text">
                                    <p><?= htmlspecialchars($row['Review']) ?></p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
        </div>
    </body>
</html>