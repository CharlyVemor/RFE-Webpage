<?php
session_start();

include("connection.php");
include("functions.php");
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="shortcut icon" type="x-icon" href="RFG icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>RFE - Contactanos</title>
        <link rel="stylesheet" type="text/css" href="styles/general.css" />
        <link rel="stylesheet" type="text/css" href="styles/header.css" />
        <link rel="stylesheet" type="text/css" href="styles/form.css" />
    </head>
    <body>
        <div class="RFE-header">
            <div class="left-header"></div>
            <a class="no-underline" href="index.php">
                <div class="center-header">
                    <h3>Red Fog Entertainment</h3>
                </div>
            </a>
            <div class="right-header"></div>
        </div>
        <div class="main-page">
            <div class="center-container">
                <div>
                    <p>Envianos un correo desde la dirección de correo con la que registraste tu cuenta</p>
                    <br>
                    <p>Incluyendo tu nombre de usuario como asunto</p>
                    <br>
                    <p><strong>redfogentertainment.help@gmail.com</strong><p>
                    <br>
                    <a href="index.php">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>