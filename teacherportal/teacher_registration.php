<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'database.php';
  $fullname = $_POST["fullname"];
  $username = $_POST["email"];
  $department = $_POST["department"];
  $gender = $_POST["gender"];

  $allowedDomain = "@bahria.edu.pk";
  if (strpos($username, $allowedDomain) === false) {
      $showError = "Only offical email addresses from bahria are allowed.";
    // Handle the error or redirect back to login form
  } 
  else {
    // Proceed with login
    // Check user credentials and set session if valid
    // Redirect to the user's dashboard or protected page
      $existSql = "Select * from `teachers` WHERE email = '$username'";
      $result = mysqli_query($conn, $existSql);
      $numExistRows = mysqli_num_rows($result);
      if($numExistRows > 0){
        $showError = "Email Already Exists";
      }
      else{
        $password = password_generate(9);
            $hash = password_hash($password, PASSWORD_BCRYPT);
              $sql = "INSERT INTO `teachers` (`email`, `password`, `fullname`, `department`, `gender`, `date`) VALUES ('$username', '$hash', '$fullname', '$department', '$gender', current_timestamp());";
              $result = mysqli_query($conn, $sql);
              if ($result){
                $showAlert = true;
                
                $MailHtml = "Your Password for Peer Learning Platform ID is:'. $password .'";
                echo smtp_mailer($username,'User Verification & Password',$MailHtml);
              }
           
      }
  }
 
}

    function password_generate($chars) 
    {
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
    }

    function smtp_mailer($to,$subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "osamajamshed44@gmail.com";
    $mail->Password = "vyfl olpl sbfb uiyf";
    $mail->SetFrom("osamajamshed44@gmail.com");
    $mail->Subject = $subject;
    $mail->Body =$msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if(!$mail->Send()){
        return 0;
    }else{
        return 1;
    }
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

  <div class="container">
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
      <form action="/Peer Learning Platform/teacherportal/teacher_registration.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="fullname" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Department</span>
            <input type="text" name="department" placeholder="Enter your department" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" required>
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
        <div class="text sign-up-text">Already have an account? <a href="teacher_login.php">SignIn Now</a></div>
      </form>
    </div>
  </div>

</body>
</html>