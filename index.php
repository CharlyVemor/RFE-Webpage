<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $videogame = display_videogames();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="shortcut icon" type="x-icon" href="RFG icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>RFE - Pagina Principal</title>
        <link rel="stylesheet" type="text/css" href="styles/general.css" />
        <link rel="stylesheet" type="text/css" href="styles/header.css" />
        <link rel="stylesheet" type="text/css" href="styles/videogames.css" />
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
                    <i class='bx bxs-user-circle white'></i>
                </div>
                <a class="no-underline" href="logout.php">&#8594 Cerrar Sesión</a>
            </div>
        </div>
        <div class="main-page">
            <div class="instructions">
                <p>¡Danos tu opinión sobre nuestros juegos!</p>
            </div>
            <div class="videogame-grid">
                <?php
                    while ($row = $videogame->fetch_assoc())
                    {
                ?>
                        <div class="videogame">
                            <div class="videogame-left-container">
                                <i class="bx bxs-game"></i>
                            </div>
                            <div class="videogame-right-container">
                                <div class="videogame-info-container">
                                    <h2><?= htmlspecialchars($row['Name']) ?></h2>
                                    <p><?= htmlspecialchars($row['Description']) ?></p>
                                </div>
                                <div class="button-container">
                <?php
                                    echo
                                    '
                                    <a href="write-review.php?videogame_id='.$row['ID_Vid'].'">
                                        <button class="button-style">Escribir Reseña</button>
                                    </a>
                                    ';
                ?>
                                </div>
                                <div class="button-container">
                <?php
                                    echo 
                                    '
                                    <a href="check-reviews.php?videogame_id='.$row['ID_Vid'].'">
                                        <button class="button-style">Mirar Reseñas</button>
                                    </a>
                                    ';
                ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>