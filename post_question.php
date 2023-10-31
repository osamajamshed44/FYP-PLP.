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
    $privacy = $_POST['privacy'];
    
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
        if ($userCategory == 'student') {
            $student_id = $_SESSION['student_id'];
            $teacher_id = null;
            $alumni_id = null;
        } elseif ($userCategory == 'teacher') {
            $teacher_id = $_SESSION['teacher_id'];
            $student_id = null;
            $alumni_id = null;
        } elseif ($userCategory == 'alumni') {
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
    $question = mysqli_real_escape_string($conn, $question);
    $catid = mysqli_real_escape_string($conn, $catid);
    $privacy = mysqli_real_escape_string($conn, $privacy);

    // Insert the question into the database
    $sql = "INSERT INTO questions (student_id, teacher_id, alumni_id, question_desc, category_id, privacy, created_at, question_title) 
            VALUES ('$student_id', '$teacher_id', '$alumni_id', '$question', '$catid', '$privacy', current_timestamp(), '$title')";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the homepage after successful submission
        header("Location: indexQ&A.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle the case when the form is not submitted
    echo "Form submission error.";
}
?>
