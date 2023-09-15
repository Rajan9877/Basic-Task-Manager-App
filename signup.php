<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Sign Up</title>
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
    width: 274px;
  }

  .container form button {
    margin-top: 15px;
    padding: 10px 122px;
    background-color: green; /* Green button background */
    border: 2px solid green; /* Green button border */
    color: white;
    font-size: 15px;
    cursor: pointer;
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

  .container form div {
    margin-top: 5px;
    font-size: small;
  }

  .container form div span a {
    text-decoration: none;
    color: green; /* Green link color */
    transition: all 0.3s;
  }

  .container form div span a:hover {
    color: white;
  }

  .green {
    background-color: rgb(225, 248, 225); /* Green background */
    color: green; /* Green text color */
    padding: 7px;
  }

  .red {
    background-color: rgb(248, 225, 225); /* Red background */
    color: red; /* Red text color */
    padding: 7px;
  }
</style>

  </head>
  <body>
    <div>
    <?php
session_start();
include("dbconnect.php");

// Verify the CAPTCHA response
if (isset($_POST["signup"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $newpassword = $_POST["newpassword"];
  $conpassword = $_POST["conpassword"];
  // $captchaResponse = $_POST['g-recaptcha-response'];

  // Verify the CAPTCHA response with the reCAPTCHA API
  // $secretKey = '6LcT5kMmAAAAAKm75uJ7GEEk_2P1t3RB5tLtS5d-';
  // $url = 'https://www.google.com/recaptcha/api/siteverify';

  // $data = array(
  //   'secret' => $secretKey,
  //   'response' => $captchaResponse,
  // );

  // $options = array(
  //   'http' => array(
  //     'header' => "Content-type: application/x-www-form-urlencoded\r\n",
  //     'method' => 'POST',
  //     'content' => http_build_query($data),
  //   ),
  // );

  // $context = stream_context_create($options);
  // $response = file_get_contents($url, false, $context);
  // $responseData = json_decode($response, true);

  // Proceed with form processing only if CAPTCHA response is verified
  // if ($responseData && $responseData['success']) {
    $sql1 = "SELECT * FROM `signup` WHERE username = '$username'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
      echo ("<div class='red'>Username already exists!</div>");
    } else {
      if ($newpassword == $conpassword) {
        $sql2 = "INSERT INTO `signup` ( `name`, `email`, `username`, `conpassword`) VALUES ('$name', '$email', '$username', '$conpassword')";
        mysqli_query($conn, $sql2);
        echo ("<div class='green'>You are successfully signed up!</div>");
      } else {
        echo ("<div class='red'>Passwords didn't match!</div>");
      }
    }
  }
//    else {
//     echo ("<div class='red'>CAPTCHA verification failed!</div>");
//   }
// }
?>
    </div>
    <div class="container">
      <form action="" method="post" autocomplete="off">
        <h1>Sign Up</h1>
        <input type="text" name="name" placeholder="Your Name" required/>
        <input type="email" name="email" placeholder="Your Email" required/>
        <input type="text" name="username" placeholder="Username" required/>
        <input type="password" name="newpassword" placeholder="New Password" required/>
        <input type="password" name="conpassword" placeholder="Confirm Password" required/>
        <!-- <div class="g-recaptcha" data-sitekey="6LcT5kMmAAAAAKm75uJ7GEEk_2P1t3RB5tLtS5d-"></div> -->
        <div>Already have an account? <span><a href="login.php">Login</a></span></div>
        <button name="signup">Sign Up</button>
      </form>
    </div>
  </body>
</html>
