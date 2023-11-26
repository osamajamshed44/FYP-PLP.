<?php
// Include database connection code here (you'll need to configure this)
include 'database.php';
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $question = $_POST['question'];
    $category = $_POST['category'];
    $privacy = $_POST['selectedPrivacy'];
    
    //for category id
    $sql = "SELECT * FROM `categories`"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
     // echo $row['category_id'];
     // echo $row['category_name'];
     $id = $row['category_id'];
     $cat = $row['category_name'];
     $desc = $row['category_description'];
     if ($category == $cat) {
        $catid = $id; // Use a single equal sign for assignment
        break;
     }   
    }
    
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
    // Perform data validation (you can add more validation)
    if (empty($question)) {
        die("Question cannot be empty.");
    }

    // Sanitize data (prevent SQL injection)
    $title = str_replace("<", "&lt;", $title);
    $title = str_replace(">", "&gt;", $title); 
    $question = str_replace("<", "&lt;", $question);
    $question = str_replace("<", "&lt;", $question);
    $catid = mysqli_real_escape_string($conn, $catid);
    $privacy = mysqli_real_escape_string($conn, $privacy);

    // Insert the question into the database
    $sql = "INSERT INTO questions (student_id, teacher_id, alumni_id, question_desc, category_id, privacy, created_at, question_title) 
            VALUES ('$student_id', '$teacher_id', '$alumni_id', '$question', '$catid', '$privacy', current_timestamp(), '$title')";
    
    if (mysqli_query($conn, $sql)) {
        // JavaScript to display an alert and then redirect
        echo "<script>alert('Question posted!!.');</script>";
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
