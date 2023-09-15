<?php

$id = $_GET['id'];
$intid = intval($id);
include("config.php");
$sql = "DELETE FROM tasks WHERE taskid=$intid";
$result = mysqli_query($conn, $sql);
header('Location: welcome.php');

?>