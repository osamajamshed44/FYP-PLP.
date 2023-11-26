<?php
  $login = false;
  $showError = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      include 'database.php';
      $username = $_POST["email"];
      $password = $_POST["password"]; 

      $allowedDomain = "@bahria.edu.pk";
      if (strpos($username, $allowedDomain) === false) {
        $showError = "Only offical email addresses from bahria are allowed.";
        // Handle the error or redirect back to login form
      } 
      else {
        // Proceed with login
        // Check user credentials and set session if valid
        // Redirect to the user's dashboard or protected page
        $sql = "Select * from teachers where email='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1){
          // $row = $result->fetch_assoc();
          // $fullname = $row['fullname'];
          while($row = mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){
              $login = true;
              $fullname = $row['fullname'];
              $teacher_id = $row['teacher_id'];
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['email'] = $username;
              $_SESSION['fullname'] = $fullname;
              $_SESSION['teacher_id'] = $teacher_id;
              $userCategory = 'Teacher'; 
              // Store the user's category in a session variable
              $_SESSION['user_category'] = $userCategory;
              header("location: teacher_index.php");
              }
            else{
              $showError = "Invalid Credentials";
            }
          }
        }
        else{
            $showError = "Invalid Credentials";
        }
      }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <!--<title> Login and Registration Form in HTML & CSS </title>-->
    <link rel="stylesheet" href="assets/css/style_login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <header>
        <div class="textflowforlogin">
            <div class="row">
                <div
                    style="background-color: #fff; color:blueviolet; top: 0px; position: absolute; left: 0px; right: 0px;">
                    <a style="text-decoration:none" href="../index.php">
                        <div style="margin-left: 50px; color: #7d2ae8; text-align: left;">
                            <img src="assets/images/logoside.png"
                                style="width: 400px; align-self: center; padding-top:5px; padding-bottom:0px;"
                                alt="Logo" class="peerlogo">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="assets/images/frontImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Your guidance can shape <br>many futures</span>
                    <span class="text-2">Let's get connected</span>
                </div>
            </div>
            <!-- <div class="back">
        <img class="backImg" src="images/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div> -->
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Sign in</div>
                    <?php
                if($login){
                echo '<br>
                  <div class="alert-success">
                  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                  <strong>Success!</strong> You can log.
                  </div>';
                } 

                if($showError){
                  echo '<br>
                  <div class="alert-error">
                  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                  <strong>Error!</strong> '.$showError.'
                  </div>';
                  } 
            ?>
                    <form method="post" action="teacher_login.php">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="text"><a href="#">Forgot password?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <a
                                    href="teacher_registration.php">SignUp now</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="signup-form">
          <div class="title">Signup</div>
        <form action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Sumbit">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div> -->
            </div>
        </div>
    </div>
</body>

</html>