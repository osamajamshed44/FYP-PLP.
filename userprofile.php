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
    header("Location: users_sign_in_out_page.php");
    exit();
}
include 'database.php';

    if (isset($_GET['userid']) && isset($_GET['category'])) {
        $profileid = $_GET['userid'];
        $profilecategory = $_GET['category'];


        if ($profilecategory == 'students') {
            $sql = "SELECT * FROM `students` WHERE student_id = '$profileid'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['fullname'];
                $email = $row['email'];
                $number = $row['number']; 
                $gender = $row['gender'];
                $enrollment = $row['enrollment'];
                $program = $row['program'];
            }
        } elseif ($profilecategory == 'teachers') {
            $sql = "SELECT * FROM `teachers` WHERE teacher_id = '$profileid'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['fullname'];
                $email = $row['email'];
                $department = $row['department']; 
                $gender = $row['gender'];
            }
        } elseif ($profilecategory == 'alumni') {
            $sql = "SELECT * FROM `alumni` WHERE alumni_id = '$profileid'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['fullname'];
                $email = $row['email'];
                $department = $row['department']; 
                $gender = $row['gender'];
                $batch = $row['Batch Year'];
            }
        }
        


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
        <title>User Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="studentportal/assets/css/fontawesome.css">
        <link rel="stylesheet" href="studentportal/assets/css/templatemo-edu-meeting.css">
        <link rel="stylesheet" href="studentportal/assets/css/owl.css">
        <link rel="stylesheet" href="studentportal/assets/css/lightbox.css">
        <link rel="stylesheet" href="studentportal/assets/css/user_profile.css">
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
        
        <div class="settingsize" id="layoutSidenav_content">
            <main style="margin-right: 30px;">
                <div class="container-fluid px-4" style=" margin: 20px;
                border: 3px solid blueviolet;
                height: auto;
                border-radius: 20px; font-size: 16px; ">

                    <ol class="breadcrumb mb-4">
                        <a href="student_index.html">
                            <h1 class="mt-4">User Profile</h1>
                        </a>

                    </ol>
                    <div class="dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px;
                    padding: 3px; padding-bottom:20px; margin-bottom: 20px;">


                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card" style="padding: 30px;">
                                    <h5><em><?php echo strtoupper($profilecategory)?></em></h5>
                                        <div class="profile-picture">
                                            <img src="assets/images/user_default.png" alt="Profile Picture">
                                        </div>
                                        
                                        <div class="card-body">
                                        
                                            <h5 class="card-title"><?php echo $name;?></h5>
                                            <p class="card-text" style="white-space: nowrap;">Email:
                                                <strong><?php echo $email;?></strong>
                                            </p>
                                            <?php
                                            if($profilecategory == 'students'){
                                                echo' <p class="card-text">Enrollment: <strong>'.$enrollment.'</strong>
                                                </p>';
                                            }
                                            elseif($profilecategory == 'teachers'){
                                                echo' <p class="card-text">Department: <strong>'.$department.'</strong>
                                                </p>';
                                            }
                                            elseif($profilecategory == 'alumni'){
                                                echo' <p class="card-text">Department: <strong>'.$department.'</strong>
                                                </p>';
                                            }
                                            ?>
                                            <?php
                                            if($profilecategory == 'students'){
                                                echo' <p class="card-text">Program: <strong>'.$program.'</strong></p>';
                                            }
                                            elseif($profilecategory == 'alumni'){
                                                echo'  <p class="card-text">Batch Year: <strong>'.$batch.'</strong></p>';
                                            }
                                            ?>
                                            
                                           
                                            <p class="card-text">Gender: <strong><?php echo $gender;?></strong></p>
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Profile View Permissions: </h4>
                                    <p>By clicking the 'Connect' button below, you'll gain access to view the profile details of the selected user. This includes information such as their name, contact details, and professional background. Connecting with other users enables you to engage, share knowledge, and collaborate effectively within our platform</p>
                                    <br>
                                    <button class="btn btn-primary" onclick="openTeams()">Connect on Microsoft Teams</button>
                                </div>
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
    <script>
        function openTeams() {
            // Replace 'user_email' with the actual user's Microsoft email
            var user_email = '<?php echo $email?>';

            // Use the user's email to construct the Microsoft Teams deep link
            var teamsLink = 'https://teams.microsoft.com/l/chat/0/0?users=' + user_email;

            // Open the Microsoft Teams link in a new tab/window
            window.open(teamsLink);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="studentportal/assets/demo/chart-area-demo.js"></script>
    <script src="studentportal/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>