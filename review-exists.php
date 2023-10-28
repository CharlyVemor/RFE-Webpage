<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
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
            <div class="center-container">
                <div>
                    <p>Ya has hecho una reseña de este videojuego</p>
                    <a href="index.php">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>