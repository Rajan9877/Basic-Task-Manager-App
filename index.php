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
    .logout{
      transition: all 0.3s;
    }
    .logout:hover{
      color: green !important;
    }
    .para{
        margin-top: 7px;
        font-weight: bold;
    }
</style>

  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="">Task Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="managelist.php">Manage Lists</a>
        </li>
      </ul>
      <div>
        <a class="logout" style="text-decoration: none; color: black;" href="login.php"><h5>Login</h5></a>
      </div>
    </div>
  </div>
</nav>
    <div class="container">
        <div class="text-center">
            <a href="addtask.php"><button class="mt-2 btn btn-success">Add Task</button></a>
            <a href="managelist.php"><button class="mt-2 btn btn-success">Manage Lists</button></a>
            <p class="para">You need to login first for adding lists and tasks.</p>
        </div>
    </div>
<?php

include("footer.php");

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>