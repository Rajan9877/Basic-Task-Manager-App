<?php
error_reporting(0);
session_start();
if (!isset($_COOKIE['remember_token'])) {
    if (!$_SESSION["name"]) {
        header("Location: login.php");
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager - Manage Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    .button-margin {
        margin-left: 5px; /* You can adjust the margin as needed */
    }
    .btn{
          border-radius: 50px;
    }
    .logout{
      transition: all 0.3s;
    }
    .logout:hover{
      color: red !important;
    }
</style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="welcome.php">Task Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
        </li>
        <?php
$userid = $_SESSION["userid"];
include("config.php");
$sql = "SELECT * FROM manage_lists WHERE userid=$userid";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
  while($row = mysqli_fetch_assoc($result)){
?>
<li class="nav-item">
  <a class="nav-link active" href="welcome.php?id=<?php echo $row["listid"]  ?>"><?php echo $row["listname"]  ?></a>
</li>
<?php
      }
    }
?>
        <li class="nav-item">
          <a class="nav-link active" href="managelist.php">Manage List</a>
        </li>
      </ul>
      <div>
        <a class="logout" style="text-decoration: none; color: black;" href="logout.php"><h5>Logout</h5></a>
      </div>
    </div>
  </div>
</nav>
    <div class="container">
        <h3 class="text-center mt-2">Manage Lists</h3>
        <div>
            <div class="text-center">
                <a href="addlist.php"><button class="mt-2 btn btn-success">Add List</button></a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S No</th>
                        <th scope="col">List Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="tBody">
                    <tr>
                        <td></td>
                        <td><p class="text-center"><b>There is no data available right now.</b></p></td>
                        <td></td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
    <?php

include("footer.php");

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
function loadData() {     
    $.ajax({
        type: "GET",
        url: "fetchmanagelist.php",
        success: function(data) {
            var dt = JSON.parse(data);
            $('.tBody').html('');
            var i = 1;
            $.each(dt, function(index, taskList) {
                var deleteLink = 'deletemanagelist.php?id=' + taskList[0];
                $('.tBody').append('<tr><th scope="row">' + i + '</th><td>' + taskList[1] + '</td><td><a href="updatemanagelist.php?id=' + taskList[0] + '"><button type="button" class="btn btn-success btn-sm">Update</button></a><a href="#" onclick="confirmDelete(' + taskList[0] + ', \'' + deleteLink + '\');"><button type="button" class="btn btn-danger btn-sm button-margin">Delete</button></a></td></tr>');
                i++;
            });
        }
    });
}

function confirmDelete(taskId, deleteLink) {
    var result = confirm("Are you sure you want to delete this list?");
    if (result) {
        // User clicked "OK", proceed with the deletion
        window.location.href = deleteLink;
    } else {
        // User clicked "Cancel", do nothing
    }
}

loadData();
</script>

  </body>
</html>