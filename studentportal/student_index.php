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
    $program = $_SESSION['program'];
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
    <nav class="sb-topnav navbar navbar-expand " style="background-color: blueviolet;border: 0px solid white; border-radius: 0px;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="teacher_index.html" style="color: white; margin-left: 10px;"><strong><?php echo $fullname; ?></strong></a>
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
                        <a href="../indexQ&A.php?userid=<?php echo $student_id; ?>" style="color: white; padding-left: 30px;">Q&A</a>
                        <a href="viewvideo.html" style="color: white; padding-left: 30px;">Courses</a>



                    </nav>
                </div>
            </div>
        </div>
        <div class="dropdown show" style="margin-right: 30px;">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Notifications
                
                    <?php
                    include 'database.php';
                    $sql_unread = "SELECT COUNT(*) as unread_count FROM `notifications` WHERE `status` = 'unread'";
                    $result_unread = mysqli_query($conn, $sql_unread);
                    $row_unread = mysqli_fetch_assoc($result_unread);
                    $unread_count = $row_unread['unread_count'] ?? 0;
                    ?>

                    <?php if ($unread_count > 0) { ?>
                        <span class="badge badge-light"><?php echo $unread_count; ?></span>
                    <?php } ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php
                    $sql = "SELECT * from `notifications` ORDER BY `notify_id` DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <a  class="dropdown-item" style="<?php if ($row['status'] == 'unread') {
                                            echo "font-weight:bold;";
                                        } ?>" href="../notifyQuestion.php?notifyid=<?php echo $row['notify_id'] ?>">
                                <small><i><?php echo date('F j, Y, g:i a', strtotime($row['date'])) ?></i></small><br />
                                <?php
                                if ($row['type'] == 'comment') {
                                    echo ucfirst($row['name']) . " have commented on your post.";
                                } else if ($row['type'] == 'reply') {
                                    echo ucfirst($row['name']) . " replied on your comment.";
                                }
                                ?>
                            </a>
                            <div class="dropdown-divider"></div>
                    <?php
                        }
                    } else {
                        echo "No Records yet.";
                    }
                    ?>
                </div>
            </div>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group" style="  margin-right: 200px;">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="button" style=" background-color: black; color: white; border: 20px; width: 60px; border-radius: 3px;" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: white;" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link active" style="color: blueviolet;" href="student_index.php">
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
                        <a class="nav-link" href="student_profile.php">
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
                            <h1 class="mt-4">Dashboard</h1>
                        </a>

                    </ol>
                    <div class="dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px;
                    padding: 3px; margin-bottom:50px;">
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Course Section</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="student_index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Course</li>
                            </ol>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="viewcourse.php">
                                        <i class="fas fa-table me-1"></i>
                                        Go To Course Section
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">To Video Section</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="viewvideo.html">Recomended Videos</a></li>
                                <li class="breadcrumb-item active">Latest</li>
                            </ol>

                            <section class="meetings-page" id="meetings">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row grid">
                                                        <?php
                                                        include 'database.php';
                                                        $sql = "SELECT * FROM `video_lectures` where `program`= '$program' ORDER BY video_no DESC";
                                                        $result = mysqli_query($conn, $sql);
                                                        $i = 1;
                                                        while ($row = mysqli_fetch_assoc($result)) {

                                                            $noResult = false;
                                                            $video_no = $row['video_no'];
                                                            $video_name = $row['video_name'];
                                                            $video_desc = $row['desc'];
                                                            $video_program = $row['program'];
                                                            $thumbnail = $row['thumbnail_path'];
                                                            $video_uri = $row['video_uri'];
                                                            $time = $row['uploaded_at'];
                                                            $uploaded_at = date('F j, Y, g:i a', strtotime($time));
                                                            $uploaded_by = $row['uploaded_by'];
                                                            echo '                                   
                                                            <div class="col-lg-3 templatemo-item-col all att ' . $video_program . '">
                                                            <div class="meeting-item" style="height: 500px;">
                                                                <div class="thumb">
                                                                <div class="price">
                                                                    <span>' . $uploaded_at . '</span>
                                                                </div>
                                                                <a href="viewvideo.php?video_no=' . $video_no . '"><img src="assets/images/course-0' . $i . '.jpg" alt=""></a>
                                                                </div>
                                                                <div class="down-content">
                                                                <div class="date">
                                                                    <h6>' . $uploaded_by . '</h6>
                                                                </div>
                                                                <br>
                                                                <a href="viewvideo.php?video_no=' . $video_no . '"><h4>' . $video_name . '</h4></a>
                                                                <p>' . $video_desc . '</p>
                                                                </div>
                                                            </div>
                                                            </div>';
                                                            $i++;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <a href="videoLecture.php">
                                        <i class="fas fa-table me-1"></i>
                                        See More
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

                            <div class="card mb-3">
                                <div class="card-header">
                                    <a href="../indexQ&A.php">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>