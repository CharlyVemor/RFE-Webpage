<?php
session_start();

    include("connection.php");
    include("functions.php");

    $Error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $username = $con->real_escape_string($_POST['username']);
        $password = $con->real_escape_string($_POST['password']);

        //read from database
        $query = "select * from usuarios where Username = ? limit 1";
        
        $result = $con->execute_query($query, [$username])  /*mysqli_query($con, $query)*/;

        if($result)
        {
            if($result && $result->num_rows/*mysqli_num_rows($result)*/ > 0)
            {
                $user_data = $result->fetch_assoc()/*mysqli_fetch_assoc($result)*/;
                    
                //Compara la contraseña encriptada de la base de datos
                //con la que fue introducida en el inicio de sesión
                if(password_verify($password, $user_data["Password"]))
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
        <div class="center-grid">
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
                    <div class="button-container">
                        <button type="submit">Continuar</button>
                    </div>
                    <div class="register">
                        <p>Olvidaste tu contraseña? <a href="forgot-password.php">Contactanos</a></p>
                    </div>
                    <div class="register">
                        <p>No estas registrado? <a href="register.php">Registrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
