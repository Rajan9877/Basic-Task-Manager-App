<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    .button-margin {
        margin-left: 2px; /* You can adjust the margin as needed */
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
        <div class="text-center">
            <a href="addtask.php"><button class="mt-2 btn btn-success">Add Task</button></a>
            <a href="managelist.php"><button class="mt-2 btn btn-success">Manage Lists</button></a>
        </div>
    </div>
    <div class="container">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">S No</th>
      <th scope="col">Task Name</th>
      <th scope="col">Priority</th>
      <th scope="col">Deadline</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="tBody">
    <?php  
      
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id = mysqli_real_escape_string($conn, $_GET["id"]); // Sanitize the input
  $sql = "SELECT * FROM tasks WHERE listid='$id'";
} else {
  $sql = "SELECT * FROM tasks";
}

$result = mysqli_query($conn, $sql);

if ($result) {
  if(mysqli_num_rows($result)){
    $i = 1;
    while($row = mysqli_fetch_assoc($result)){

    ?>
   <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["taskname"]; ?></td>
    <td><?php echo $row["priority"]; ?></td>
    <td><?php echo $row["deadline"]; ?></td>
    <td>
    <a href="updatetask.php?id=<?php echo $row["taskid"]; ?>">
        <button type="button" class="btn btn-success btn-sm">Update</button>
    </a>
    <a href="" onclick="confirmDelete(<?php echo $row["taskid"]; ?>);">
        <button type="button" class="btn btn-danger btn-sm button-margin">Delete</button>
    </a>
</td>
   </tr>
  <?php
      }
      $i++;
    }else{

  ?>
  <tr>
    <td></td>
    <td></td>
    <td><p class="text-center"><b>There is no data available right now.</b></p></td>
    <td></td>
    <td></td>
  </tr>
  <?php
    }
  } 
  ?>
  </tbody>
</table>
    </div>
<?php

include("footer.php");

?>
    <script>
      function confirmDelete(taskId) {
          var result = confirm("Are you sure you want to delete this task?");
          if (result) {
              // User clicked "OK", proceed with the deletion
              window.location.href = "deletetask.php?id=" + taskId;
          } else {
              // User clicked "Cancel", do nothing
          }
      }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        function loadData(){
            
            $.ajax({
            type: "GET",
            url: "fetchtask.php",
            success: function(data){
                var dt = JSON.parse(data);
                $('.tBody').html('');
                var i = 1;
                $.each(dt, function(index, taskList) {
                    $('.tBody').append('<tr><th scope="row">'+i+'</th><td>'+taskList[1]+'</td><td>'+taskList[4]+'</td><td>'+taskList[5]+'</td><td><a href="updatetask.php?id='+taskList[0]+'"><button type="button" class="btn btn-success btn-sm">Update</button></a><a href="deletetask.php?id='+taskList[0]+'"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td></tr>');
                    i++;
                });
                }
                });
            }

    loadData();

    </script> -->
  </body>
</html>