<?php

include("config.php");
$sql = "SELECT * FROM manage_lists";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
    echo json_encode(mysqli_fetch_all($result));
}

?>