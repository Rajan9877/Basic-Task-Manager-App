<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager - Update Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        textarea{
            width: 100%;
            padding: 5px 10px;
        }
        select{
          width: 100%;
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
<h3 class="text-center mt-2">Update Task</h3>
    <div class="container">
    <?php
include('config.php');
$id = $_GET['id'];
$intid = intval($id);

if (isset($_POST["updatetask"])) {
    $updatetaskname = $_POST["updatetaskname"];
    $updatetaskdescription = $_POST["updatetaskdescription"];
    $updatelists = $_POST["updatelists"];
    $updatepriority = $_POST["updatepriority"];
    $updatedeadline = $_POST["updatedeadline"];

    // Use prepared statement to update the task
    $sql = "UPDATE tasks
            SET taskname = ?, taskdescription = ?, listid = ?, priority = ?, deadline = ?
            WHERE taskid = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssisi", $updatetaskname, $updatetaskdescription, $updatelists, $updatepriority, $updatedeadline, $intid);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<p style='color: green;'>Your task has been updated successfully.</p>";
        } else {
            echo "<p style='color: red;'>Your task couldn't be updated!</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p style='color: red;'>Failed to prepare the SQL statement.</p>";
    }
}
?>

       <form method="post">
    <?php
    $sql = "SELECT * FROM tasks WHERE taskid='$intid'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <div class="form-group">
        <label for="updatetaskname">Task Name</label>
        <input type="text" class="form-control" id="updatetaskname" name="updatetaskname" placeholder="Enter Task Name" value="<?php echo $row["taskname"]; ?>" required>
    </div>
    <div class="form-group">
        <label for="updatetaskdescription">Task Description</label>
        <textarea name="updatetaskdescription" id="updatetaskdescription" cols="30" rows="5" placeholder="Enter Task Description" required><?php echo $row["taskdescription"]; ?></textarea>
    </div>
    <div class="form-group">
        <label for="updatelists">Select List</label><br>
        <select name="updatelists" id="updatelists">
            <?php
            include('config.php');
            $sql = "SELECT * FROM manage_lists";
            $listResult = mysqli_query($conn, $sql);
            if(mysqli_num_rows($listResult)){
                while($listRow = mysqli_fetch_assoc($listResult)){
                    $selected = ($listRow["listid"] == $row["listid"]) ? "selected" : "";
            ?>
            <option value="<?php echo $listRow["listid"]; ?>" <?php echo $selected; ?>><?php echo $listRow["listname"]; ?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="updatepriority">Select Priority</label><br>
        <select name="updatepriority" id="updatepriority">
            <option value="High" <?php echo ($row["priority"] == "High") ? "selected" : ""; ?>>High</option>
            <option value="Medium" <?php echo ($row["priority"] == "Medium") ? "selected" : ""; ?>>Medium</option>
            <option value="Low" <?php echo ($row["priority"] == "Low") ? "selected" : ""; ?>>Low</option>
        </select>
    </div>
    <div class="form-group">
        <label for="updatedeadline">Deadline</label><br> 
        <input type="date" name="updatedeadline" id="updatedeadline" value="<?php echo $row["deadline"]; ?>" required>
    </div>
    <?php
        }
    }
    ?>
    <button type="submit" name="updatetask" class="btn btn-success my-2">Update Task</button>
</form>
    </div>  
    <?php

include("footer.php");

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>