<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager - Manage Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        textarea{
            width: 100%;
            padding: 5px 10px;
        }
        .btn{
          border-radius: 50px;
        }
    </style>
  </head>
  <body>
  
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Task Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php

include("config.php");
$sql = "SELECT * FROM manage_lists";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)){
  while($row = mysqli_fetch_assoc($result)){
?>
<li class="nav-item">
  <a class="nav-link active" href="index.php?id=<?php echo $row["listid"]  ?>"><?php echo $row["listname"]  ?></a>
</li>
<?php
      }
    }
?>
        <li class="nav-item">
          <a class="nav-link active" href="managelist.php">Manage Lists</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
        <h3 class="text-center mt-2">Update List</h3>
        <?php
$id = $_GET['id'];
$intid = intval($id);
include("config.php");

if(isset($_POST["updatelist"])){
    $updatelistname = $_POST["updatelistname"];
    $updatelistdescription = $_POST["updatelistdescription"];

    if($updatelistname == '' || $updatelistdescription == ''){
        echo "<p style='color: red;'>You can't leave any input empty!</p>";
    }else{
        // Use prepared statements to prevent SQL injection
        $sql = "UPDATE manage_lists
                SET listname = ?, listdescription = ?
                WHERE listid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $updatelistname, $updatelistdescription, $intid);
            $result = mysqli_stmt_execute($stmt);
            
            if($result){
                echo "<p style='color: green;'>Your list has been updated successfully.</p>";
            }else{
                echo "<p style='color: red;'>Your list couldn't be updated!</p>";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "<p style='color: red;'>Error in preparing the SQL statement.</p>";
        }
    }
}
?>

        <div>
        <?php
        
        include("config.php");
        $sql= "SELECT * FROM manage_lists WHERE listid='$id'";  
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){

        ?>
        <form method="post">
            <div class="form-group">
                <label for="listname">List Name</label>
                <input type="text" class="form-control" id="listname" placeholder="Enter List Name" name="updatelistname" value="<?php echo $row["listname"];  ?>" required>
            </div>
            <div class="form-group">
                <label for="listdescription">List Description</label><br>
                <textarea name="updatelistdescription" id="listdescription" cols="30" rows="10" placeholder="Enter List Description" required><?php echo $row["listdescription"];  ?></textarea>
            </div>
            <button type="submit" name="updatelist" class="btn btn-success">Update List</button>
        </form>
        <?php
                 }
                }
        ?>
        </div>
    </div>
    <?php

include("footer.php");

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>