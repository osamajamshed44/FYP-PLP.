<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'database.php';
    $username = $_POST["email"];
    $password = $_POST["password"]; 
    
     
    $sql = "Select * from students where email='$username' AND password='$password'";
    // $sql = "Select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
      $row = $result->fetch_assoc();
      $fullname = $row['fullname'];
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $username;
        $_SESSION['fullname'] = $fullname;
        header("location: student_index.php");
      } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="assets/css/style-login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

    <header>
      <div class="textflowforlogin">
        <div class="row">
          <div style="background-color: blueviolet; color: white; top: 0px;
          position: absolute;
          left: 0px;
          right: 0px;">
           <a style="text-decoration:none" href="../index.php" >
            <div style="margin-left: 30px; color: white; text-align: center;" ><h1>
              Bahria University Peer Learning Platform</h1></div>
            </a>
          </div>
        </div>
      </div>
    </header>

    <div class="outerContainer">
      <div class="container">
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

              <form method="post" action="studentlogin.php">
                <div class="input-boxes">
                  <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter your email" required><br>
                  </div>
                  <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your Password" required><br>
                  </div>
                  <div class="text"><a href="#">Forgot password?</a></div>
                  <div class="button input-box">
                    <input type="submit" value="login"name="login"  />
                  </div>
                  <div class="text sign-up-text" style="text-align: left;">Don't have an account? <a
                      href="registration.html">SignUp Now</a>
                  </div>
                </div>
              </form>
              <!-- <?php echo $error; ?> -->
            </div>

          </div>
        </div>
      </div>
    </div>
  </body>

</html>