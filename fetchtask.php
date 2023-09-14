<?php
header('Content-Type: application/json'); // Set JSON response header

include('config.php');

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]); // Sanitize the input
    $sql = "SELECT * FROM tasks WHERE listid='$id'";
} else {
    $sql = "SELECT * FROM tasks";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    $data = mysqli_fetch_all($result);
    echo json_encode($data); // Return the JSON-encoded data
} 
?>
