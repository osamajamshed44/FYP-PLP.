<?php
session_start();

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//     $fullname = $_SESSION['fullname'];
//     header("location: studentlogin.php");
//     exit;
// }

if (isset($_SESSION['fullname'])) {
    $fullname = $_SESSION['fullname'];
    $userCategory = $_SESSION['user_category'];
    $teacher_id = $_SESSION['teacher_id'];
} else {
    // Redirect to the login page or handle the case where the name is not set
    header("Location: teacher_login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Dashboard Teacher</title>
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
    <nav class="sb-topnav navbar navbar-expand navbar bg-primary">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="indexofteacher.html" style="font-size: 22px;"><strong><?php echo $fullname; ?></strong></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"
            style="margin-left: 60px;"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="container" style="    margin-left: 105px;">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav" style="padding-left: 30px">
                        <a href="indexofadmin.html" class="active" style="color: yellow; padding-left: 30px;">Home</a>
                        <a href="tables ofstudent.html" style="color: white; padding-left: 30px;">Student Area</a>
                        <a href="tablesofteacher.html" style="color: white; padding-left: 30px;">Teacher
                            Area</a>
                        <a href="../Q&A_index.php" style="color: white; padding-left: 30px;">Question</a>
                        <a href="course.html" style="color: white; padding-left: 30px;">Courses</a>
                    </nav>
                </div>
            </div>
        </div>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group" style="margin-right: 200px;">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-dark" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav bg-dark ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="teacherlogout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="indexofteacher.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="course.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Upload Course

                        </a>
                        <a class="nav-link" href="videolecture.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Upload Video lecture
                        </a>
                        <a class="nav-link" href="tables ofstudent.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Table Of Student's
                        </a>
                        <a class="nav-link" href="answer.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Answer Section
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content" style="height: 200px;">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <a href="indexofadmin.html">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </a>

                    </ol>
                    <div class="dashboardwork" style="border-style:outset; border-width: 5px; border-radius: 5px;
                        padding: 3px; margin-bottom:20px;">
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Upload Course</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="indexofteacher.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Course</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="course.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Course Section
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Upload Video</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="indexofteacher.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Videos</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="videolecture.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Video Section
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Check Student's</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="indexofteacher.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Student</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="tables ofstudent.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Table Section
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Give Answer's</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="answer.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Answer</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="answer.html">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Answer Section
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>