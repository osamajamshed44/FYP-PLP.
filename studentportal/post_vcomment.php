<?php
// Include database connection code here (you'll need to configure this)
include 'database.php';
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $comment_desc = $_POST['comment_desc'];
    $video_no = $_POST['video_no'];
 
      
    if (isset($_SESSION['user_category'])) {
        $userCategory = $_SESSION['user_category'];
   
        // Now, you can use $userCategory to determine which column in the questions table to insert the user's ID.
        if ($userCategory == 'Student') {
            $vcomment_by = $_SESSION['fullname'];
            
        } elseif ($userCategory == 'Teacher') {
            $vcomment_by = $_SESSION['fullname'];
        } elseif ($userCategory == 'Alumni') {
            $vcomment_by = $_SESSION['fullname'];
        }
    }
    
    // Perform data validation (you can add more validation)
    if (empty($comment_desc)) {
        die("Comment cannot be empty.");
    }

    // Sanitize data (prevent SQL injection)
    $comment_desc = str_replace("<", "&lt;", $comment_desc);
    $comment_desc = str_replace(">", "&gt;", $comment_desc);
   

    // Insert the question into the database
    $sql = "INSERT INTO `video_comments` (`vcomment_by`, `vcomment_des`, `vcomment_time`, `video_no`) VALUES ('$vcomment_by', '$comment_desc', current_timestamp(), '$video_no')";
    
    if (mysqli_query($conn, $sql)) {
        // JavaScript to display an alert and then redirect
        echo "<script>alert('Answer posted.');</script>";
        echo "<script>window.location = 'viewvideo.php?video_no=$video_no';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
} else {
    // Handle the case when the form is not submitted
    echo "Form submission error.";
}
?>