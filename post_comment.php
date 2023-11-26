<?php
// Include database connection code here (you'll need to configure this)
include 'database.php';
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $cContext = $_POST['cContext'];
    $Qid = $_POST['Qid'];
    
    //for category id
    // $sql = "SELECT * FROM `categories`"; 
    // $result = mysqli_query($conn, $sql);
    // while($row = mysqli_fetch_assoc($result)){
    //  // echo $row['category_id'];
    //  // echo $row['category_name'];
    //  $id = $row['category_id'];
    //  $cat = $row['category_name'];
    //  $desc = $row['category_description'];
    //  if ($category == $cat) {
    //     $catid = $id; // Use a single equal sign for assignment
    //     break;
    //  }   
    // }
    
    if (isset($_SESSION['user_category'])) {
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
    }
    echo $teacher_id;
    // Perform data validation (you can add more validation)
    if (empty($cContext)) {
        die("Comment cannot be empty.");
    }

    // Sanitize data (prevent SQL injection)
    $cContext = str_replace("<", "&lt;", $cContext);
    $cContext = str_replace(">", "&gt;", $cContext);
   

    // Insert the question into the database
    $sql = "INSERT INTO `comments`(`question_id`, `student_id`, `teacher_id`, `alumni_id`, `comment_context`, `comment_time`) 
    VALUES ('$Qid','$student_id', '$teacher_id', '$alumni_id','$cContext', current_timestamp())";
    
    if (mysqli_query($conn, $sql)) {
        // JavaScript to display an alert and then redirect
        echo "<script>alert('Answer posted.');</script>";
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