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
    <title>Question Forum</title>
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
                <a href="studentportal/student_index.php" class="logo" ><img src="assets/images/logoside.png" alt="logo"></a>

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
                <?php
                        if ($userCategory == 'Student'){
                            echo '<a href="/studentportal/student_profile.php" class="user">';
                        }
                        elseif($userCategory == 'Teacher'){
                            echo '<a href="/teacherportal/teacher_profile.php" class="user">';
                        }
                        elseif($userCategory == 'Alumni'){
                            echo '<a href="/alumniportal/alumni_profile.php" class="user">';
                        }
                        
                        ?>
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
                    <?php
                        if ($userCategory == 'Student'){
                            echo '<a href="studentportal/student_index.php" target="_blank" class="common-list-button">';
                        }
                        elseif($userCategory == 'Teacher'){
                            echo '<a href="/teacherportal/teacher_profile.php" target="_blank" class="common-list-button">';
                        }
                        elseif($userCategory == 'Alumni'){
                            echo '<a href="/alumniportal/alumni_profile.php" target="_blank" class="common-list-button">';
                        }
                        
                        ?>
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
            <!-- create a post div -->
            <div class="container">
                <div class="wrapper">
                    <section class="post">
                        <header>Create Post</header>
                        <form method="post" action="post_question.php">
                            <div class="content">
                                <img src="assets/images/user_default.png" alt="logo">
                                <div class="details">
                                    <p><?php echo $fullname;?></p>
                                    <div class="privacy-menu">
                                        <span id="privacy-menu-label">Public</span>
                                        <i class="fas fa-caret-down"></i>
                                        <div class="privacy-menu-options" style="display: none;">
                                            <label>
                                                <i class="fas fa-globe-asia"></i>
                                                <input type="radio" name="selectedPrivacy" value="Public" checked>
                                                Public
                                            </label>
                                            <label style="margin-left: 10px;">
                                                <i class="fas fa-user-friends"></i>
                                                <input type="radio" name="selectedPrivacy" value="Private"> Private
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="Python">Python</option>
                                    <option value="JavaScript">JavaScript</option>
                                    <option value="React.js">React.js</option>
                                    <option value="Php">Php</option>
                                </select>
                            </div>
                            <div class="title">
                                <textarea placeholder="Question Title.." name="title" id="title" rows="2"
                                    required></textarea>
                            </div>

                            <textarea name="question" id="question" placeholder="Write question details.."
                                spellcheck="false" required></textarea>
                            <button>Post</button>
                        </form>
                    </section>
                    <!-- <section class="audience">
                        <header>
                            <div class="arrow-back"><img src="icons/back.png" alt=""></div>
                            <p>Select Audience</p>
                        </header>
                        <div class="content">
                            <p>Who can see your post?</p>
                            <span>Your post will show up in News Feed, on your profile and in search results.</span>
                        </div>
                        <ul class="list">
                            <li>
                                <div class="column">
                                    <div class="icon"><i class="fas fa-globe-asia"></i></div>
                                    <div class="details">
                                        <p>Public</p>
                                        <span>Anyone on Q&A forum can see.</span>
                                    </div>
                                </div>
                                <div class="radio">
                                    <input style="margin: 4px;" type="radio" name="privacy" id="publicRadio"
                                        value="public">
                                </div>
                            </li>
                            <li>
                                <div class="column">
                                    <div class="icon"><i class="fas fa-user-friends"></i></div>
                                    <div class="details">
                                        <p>Private</p>
                                        <span>Only your category users can see.</span>
                                    </div>
                                </div>
                                <div class="radio">
                                    <input style="margin: 4px;" type="radio" name="privacy" id="privateRadio"
                                        value="private">
                                </div>
                            </li>
                        </ul>

                    </section> -->
                </div>
            </div>
            <script>
            const privacyMenu = document.querySelector(".privacy-menu");
            const privacyLabel = document.getElementById("privacy-menu-label");
            const privacyOptions = document.querySelector(".privacy-menu-options");

            privacyMenu.addEventListener("click", () => {
                if (privacyOptions.style.display === "none" || privacyOptions.style.display === "") {
                    privacyOptions.style.display = "block";
                } else {
                    privacyOptions.style.display = "none";
                }
            });

            privacyOptions.querySelectorAll("input[type=radio]").forEach((radio) => {
                radio.addEventListener("click", () => {
                    privacyLabel.textContent = radio.value;
                    privacyOptions.style.display = "none";
                });
            });

            // Close the dropdown menu when clicking outside of it
            document.addEventListener("click", function(e) {
                if (!privacyMenu.contains(e.target)) {
                    privacyOptions.style.display = "none";
                }
            });
            </script>



            <!-- news feed posts -->

            <?php
    include 'database.php';
    // $userid = $_GET['userid'];
    // $user_id = $_GET['student_id'];
    // $sql = "SELECT * FROM `questions` WHERE category_id=$cat_id"; 
    $sql = "SELECT * FROM `questions` Where `privacy` like'public' ORDER BY question_id DESC";
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
            $usercat = "students";
        }
        else if (!empty($row['teacher_id'])){
            $thread_user_id = $row['teacher_id']; 
            $sql2 = "SELECT fullname FROM `teachers` WHERE teacher_id='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $usercat = "teachers";
        }
        else{
            $thread_user_id = $row['alumni_id']; 
            $sql2 = "SELECT fullname FROM `alumni` WHERE alumni_id='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $usercat = "alumni";
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
                            <a href="userprofile.php?userid='.$thread_user_id.'&category='.$usercat.'"  target="_blank">'. $row2['fullname'] . '</a>
                            
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

       

        //    <!-- Modal for comment -->
        //    <!-- <button id="myBtn">Open Modal</button> -->
        //    <!-- The Modal -->
        // $sql3 = "SELECT * FROM `comments` WHERE question_id = '$id'";
        // $result3 = mysqli_query($conn, $sql3);
        // while($row3 = mysqli_fetch_assoc($result3)){
        //     $cid = $row3['comment_id'];
        //     $cContext = $row3['comment_context'];
        //     $ctime = $row3['comment_time'];
        //     // Getting user_id if student, teacher, Alumni
        //     if (!empty($row3['student_id'])){
        //         $comment_user_id = $row3['student_id']; 
        //         $sql4 = "SELECT fullname FROM `students` WHERE student_id='$comment_user_id'";
        //         $result4 = mysqli_query($conn, $sql4);
        //         $row4 = mysqli_fetch_assoc($result4);
        //     }
        //     else if (!empty($row3['teacher_id'])){
        //         $comment_user_id = $row3['teacher_id']; 
        //         $sql4 = "SELECT fullname FROM `teachers` WHERE teacher_id='$comment_user_id'";
        //         $result4 = mysqli_query($conn, $sql4);
        //         $row4 = mysqli_fetch_assoc($result4);
        //     }
        //     else{
        //         $comment_user_id = $row3['alumni_id']; 
        //         $sql4 = "SELECT fullname FROM `alumni` WHERE alumni_id='$comment_user_id'";
        //         $result4 = mysqli_query($conn, $sql4);
        //         $row4 = mysqli_fetch_assoc($result4);
        //     }

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
                                <div class="time-and-privacy">
                                    <time datetime=" '.date('c', $threadTimestamp).'">
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
                            <a src="USERPROFILE"><img src="assets/images/user_default.png" class="user-image" width="40" height="40" alt=""></a>
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
            
            function toggleReplyForm(button) {
                const replyForm = button.nextElementSibling;
                if (replyForm.style.display === \'none\') {
                    replyForm.style.display = \'block\';
                } else {
                    replyForm.style.display = \'none\';
                }
            }

            function togglePreviousReplies(button) {
                const prevReplies = button.nextElementSibling;
                if (prevReplies.style.display === \'none\') {
                    prevReplies.style.display = \'block\';
                } else {
                    prevReplies.style.display = \'none\';
                }
            }

        </script>
        
';  
        
     $i++; 
       
    }
     // echo var_dump($noResult);
     if($noResult){
     echo '<div class="jumbotron jumbotron-fluid py-4">
         <div class="container">
             <p class="display-4">No Threads Found</p>
             <p class="lead"> Be the first person to ask a question</p>
         </div>
     </div> ';
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