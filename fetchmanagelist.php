<?php
session_start();
$userid = $_SESSION["userid"];
include("config.php");
$sql = "SELECT * FROM manage_lists WHERE userid=$userid";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
    echo json_encode(mysqli_fetch_all($result));
}

?>