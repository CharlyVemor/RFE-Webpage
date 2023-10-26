<?php
session_start();

if(isset($_SESSION['ID_User']))
{
    unset($_SESSION['ID_User']);
}

header("Location: login.php");
die;