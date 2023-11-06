<?php
session_start();

    include("connection.php");
    include("functions.php");

    $Error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $username = $con->real_escape_string($_POST['username']);
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
        $confirmpass = $con->real_escape_string($_POST['confirm-password']);

        $valid_form = true;
        
        if (strlen($username) < 5)
        {
            $valid_form = false;
            $Error = "El nombre de usuario debe contener al menos 5 caracteres";
        }

        if ($valid_form && strlen($username) > 50)
        {
            $valid_form = false;
            $Error = "El nombre de usuario es muy largo";
        }

        if ($valid_form && preg_match('/[!@#$%^&*(),.?":{}|<>]/', $username)) {
            $valid_form = false;
            $Error = "El nombre de usuario no puede contener caracteres especiales";
        }

        if ($valid_form && is_numeric($username))
        {
            $valid_form = false;
            $Error = "El nombre de usuario no puede ser numerico";
        }

        if ($valid_form && strlen($password) < 7)
        {
            $valid_form = false;
            $Error = "La contraseña debe contener al menos 7 caracteres";
        }

        if ($valid_form && strlen($password) > 50)
        {
            $valid_form = false;
            $Error = "La contraseña es muy larga";
        }

        if ($valid_form && !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $valid_form = false;
            $Error = "La contraseña debe contener al menos 1 caracter especial";
        }

        if($valid_form && !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $valid_form = false;
            $Error = "El correo es invalido";
        }

        if($valid_form && $password !== $confirmpass)
        {
            $valid_form = false;
            $Error = "La contraseña no fue confirmada correctamente, vuelva a escribirla";
        }

        if($valid_form)
        {
            //checar si existe el usuario
            $query = "select * from usuarios where Username = ? limit 1";
            $result = $con->execute_query($query, [$username]);
            if($result)
            {
                if($result && $result->num_rows > 0)
                {
                    $valid_form = false;
                    $Error = "Usuario ya existe";
                }
            }
        }

        if ($valid_form)
        {   
            //Utiliza un algoritmo hash para proteger la contraseña
            //y sea dificil de desencriptar
            $password = password_hash($password, PASSWORD_DEFAULT);

            //save to database
            $query = "insert into usuarios (Email,Username,Password) values (?,?,?)";
        
            $con->execute_query($query, [$email,$username,$password]);
            header("Location: login.php");
            die;
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
    <title>RFE - Registrar Usuario</title>
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
        <div class ="center-grid">
            <div class="form-container">
                <h2 class="form-title">Registrar Usuario</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Contraseña</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <span style="color: red"><?php echo $Error; ?></span>
                    <div class="button-container">
                        <button type="submit">Continuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
