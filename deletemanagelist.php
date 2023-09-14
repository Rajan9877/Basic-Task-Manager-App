<?php

$id = $_GET['id'];
$intid = intval($id);
include("config.php");
$sql = "DELETE FROM manage_lists WHERE listid=$intid";
$result = mysqli_query($conn, $sql);
header('Location: managelist.php');

?>