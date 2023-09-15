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
    <title>Task Manager - Add List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        textarea{
            width: 100%;
            padding: 5px 10px;
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
          <a class="nav-link active" href="managelist.php">Manage Lists</a>
        </li>
  </ul>
  <div>
        <a class="logout" style="text-decoration: none; color: black;" href="logout.php"><h5>Logout</h5></a>
      </div>
    </div>
  </div>
</nav>
    <div class="container">
        <h3 class="text-center mt-2">Add List</h3>
        <?php
            $userid = $_SESSION["userid"];
            include("config.php");
            if(isset($_POST["addlist"])){
                $listname = $_POST["listname"];
                $listdescription = $_POST["listdescription"];
                if($listname == '' || $listdescription == ''){
                    echo "<p style='color: red;'>You can't leave any input empty!</p>";
                }else{
                    $sql = "INSERT INTO `manage_lists` (`listname`, `listdescription`, `userid`) VALUES ('$listname', '$listdescription', '$userid')";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "<p style='color: green;'>Your list has been added successfully.</p>";
                    }else{
                        echo "<p style='color: red;'>Your list couldn't added!.</p>";
                    }
                }
            }

        ?>
        <div>
        <form method="post">
            <div class="form-group">
                <label for="listname">List Name</label>
                <input type="text" class="form-control" id="listname" placeholder="Enter List Name" name="listname" required>
            </div>
            <div class="form-group">
                <label for="listdescription">List Description</label><br>
                <textarea name="listdescription" id="textdescription" cols="30" rows="10" placeholder="Enter List Description" required></textarea>
            </div>
            <button type="submit" name="addlist" class="btn btn-success">Add List</button>
        </form>
        </div>
    </div>
    <?php

include("footer.php");

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>