<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "taskmanager";

$conn = mysqli_connect($hostname, $username, $password, $database);

if(!$conn){
    die("Connection Failed! ".mysqli_connect_error());
}

?>