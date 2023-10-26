<?php
session_start();

    include("connection.php");
    include("functions.php");

    $Error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];

        //read from database
        $query = "select * from usuarios where Username = '$username' limit 1";
        
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                    
                if($user_data['Password'] === $password)
                {
                    $_SESSION['ID_User'] = $user_data['ID_User'];
                    header("Location: index.php");
                    die;
                }
                else
                {
                    $Error = "Usuario o contraseña incorrecta";
                }
            }
            else
            {
                $Error = "Usuario o contraseña incorrecta";
            } 
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" type="x-icon" href="RFG icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RFE - Inciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="general.css" />
    <link rel="stylesheet" type="text/css" href="header.css" />
    <link rel="stylesheet" type="text/css" href="form.css" />
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
    <div class="form-container">
        <h2 class="form-title">Iniciar Sesión</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <span style="color: red;"><?php echo $Error; ?></span>
            <div class="form-group">
                <button type="submit">Continuar</button>
            </div>
            <p>No estas registrado? <a href="register.php">Registrate</a></p>
        </form>
    </div>
</body>
</html>
