<?php
session_start();

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
$video_id = $_GET['video_no'];
$sql = "SELECT * FROM `video_lectures` where video_no = $video_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $noResult = false;
    $video_name = $row['video_name'];
    $video_desc = $row['desc'];
    $video_program = $row['program'];
    $thumbnail = $row['thumbnail_path'];
    $video_uri = $row['video_uri'];
    $time = $row['uploaded_at'];
    $uploaded_by = $row['uploaded_by'];;
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
        <title>Video Lectures</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="assets/css/fontawesome.css">
        <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
        <link rel="stylesheet" href="assets/css/owl.css">
        <link rel="stylesheet" href="assets/css/lightbox.css">
    </head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand " style="background-color: blueviolet;border: 0px solid white; border-radius: 0px;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="student_index.php" style="color: white; margin-left: 10px;"><strong><?php echo $fullname; ?></strong></a>
        <!-- Sidebar Toggle-->
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"
            style="margin-left: 40px; color: white;"><i class="fas fa-bars"></i></button> -->
        <!-- Navbar Search-->
        <div class="container" style=" margin-left: 40px;">
            <div class="row">
                <div class style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <nav class="main-nav">
                        <a href="student_index.php" style="color: white; padding-left: 30px;">Home</a>
                        <a href="viewvideo.html" style="color: white; padding-left: 30px;">Video Lecture</a>
                        <a href="../indexQ&A.php?userid=<?php echo $student_id; ?>" style="color: white; padding-left: 30px;">Q&A</a>
                        <a href="courses.php" class="active" style="color: yellow; padding-left: 30px;">Courses</a>
                    </nav>
                </div>
            </div>
        </div>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group" style="  margin-right: 8px; width: 300px;">
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
                        <a class="nav-link" href="student_index.php">
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
                        <a class="nav-link" href="../indexQ&A.php">
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
                    height: auto;
                    padding-bottom: 50px;
                    border-radius: 20px; font-size: 16px; ">

                    <ol class="mb-4">
                        <a href="student_index.html">
                            <h1 class="mt-4"><?php echo $video_name; ?></h1>
                        </a>

                    </ol>
                    <div class="dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px;
                        padding: 3px;">

                        <div class="container mt-5">
                            <div class="row dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px; padding: 10px;">
                                <div class="col-md-9">
                                    <!-- Video Player -->
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe src="https://player.vimeo.com/video/<?php echo $video_uri; ?>?badge=0&amp;autopause=0&amp;quality_selector=1&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%; border-radius: 15px;" title="<?php echo $video_name; ?>">
                                        </iframe>
                                    </div>
                                    <script src="https://player.vimeo.com/api/player.js"></script>
                                </div>
                                <div class="col-md-3" style="margin-top: 50px;">
                                    <!-- Video Details -->
                                    <br>
                                    <h3 style="color: blueviolet;"><strong><?php echo $video_name; ?></strong></h3><br>
                                    <h1><strong>Uploaded by:<br></strong> <?php echo $uploaded_by; ?></h1><br>
                                    <h1><strong>Description:</strong> <br> <?php echo $video_desc; ?></h1>
                                    <br>
                                </div>
                            </div>
                            <br>
                            <!-- Embedded PDF Viewer for Reading Material -->
                            <h3>Related Reading Material</h3>
                            <br>
                            <div style="border: 1px solid; margin-bottom:10px; ">
                                <iframe src="https://docs.google.com/document/d/e/2PACX-1vS-0KNCT_kPn3nCpXsYMZXBPssTstRGlxpjHiS6sd9bJ3drPLFBCijtFFDfUzjRjAF2hFOVyns2UrqM/pub?embedded=true" style="width:100%; height:500px; " frameborder="0"></iframe>
                                <!-- <embed src="" type="application/pdf" width="100%" height="500px"> -->
                            </div>

                        </div>
                        <br>
                        <br>
                        <h3 style="margin-left: 50px;">Comments</h3>
                        <!-- Comment Section -->
                        <div class="dashboardwork" style="border: 1px solid blueviolet;  border-radius: 20px; padding: 10px; margin:40px;">
                            <div class="container" style="margin:20px;">
                                <form class="mt-3 comment-form" action="post_vcomment.php" method="post">
                                    <input type="hidden" name="video_no" value="<?php echo $video_id; ?>">
                                    <div class="row">
                                        <div class="mb-3 col-md-auto">
                                            <img src="assets/images/user_default.png" alt="Profile Picture" class="rounded-circle" style="width: 60px; height: 60px;">
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-8">
                                                    <textarea class="form-control" id="commentInput" name="comment_desc" placeholder="Write your comment..." rows="1"></textarea>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-primary btn">Submit</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="container mt-4">
                                <?php
                                include 'database.php';
                                // $userid = $_GET['userid'];
                                // $user_id = $_GET['student_id'];
                                // $sql = "SELECT * FROM `questions` WHERE category_id=$cat_id"; 
                                $sql = "SELECT * FROM `video_comments` Where video_no = $video_id ORDER BY vcomment_id DESC";
                                $result = mysqli_query($conn, $sql);
                                $noResult = true;
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $noResult = false;
                                    $cid = $row['vcomment_id'];
                                    $vcomment_by = $row['vcomment_by'];
                                    $desc = $row['vcomment_des'];
                                    $vcomment_time = $row['vcomment_time'];

                                    echo '
                                    <div class="mb-3" style="margin:20px;">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-auto">
                                                <img src="assets/images/user_default.png" alt="Profile Picture" class="rounded-circle" style="width: 60px; height: 60px;">
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-8">
                                                    <h5 class="">' . $vcomment_by . '</h5>
                                                    </div>
                                                    <div class="col-4" style="color:grey; font-size:12px;">
                                                    ' . $vcomment_time . '
                                                    </div>
                                                </div>
                                                
                                                <p>' . $desc . '</p>
                                            </div>
                                        </div>       
                                            <button class="btn btn-sm btn-dark reply-btn">Reply</button>
                                        
                                            <!-- Reply form (initially hidden) -->
                                            <form class="mt-3 reply-form" style="display: none;" action="post_vreply.php" method="post">
                                                <input type="hidden" name="video_no" value="' . $video_id . '">
                                                <input type="hidden" name="comment_id" value="' . $cid . '">
                                                <label for="replyInput" class="form-label">Your Reply</label>
                                                <div class="row">
                                                    <div class="mb-3 col-8">

                                                        <textarea class="form-control" id="replyInput"  name="reply_desc" placeholder="Write your reply..." rows="1"></textarea>
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="submit" class="btn btn-primary btn">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Previous replies -->
                                            <button class="btn btn-info btn-sm dropdown-toggle prev-replies-btn">Previous Replies</button>
                                            ';
                                    $sql1 = "SELECT * FROM `video_replies` Where vcomment_id = $cid  AND video_no = $video_id ORDER BY vreply_no DESC";
                                    $result1 = mysqli_query($conn, $sql1);

                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                        $replyid = $row1['vreply_no'];
                                        $vreply_by = $row1['vreply_by'];
                                        $reply_desc = $row1['vreply_desc'];
                                        $vreply_time = $row1['vreply_time'];

                                        echo '
                                                                
                                                                
                                                                    <!-- Previous replies content -->
                                                                    <div class="mt-3 prev-replies" style="display: none;">
                                                                        <div class="mb-3" style="margin-left: 50px;">
                                                                            <div class="row d-flex align-items-center">
                                                                                <div class="col-md-auto">
                                                                                    <img src="assets/images/user_default.png" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px;">
                                                                                </div>
                                                                                <div class="col">
                                                                                    <h6 class="">' . $vreply_by . '</h6>
                                                                                    <p>' . $reply_desc . '</p>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>    
                                                                    <!-- More previous replies can go here -->
                                                                ';
                                    }
                                    echo '</div>';
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>



        <!-- </div>
    </div> -->
    
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

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reply button functionality
            const replyBtns = document.querySelectorAll('.reply-btn');
            replyBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const replyForm = this.nextElementSibling;
                    replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
                });
            });

            // Previous replies button functionality
            const prevRepliesBtns = document.querySelectorAll('.prev-replies-btn');
            prevRepliesBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const prevReplies = this.nextElementSibling;
                    prevReplies.style.display = prevReplies.style.display === 'none' ? 'block' :
                        'none';
                });
            });


        });
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>