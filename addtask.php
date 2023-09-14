<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager - Add Task</title>
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
<h3 class="text-center mt-2">Add Task</h3>
    <div class="container">
      <?php
        include('config.php');
        if(isset($_POST["addtask"])){
          $taskname = $_POST["taskname"];
          $taskdescription = $_POST["taskdescription"];
          $lists = $_POST["lists"];
          $priority = $_POST["priority"];
          $deadline = $_POST["deadline"];
          $sql = "INSERT INTO `tasks` (`taskname`, `taskdescription`, `listid`, `priority`, `deadline`) VALUES ('$taskname', '$taskdescription', '$lists', '$priority', '$deadline')";
          $result = mysqli_query($conn, $sql);
          if($result){
            echo "<p style='color: green;'>Your task has been added successfully.</p>";
          }else{
            echo "<p style='color: red;'>Your task couldn't added!</p>";
          }
        }
      ?>
        <form method="post">
        <div class="form-group">
            <label for="taskname">Task Name</label>
            <input type="text" class="form-control" id="taskname" name="taskname" placeholder="Enter Task Name" required>
        </div>
        <div class="form-group">
            <label for="taskdescription">Task Description</label>
            <textarea name="taskdescription" id="taskdescription" cols="30" rows="5" placeholder="Enter Task Description" required></textarea>
        </div>
        <div class="form-group">
          <label for="lists">Select List</label><br>
          <select name="lists" id="lists">
            <?php

            include('config.php');
            $sql = "SELECT * FROM manage_lists";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)){
              while($row = mysqli_fetch_assoc($result)){
            ?>
              <option value="<?php echo $row["listid"] ?>"><?php echo $row["listname"] ?></option>
            <?php
              }
              }
            ?>
          </select>
          <div class="form-group">
          <label for="priority">Select Priority</label><br>
          <select name="priority" id="priority">
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
          </select>
          </div>
      </div>
      <div class="form-group">
      <label for="deadline">Deadline</label><br> 
      <input type="date" name="deadline" id="deadline" required>
      </div>
        <button type="submit" name="addtask" class="btn btn-success my-2">Add Task</button>
        </form>
    </div> 
    <?php

include("footer.php");

?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>