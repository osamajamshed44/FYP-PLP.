<?php
// Include database connection code here (you'll need to configure this)
include 'database.php';
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $reply_desc = $_POST['reply_desc'];
    $comment_id = $_POST['comment_id'];
      
    if (isset($_SESSION['user_category'])) {
        $userCategory = $_SESSION['user_category'];
   
        // Now, you can use $userCategory to determine which column in the questions table to insert the user's ID.
        if ($userCategory == 'Student') {
            $reply_by = $_SESSION['fullname'];
            
        } elseif ($userCategory == 'Teacher') {
            $reply_by = $_SESSION['fullname'];
        } elseif ($userCategory == 'Alumni') {
            $reply_by = $_SESSION['fullname'];
        }
    }
    
    // Perform data validation (you can add more validation)
    if (empty($reply_desc)) {
        die("Comment cannot be empty.");
    }

    // Sanitize data (prevent SQL injection)
    $reply_desc = str_replace("<", "&lt;", $reply_desc);
    $reply_desc = str_replace(">", "&gt;", $reply_desc);
   

    // Insert the question into the database
    $sql = "INSERT INTO `question_replies` (`reply_desc`, `reply_by`, `comment_id`, `reply_time`) VALUES ('$reply_desc', '$reply_by', '$comment_id', current_timestamp())";
    
    if (mysqli_query($conn, $sql)) {
        // JavaScript to display an alert and then redirect
        // echo "<script>alert('reply posted.');</script>";
        echo "<script>window.location = 'indexQ&A.php';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
} else {
    // Handle the case when the form is not submitted
    echo "Form submission error.";
}
?>