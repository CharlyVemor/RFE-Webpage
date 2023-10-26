<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "rfe";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Failed to sign in");
}
?>