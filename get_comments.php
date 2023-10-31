<?php
include 'database.php';

// Define the getTimeAgo function
if (!function_exists('getTimeAgo')) {
    function getTimeAgo($timestamp, $currentTime) {
        $timeDiff = $currentTime - $timestamp;
        
        if ($timeDiff < 0) {
            // If the timestamp is in the future (which shouldn't normally happen), return an appropriate message.
            return 'In the future';
        } elseif ($timeDiff < 60) {
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

if (isset($_GET['question_id'])) {
    $questionId = $_GET['question_id'];

    $sqlComments = "SELECT * FROM comments WHERE question_id = '$questionId' ORDER BY comment_id DESC";
    $resultComments = mysqli_query($conn, $sqlComments);

    $commentsHtml = '';
    $currentTime = time(); // Get the current time once.

    while ($comment = mysqli_fetch_assoc($resultComments)) {
    if (!empty($comment['student_id'])){
        $comment_user_id = $comment['student_id']; 
        $sql4 = "SELECT fullname FROM `students` WHERE student_id='$comment_user_id'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
    }
    else if (!empty($comment['teacher_id'])){
        $comment_user_id = $comment['teacher_id']; 
        $sql4 = "SELECT fullname FROM `teachers` WHERE teacher_id='$comment_user_id'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
    }
    else{
        $comment_user_id = $comment['alumni_id']; 
        $sql4 = "SELECT fullname FROM `alumni` WHERE alumni_id='$comment_user_id'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
    }

        // Calculate the time ago
        $CommentTimestamp = strtotime($comment['comment_time']);
        $timeAgo = getTimeAgo($CommentTimestamp, $currentTime);

        // Append the comment to the HTML string
        $commentsHtml .= '<article class="common-post">
        <header class="common-post-header u-flex">
        <img src="assets/images/user_default.png" class="user-image" width="40" height="40" alt="">
        <div class="common-post-info">
        <div class="user-and-group u-flex">
            <a href="https://www.facebook.com/eladsc" target="_blank">'. $row4['fullname'].'</a>
        </div>
            <div class="time-and-privacy">
                '.$timeAgo.'
            </div>
        </div>    
            <button class="icon-button-2 u-margin-inline-start" aria-label="more options"><span
            class="icon-menu"></span></button>
        </header>
        <div class="common-post-content common-content">
            '. $comment['comment_context'] .'
        </div>
    </article>';
    }

    echo $commentsHtml;
}
?>
