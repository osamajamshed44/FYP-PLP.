<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
            href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
            rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
            crossorigin="anonymous"></script>
            <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php    
echo'
<nav class="sb-topnav navbar navbar-expand navbar bg-primary">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php" style="font-size: 22px;"><strong>'. $fullname.'</strong></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
                id="sidebarToggle" href="#!" style="margin-left: 60px;">
                <i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="container" style="margin-left: 0px;">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav" style="padding-left: 30px">
                            <a href="index.html" class="active"
                                style="color: yellow;">Home</a>
                            <a href="viewcourse.html"
                                style="color: white; padding-left: 30px;">View Course</a>
                            <a href="viewvideo.html" style="padding-left: 30px; color: white;">View Videos</a>
                            <a href="../indexQ&A.php?userid='.$student_id.'" style="padding-left: 30px; color: white;">Ask Question</a>
                        </nav>
                    </div>
                </div>
            </div>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group" style="    margin-right: 200px;"   >
                    <input class="form-control" type="text"
                        placeholder="Search for..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-dark" id="btnNavbarSearch"
                        type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav bg-dark ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown"
                        href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="studentlogout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
';

?>
</body>
</html>