<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet" />
  <title>Login</title>
  <style>
  * {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }

  body {
    animation-name: change;
    animation-duration: 5s;
    animation-iteration-count: infinite;
    animation-fill-mode: both;
  }

  @keyframes change {
    0% {
      background-color: rgb(168, 225, 168); /* Green background */
    }

    25% {
      background-color: rgb(124, 252, 124); /* Green background */
    }

    50% {
      background-color: rgb(104, 255, 104); /* Green background */
    }

    75% {
      background-color: rgb(124, 252, 124); /* Green background */
    }

    100% {
      background-color: rgb(168, 225, 168); /* Green background */
    }
  }

  .container {
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .container form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .container form input {
    padding: 15px;
    font-size: 15px;
    outline: none;
    color: green; /* Green text color */
    width: 250px;
  }

  .container form button {
    padding: 10px 119px;
    background-color: green; /* Green button background */
    border: 2px solid green; /* Green button border */
    color: white;
    font-size: 15px;
    cursor: pointer;
    position: relative;
    bottom: 8px;
    transition: all 0.5s;
  }

  .container form button:hover {
    background-color: transparent;
    color: green; /* Green button text color */
  }

  h1 {
    margin-bottom: 15px;
    font-size: 35px;
    color: green; /* Green header text color */
  }

  .container div {
    margin-top: 5px;
    font-size: small;
  }

  .container div a {
    text-decoration: none;
    color: green; /* Green link color */
    transition: all 0.3s;
  }

  .container div a:hover {
    color: white;
  }

  .red {
    background-color: rgb(248, 225, 225);
    color: red;
    padding: 7px;
  }

  .check input {
    position: relative;
    right: 86px;
    bottom: 20px;
  }

  .check label {
    position: relative;
    right: 200px;
    bottom: 21px;
  }

  .display div {
    position: relative;
    bottom: 42px;
    left: 230px;
    color: rgb(72, 72, 72);
    cursor: pointer;
  }
</style>

</head>

<body>
  <div>
    <?php
    session_start();
    include("dbconnect.php");
    if (isset($_POST["login"])) {
      $remember = $_POST["remember"];
      $username = $_POST["username"];
      $password = $_POST["password"];
      if ($remember == "on") {
        $cookiename = 'remember_token';
        $token = bin2hex(random_bytes(16));
        setcookie($cookiename, $token, time() + (86400 * 30), "/");
        setcookie("name", $username, time() + (86400 * 30), "/");
        setcookie("password", $password, time() + (86400 * 30), "/");
      }
      $sql1 = "SELECT * FROM `signup` WHERE username = '$username'";
      $result1 = mysqli_query($conn, $sql1);
      $_SESSION["name"] = $username;
      $_SESSION["password"] = $password;
      if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
          if ($password == $row["conpassword"]) {
            $_SESSION["userid"] = $row["sno"];
            header("Location: welcome.php");
          } else {
            echo ("<div class='red'>Password did't match with username!</div>");
          }
        }
      } else {
        echo ("<div class='red'>Invalid Credentials!</div>");
      }
    }
    ?>
  </div>
  <div class="container">
    <form action="" method="post" autocomplete="off">
      <h1>Login</h1>
      <input type="text" name="username" placeholder="Username" required />
      <div class="display">
        <input type="password" name="password" id="pass" placeholder="Password" required />
        <div id="show">SHOW</div>
      </div>
      <div class="check">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>
      </div>
      <button name="login">Login</button>
    </form>
    <div>Create New Acccount &rarr; <a href="signup.php">Sign Up</a></div>
  </div>
  <script>
    let content = document.getElementById("show");
    let pass = document.getElementById("pass");
    content.addEventListener("click", display);
    function display(){
    if (content.innerHTML === "SHOW") {
        content.innerHTML = "HIDE";
        pass.type = "text";
      }else{
        content.innerHTML = "SHOW";
        pass.type = "password";
      }
}
  </script>
</body>

</html>