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
        <title>Dashboard </title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="assets/css/fontawesome.css">
        <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
        <link rel="stylesheet" href="assets/css/owl.css">
        <link rel="stylesheet" href="assets/css/lightbox.css">
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
                        <a href="viewvideo.html" style="color: white; padding-left: 30px;">Video Lecture</a>
                        <a href="../indexQ&A.php?userid=<?php echo $student_id; ?>"
                            style="color: white; padding-left: 30px;">Q&A</a>
                        <a href="viewcourse.html" style="color: white; padding-left: 30px;">Courses</a>
                    </nav>
                </div>
            </div>
        </div>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group" style="  margin-right: 200px;">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="button" style=" background-color: black; color: white; border: 20px; width: 60px; border-radius: 3px;"
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
                        <a class="nav-link" href="student_index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="viewcourse.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            View Check

                        </a>
                        <a class="nav-link" href="viewvideo.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            View Video lecture
                        </a>
                        <a class="nav-link" href="askquestion.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Ask Question
                        </a>

                    </div>
                </div>

            </nav>
        </div>
        <div class="settingsize" id="layoutSidenav_content">
            <main style="margin-right: 30px;">
                <div class="container-fluid px-4" style=" margin: 20px;
            border: 3px solid blueviolet;
            height: 550px;
            border-radius: 20px; font-size: 16px; ">

                    <ol class="breadcrumb mb-4">
                        <a href="student_index.html">
                            <h1 class="mt-4">Dashboard</h1>
                        </a>

                    </ol>
                    <div class="dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px;
                    padding: 3px;">
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Course Section</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="student_index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Course</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="viewcourse.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Course Section
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Video Section</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="viewvideo.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Videos</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="viewvideo.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Video Section
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Ask Queries</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="student_index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Query</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="askquestion.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Q&A Section
                                    </a>
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