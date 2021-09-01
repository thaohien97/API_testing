<?php 

$server = "10.10.99.xxx";
$username = "root";
$password = "xxxxx";
$database = "xxxxxx";

$conn = mysqli_connect($server, $username, $password, $database);
if(mysqli_connect_error())
{
    echo "Failed to connect: " .mysqli_connect_error();
    exit();
}

