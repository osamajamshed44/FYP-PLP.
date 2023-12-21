<?php
session_start();

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
// $fullname = $_SESSION['fullname'];
// header("location: studentlogin.php");
// exit;
// }

if (isset($_SESSION['fullname'])) {
    $fullname = $_SESSION['fullname'];
    $userCategory = $_SESSION['user_category'];
    $student_id = $_SESSION['student_id'];

} else {
    // Redirect to the login page or handle the case where the name is not set
    header("Location: student_login.php");
    exit();
}
include 'database.php';
$showError = false;
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update_username"])) {
        // Code to update username
        $fullname = $_POST["fullname"];
        $number = $_POST["number"];
        $student_id = $_POST["student_id"];
        $sql = "UPDATE `students` SET `fullname` = '$fullname', `number` = '$number' WHERE `students`.`student_id` = '$student_id'";
              $result = mysqli_query($conn, $sql);
              if ($result){
                $showAlert = "Username has been updated.";
              }
                else{
                    $showError = "Username does not change";
                }
    } elseif (isset($_POST["update_password"])) {
        // Code to update password
        $current_password = $_POST["current_password"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $student_id = $_POST["student_id"];
       
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "SELECT * FROM `students` WHERE `student_id` = $student_id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $passhash = $row['password'];
            if(password_verify($current_password, $passhash)){
              $sql = "UPDATE `students` SET `password` = '$hash' WHERE `students`.`student_id` = '$student_id'";
              $result = mysqli_query($conn, $sql);
              if ($result){
                $showAlert = "Password has been updated.";

              }
            }
            else{
                $showError = "Current Password is incorrect.";
            }
        }
          else{
            $showError = "Passwords do not match";
          }
        
    } elseif (isset($_POST["update_profile_picture"])) {
        // Code to update profile picture
    }
}

include 'database.php';
$sql = "SELECT * FROM `students` WHERE student_id = '$student_id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        
        $name = $row['fullname'];
        $email = $row['email'];
        $number = $row['number']; 
        $gender = $row['gender'];
        $enrollment = $row['enrollment'];
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <style>
        ::-webkit-scrollbar {
            background: white;
            width: 0;
        }
        </style>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>My Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="assets/css/fontawesome.css">
        <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
        <link rel="stylesheet" href="assets/css/owl.css">
        <link rel="stylesheet" href="assets/css/lightbox.css">
        <link rel="stylesheet" href="assets/css/user_profile.css">
    </head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand "
        style="background-color: blueviolet;border: 0px solid white; border-radius: 0px;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="teacher_index.html"
            style="color: white; margin-left: 10px;"><strong><?php echo $fullname;?></strong></a>
        <!-- Sidebar Toggle-->
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"
            style="margin-left: 40px; color: white;"><i class="fas fa-bars"></i></button> -->
        <!-- Navbar Search-->
        <div class="container" style=" margin-left: 40px;">
            <div class="row">
                <div class style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <nav class="main-nav">
                        <a href="teacher_index.html" class="active" style="color: yellow;">Home</a>
                        <a href="videoLecture.php" style="color: white; padding-left: 30px;">Video Lecture</a>
                        <a href="../indexQ&A.php?userid=<?php echo $student_id; ?>"
                            style="color: white; padding-left: 30px;">Q&A</a>
                        <a href="viewvideo.html" style="color: white; padding-left: 30px;">Courses</a>
                    </nav>
                </div>
            </div>
        </div>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group" style="  margin-right: 200px;">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="button"
                    style=" background-color: black; color: white; border: 20px; width: 60px; border-radius: 3px;"
                    id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: white;" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="studentlogout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion " id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="    margin: 20px;
                    border: 3px solid blueviolet;
                    border-style: outset;
                    border-radius: 20px;">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link " href="student_index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="viewvideo.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            View Check

                        </a>
                        <a class="nav-link" href="videoLecture.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            View Video lecture
                        </a>
                        <a class="nav-link" href="../indexQ&A.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Ask Question
                        </a>
                        <div class="sb-sidenav-menu-heading">Manage</div>
                        <a class="nav-link active" style="color: blueviolet;" href="student_profile.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            My profile
                        </a>

                    </div>
                </div>

            </nav>
        </div>
        <div class="settingsize" id="layoutSidenav_content">
            <main style="margin-right: 30px;">
                <div class="container-fluid px-4" style=" margin: 20px;
                border: 3px solid blueviolet;
                height: auto;
                border-radius: 20px; font-size: 16px; ">

                    <ol class="breadcrumb mb-4">
                        <a href="student_index.html">
                            <h1 class="mt-4">My Profile</h1>
                        </a>

                    </ol>
                    <div class="dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px;
                    padding: 3px; padding-bottom:20px; margin-bottom: 20px;">


                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card" style="padding: 30px;">
                                        <div class="profile-picture">
                                            <img src="assets/images/user_default.png" alt="Profile Picture">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $name;?></h5>
                                            <p class="card-text" style="white-space: nowrap;">Email:
                                                <strong><?php echo $email;?></strong>
                                            </p>
                                            <p class="card-text">Enrollment: <strong><?php echo $enrollment;?></strong>
                                            </p>
                                            <p class="card-text">Phone: <strong><?php echo $number;?></strong></p>
                                            <p class="card-text">Gender: <strong><?php echo $gender;?></strong></p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h2>Edit Profile</h2>
                                    <?php
                                    if($showAlert){
                                        echo '
                                          <div class="alert alert-success">
                                          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                                          <strong>Success!</strong> '.$showAlert.'
                                          </div>';
                                        } 
                                     if($showError){
                                        echo '<br>
                                        <div class="alert alert-error">
                                        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                                        <strong>Error!</strong> '.$showError.'
                                        </div>';
                                        } 
                                    ?>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="mb-3">
                                            <label for="fullname" class="form-label">Fullname</label>
                                            <input type="hidden" class="form-control" value="<?php echo $student_id?>"
                                                id="student_id" name="student_id">
                                            <input type="text" class="form-control" id="fullname" name="fullname"
                                                placeholder="Full Name">
                                                <br>
                                            <input type="text" class="form-control" id="number" name="number"
                                                placeholder="Number">
                                        </div>
                                        <button type="submit" name="update_username" class="btn btn-primary">Update Username</button>
                                    </form> 
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">   
                                        <div class="mb-3">
                                        <br>
                                            <input type="hidden" class="form-control" value="<?php echo $student_id?>"
                                                id="student_id" name="student_id">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="password" name="current_password"
                                                placeholder="Current Password">
                                            <br>  
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="New Password">
                                            <br>
                                            <input type="password" class="form-control" id="cpassword" name="cpassword"
                                                placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
                                    </form>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">    
                                        <div class="mb-3">
                                            <br>
                                            <label for="profilePicture" class="form-label">Profile Picture</label>
                                            <input type="file" class="form-control" id="profilePicture"
                                                name="profilePicture">
                                        </div>
                                        <button type="submit" name="update_profile_picture" class="btn btn-primary">Update Profile Picture</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Peer Learning Platform</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>