<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'database.php';
  $enrollment = $_POST["enrollment"];
  $fullname = $_POST["fullname"];
  $username = $_POST["email"];
  $number = $_POST["number"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $gender = $_POST["gender"];
  $program = $_POST["program"];

  $allowedDomain = "@student.bahria.edu.pk";
  if (strpos($username, $allowedDomain) === false) {
      $showError = "Only offical email addresses from bahria are allowed.";
    // Handle the error or redirect back to login form
  } 
  else {
    // Proceed with login
    // Check user credentials and set session if valid
    // Redirect to the user's dashboard or protected page
      $existSql = "Select * from `students` WHERE email = '$username'";
      $result = mysqli_query($conn, $existSql);
      $numExistRows = mysqli_num_rows($result);
      if($numExistRows > 0){
        $showError = "Email Already Exists";
      }
      else{
          if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_BCRYPT);
              $sql = "INSERT INTO `students` ( `enrollment`, `fullname`, `email`, `number`, `password`, `gender`, `date`,`program`) VALUES ('$enrollment', '$fullname', '$username', '$number', '$hash', '$gender',current_timestamp(),'$program')";
              $result = mysqli_query($conn, $sql);
              if ($result){
                $showAlert = true;
               
              }
            }
          else{
            $showError = "Passwords do not match";
          }
      }
  }




  // $exists=false;
  
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Registration Page </title>
    <link rel="stylesheet" href="assets/css/style-registration.css">
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

    <div class="container" style="margin: top 70px;">
        <div class="title">Registration</div>
        <?php
        if($showAlert){
        echo '<br>
          <div class="alert-success">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
          <strong>Success!</strong> You can log in now.
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
        <div class="content">
            <form action="/Peer Learning Platform/studentportal/student_registration.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="fullname" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Enrollment</span>
                        <input type="text" name="enrollment" placeholder="as given by department" required>

                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="number" placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Program</span>
                        <input type="text" name="program" placeholder="Enter Program/Degree" required>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1">
                    <input type="radio" name="gender" id="dot-2">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Register">
                </div>
                <div class="text sign-up-text">Already have an account? <a href="student_login.php">SignIn Now</a></div>
            </form>
        </div>
    </div>

</body>

</html>