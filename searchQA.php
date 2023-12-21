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
    // Now, you can use $userCategory to determine which column in the questions table to insert the user's ID.
    if ($userCategory == 'Student') {
        $student_id = $_SESSION['student_id'];
        $teacher_id = null;
        $alumni_id = null;
    } elseif ($userCategory == 'Teacher') {
        $teacher_id = $_SESSION['teacher_id'];
        $student_id = null;
        $alumni_id = null;
    } elseif ($userCategory == 'Alumni') {
        $alumni_id = $_SESSION['alumni_id'];
        $student_id = null;
        $teacher_id = null;
    }
} else {
    // Redirect to the login page or handle the case where the name is not set
    header("Location: student_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    ::-webkit-scrollbar {
        width: 17px;
    }

    ::-webkit-scrollbar-track {
        background-color: #e4e4e4;
        border-radius: 100px;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 100px;
        border: 5px solid transparent;
        background-clip: content-box;
        background-color: blueviolet;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/post/style.css">
    <link rel="stylesheet" href="assets/css/styleModal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
    .hidden {
        display: none;
    }
    </style>
</head>

<body>
    <?php include 'database.php';?>
    <div class="common-structure">
        <header class="main-header u-flex">
            <div class="start u-flex">
                <a href="studentportal/student_index.php" class="logo"><img src="assets/images/logoside.png"
                        alt="logo"></a>

            </div>
            <nav class="main-nav">
                <ul class="main-nav-list u-flex">
                    <div class="search-box-wrapper">
                        <form action="searchQA.php" method="get">
                            <input type="search" name="search" class="search-box" placeholder="Search topics..">
                            <span class="icon-search" aria-label="hidden">🔎</span>
                            <button type="submit" class="hidden"></button>
                        </form>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.querySelector('.search-box').addEventListener('keydown', function(e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    document.querySelector('.hidden').click();
                                }
                            });
                        });
                        </script>
                    </div>

                </ul>
            </nav>
            <div class="end"></div>
        </header>
        <nav class="user-nav">
            <ul class="user-nav-list u-flex">
                <li class="user-nav-item">
                    <a class="user">
                        <img class="user-image" src="assets/images/user_default.png" height="28" width="28" alt="">
                        <span class="user-name"><?php echo $fullname;?></span>
                    </a>
                </li>
                <li class="user-nav-item">
                    <button class="icon-button alt-text" aria-label="Create"><span class="icon"
                            aria-hidden="true">➕</span></button>
                </li>
                <li class="user-nav-item">
                    <button class="icon-button alt-text" aria-label="Messenger"><span class="icon"
                            aria-hidden="true">💬</span></button>
                </li>
                <li class="user-nav-item">
                    <button class="icon-button alt-text" aria-label="Notifications"><span class="icon"
                            aria-hidden="true">🔔</span></button>
                </li>
                <li class="user-nav-item">
                    <button class="icon-button alt-text" aria-label="Account"><span class="icon"
                            aria-hidden="true">🔻</span></button>
                </li>
            </ul>
        </nav>
        <aside class="side-a">
            <section class="common-section">
                <h2 class="section-title u-hide">User Navigation</h2>
                <ul class="common-list">
                    <li class="common-list-item">
                        <a href="https://www.facebook.com/eladsc/" target="_blank" class="common-list-button">
                            <span class="icon">
                                <img class="user-image"
                                    src="https://assets.codepen.io/65740/internal/avatars/users/default.png" height="36"
                                    width="36" alt="">
                            </span>
                            <span class="text"><?php echo $fullname;?></span>
                        </a>
                    </li>
                    <li class="common-list-item">
                        <a class="common-list-button">
                            <span class="icon" aria-hidden="true">💬</span>
                            <span class="text">Courses</span>
                        </a>
                    </li>
                    <li class="common-list-item">
                        <a class="common-list-button" href="userCategory_Q&A.php">
                            <span class="icon">👨&zwj;👦&zwj;👦</span>
                            <span class="text"><?php echo $userCategory; ?></span>
                        </a>
                    </li>
                    <li class="common-list-item">
                        <a class="common-list-button">
                            <span class="icon">🏪</span>
                            <span class="text">Categories</span>
                        </a>
                    </li>
                    <li class="common-list-item">
                        <a class="common-list-button">
                            <span class="icon">📺</span>
                            <span class="text">Videos</span>
                        </a>
                    </li>
                </ul>
                <button class="common-more">
                    <span class="text">See More</span>
                    <span class="icon">🔻</span>
                </button>
            </section>
            <section class="common-section">
                <h2 class="section-title">Shortcuts</h2>
                <ul class="common-list">
                    <li class="common-list-item">
                        <a href="https://www.facebook.com/groups/css.masters.israel" target="_blank"
                            class="common-list-button">
                            <span class="icon">
                                <img src="https://scontent.ftlv1-1.fna.fbcdn.net/v/t1.0-0/cp0/c40.0.50.50a/p50x50/96018871_10156797924731933_8952430699365793792_n.jpg?_nc_cat=105&_nc_sid=ca434c&_nc_ohc=IeqrI6DbUWkAX8FXQs7&_nc_ht=scontent.ftlv1-1.fna&oh=370e999a657281ecbaf5237802520a2a&oe=5F0102F9"
                                    alt="">
                            </span>
                            <span class="text">CSS Masters</span>
                        </a>
                    </li>
                    <li class="common-list-item">
                        <a href="https://bit.ly/3fl9RLV" target="_blank" class="common-list-button">
                            <span class="icon" aria-hidden="true">
                                <img src="https://scontent.ftlv1-1.fna.fbcdn.net/v/t1.0-0/cp0/c23.0.50.50a/p50x50/94671938_10156774842886933_854458879973523456_o.jpg?_nc_cat=104&_nc_sid=ca434c&_nc_ohc=fgV9zrVZoW0AX8o6u--&_nc_ht=scontent.ftlv1-1.fna&oh=c8a69ca97d2ed0bd8a27b9e4f653dcf9&oe=5F013738"
                                    alt="">
                            </span>
                            <span class="text">CSS Class</span>
                        </a>
                    </li>

                </ul>
                <button class="common-more">
                    <span class="text">See More</span>
                    <span class="icon">🔻</span>
                </button>
            </section>
        </aside>

        <main class="main-feed">
            <h1 style="margin: 20px;">Search results for <em>'<?php echo $_GET['search']?>'</em></h1>




            <!-- search results -->

            <?php
                    include 'database.php';
                    // $userid = $_GET['userid'];
                    // $user_id = $_GET['student_id'];
                    // $sql = "SELECT * FROM `questions` WHERE category_id=$cat_id"; 
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM `questions` where MATCH (question_title, question_desc) against ('$search')";
                    $result = mysqli_query($conn, $sql);
                    $noResult = true;
                    $i=1;
                while($row = mysqli_fetch_assoc($result)){
                        
                        $noResult = false;
                        $id = $row['question_id'];
                        $title = $row['question_title'];
                        $desc = $row['question_desc']; 
                        $threadTimestamp = strtotime($row['created_at']);
                        $thread_time =$row['created_at'];
                        $privacy = $row['privacy'];
                        if (!empty($row['student_id'])){
                            $thread_user_id = $row['student_id']; 
                            $sql2 = "SELECT fullname FROM `students` WHERE student_id='$thread_user_id'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                        }
                        else if (!empty($row['teacher_id'])){
                            $thread_user_id = $row['teacher_id']; 
                            $sql2 = "SELECT fullname FROM `teachers` WHERE teacher_id='$thread_user_id'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                        }
                        else{
                            $thread_user_id = $row['alumni_id']; 
                            $sql2 = "SELECT fullname FROM `alumni` WHERE alumni_id='$thread_user_id'";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                        }
                        //Time Format
                        if (!function_exists('getTimeAgo')) {
                        function getTimeAgo($timestamp, $currentTime) {
                            $timeDiff = $currentTime - $timestamp;
                            if ($timeDiff < 60) {
                                return $timeDiff . ' seconds ago';
                            } elseif ($timeDiff < 3600) {
                                $minutes = round($timeDiff / 60);
                                return $minutes . ' minutes ago';
                            } elseif ($timeDiff < 86400) {
                                $hours = round($timeDiff / 3600);
                                return $hours . ' hours ago';
                            } else {
                                return date('M j, Y', $timestamp); // Display the date if it's older.
                            }
                        }
                    }
                        $postTimestamp = strtotime($thread_time); // Assuming $thread_time is the timestamp of the post.
                        $currentTime = time();
                        $timeAgo = getTimeAgo($postTimestamp, $currentTime);

                    
                        //

                        

                        echo'
                            <article class="common-post">
                                <header class="common-post-header u-flex">
                                    <img src="assets/images/user_default.png"
                                        class="user-image" width="40" height="40" alt="">
                                    <div class="common-post-info">
                                        <div class="user-and-group u-flex">
                                            <a src ="assets/images/user_default.png" target="_blank">'. $row2['fullname'] . '</a>
                                            
                                        </div>
                                        <div class="time-and-privacy">
                                        <time datetime="' . date('c', $threadTimestamp) . '">
                                            ' . $timeAgo . '
                                        </time>
                                        <span class="icon icon-privacy">
                                            <i class="' . ($privacy == 'Public' ? 'fas fa-globe-asia' : 'fas fa-user-friends') . '"></i>
                                        </span>
                                    </div>

                                </header>
                                <h4 class="mt-0"> <a class="text-dark" href="#commentModal_">'. $title . ' </a></h4>
                                <div class="common-post-content common-content">
                                '. $desc . '
                                </div>
                            
                                <section class="actions-buttons">
                                    
                                        <!-- Button trigger modal -->
                                        
                                        <button class="actions-buttons-button" name ="myBtn" data-comment-button="'.$id.'"">
                                        <span class="icon">💬</span>
                                        <span class="text">Answer</span>
                                        </button>
                                    
                                </section>
                            </article>
                    ';

                    

                            echo '
                            <div id="myModal'.$id.'" class="modal" data-modal="'.$id.'">
                            
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="close">&times;</span>
                                        <header class="common-post-header u-flex">
                                            <img src="assets/images/user_default.png"
                                            class="user-image" width="40" height="40" alt="">
                                            <div class="common-post-info">
                                                <div class="user-and-group u-flex" >
                                                    <a src ="assets/images/user_default.png" style="font-size: 20px;" target="_blank">'. $title . ' <i style="font-size: 10px;">('.$row2['fullname'].')</i></a>
                                                    
                                                </div>
                                                <div class="time-and-privacy"><time datetime=" '.date('c', $threadTimestamp).'">
                                                '.$timeAgo.'
                                            </time>
                                            <span class="icon icon-privacy">
                                            <i class="' . ($privacy == 'Public' ? 'fas fa-globe-asia' : 'fas fa-user-friends') . '"></i>
                                            </span>
                                                </div>
                                            </div>
                                        </header>
                                    </div>

                                    <div class="modal-body">

                                    
                                    </div>

                                    <div class="modal-footer">    
                                    <form method="post" action="post_comment.php">                        
                                        <div class="container-comment">
                                            <input type="hidden" id="Qid" name="Qid" value="'.$id.'">
                                            <input class="input-field-comment" type="text" name="cContext" id="cContext" placeholder="Write comment...">
                                            <button class="button-comment">Submit</button>
                                        </div>
                                    </form>       
                                    </div>
                                </div>

                            </div>';


                            echo '
                            <script>
                            // Get all comment buttons
                            var commentButtons = document.querySelectorAll("[data-comment-button]");
                        
                            // Add click event listeners to all comment buttons
                            commentButtons.forEach(function (button) {
                                button.onclick = function () {
                                    var modalId = this.getAttribute("data-comment-button");
                                    var modal = document.querySelector(\'[data-modal="\' + modalId + \'"]\');
                                    if (modal) {
                                        modal.style.display = "block";
                                        document.body.style.overflow = "hidden";
                                        loadComments(modalId); // Load comments for the selected question
                                    }
                                };
                            });
                        
                            // Get all modal close buttons
                            var closeButtons = document.querySelectorAll(".close");
                        
                            // Add click event listeners to all close buttons
                            closeButtons.forEach(function (closeButton) {
                                closeButton.onclick = function () {
                                    // Find the closest modal and close it
                                    var modal = this.closest(".modal");
                                    if (modal) {
                                        modal.style.display = "none";
                                        document.body.style.overflow = "auto";
                                    }
                                };
                            });
                        
                            // When the user clicks anywhere outside of a modal, close it
                            window.onclick = function(event) {
                                if (event.target.className === "modal") {
                                    event.target.style.display = "none";
                                }
                            };
                        
                            function loadComments(questionId) {
                                // Fetch comments for the selected question using AJAX
                                var xhr = new XMLHttpRequest();
                                xhr.open("GET", "get_comments.php?question_id=" + questionId, true);
                                xhr.onload = function () {
                                    if (xhr.status == 200) {
                                        // Update the modal body with the retrieved comments
                                        var modalBody = document.querySelector(\'[data-modal="\' + questionId + \'"] .modal-body\');
                                        modalBody.innerHTML = xhr.responseText;
                                    }
                                };
                                xhr.send();
                            }
                        </script>
                        
                         ';  
                        
                            $i++; 
                            
                            }
                            // echo var_dump($noResult);
                            if($noResult){
                            echo '
                                <div style="background-color:gainsboro; padding:45px;">
                                    <h2 style="padding:10px;">No Results Found</h2>
                                    <p style="padding:10px;"> Suggestions:<ul style="padding-left:25px;">
                                            <li>Make sure that all words are spelled correctly.</li>
                                            <li>Try different keywords.</li>
                                            <li>Try more general keywords.</li>
                                            </ul>
                                    </p>
                                </div>
                            ';
                            }
                    ?>



        </main>
        <aside class="side-b">
            <section class="common-section">
                <h2 class="section-title">Sponsored</h2>
                <ul class="common-list">
                    <li class="common-list-item">
                        <a href="http://bit.ly/2Nd05lW" target="_blank" class="common-list-button is-ads">
                            <div class="image"><img src="assets/images/facts-bg.jpg" width="115" alt=""></div>
                            <div class="text">
                                <h4 class="ads-title">Export Sketch to HTML with a click</h4>
                                <p class="ads-url">animaapp.com</p>
                            </div>
                        </a>
                    </li>
                    <li class="common-list-item">
                        <a href="http://bit.ly/2Nd05lW" target="_blank" class="common-list-button is-ads">
                            <div class="image"><img src="assets/images/slider2.jpg" width="115" alt=""></div>
                            <div class="text">
                                <h4 class="ads-title">Front-end developers, prepare to be amazed</h4>
                                <p class="ads-url">animaapp.com</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <button class="common-more">
                    <span class="text">See More</span>
                    <span class="icon">🔻</span>
                </button>
            </section>
        </aside>
    </div>







    <script>
    /*JS isn't my expertise 😉*/
    $(document).ready(function() {
        $("#menuButton").on("click", function() {
            $(".side-a").toggleClass("is-open");
            $("html").toggleClass("is-nav-open");
        });
        $("#darkMode").on("click", function() {
            $("html").toggleClass("is-dark");
        });
    });
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="assets/js/timeInterval.js"></script>

</body>


</html>