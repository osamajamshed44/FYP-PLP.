<?php

require '../vendor/autoload.php';

use Vimeo\Vimeo;

// Your Vimeo API credentials
$client = new Vimeo("7d583b1ea12167d94e267a5a922ee614a5f710a8", "aHjS6Z1GnPy2QZNr0hnoKA7Cm9iSJUj6FPDQQROGgQSWXE8VV08DELkVX745wypN78CSpJIw2/WVXfKKJxO5xxO5RG925Li/iZaHnvk+SgsTzrx7RVacuLTwntQrN1zp", "6c59f6fcfe9829ebf5c989631cc639e0");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form data
    $videoName = $_POST['videoName'];
    $description = $_POST['description'];
    $program = $_POST['program']; // You need to have a program field in your form
    $thumbnailPath = $_FILES['thumbnail']['tmp_name']; // Adjust this according to your form
    $videoPath = $_FILES['video']['tmp_name'];

    // Upload the video to Vimeo
    $uri = $client->upload($videoPath, [
        "name" => $videoName,
        "description" => $description,
    ]);

    $response = $client->request($uri . '?fields=transcode.status');
    if ($response['body']['transcode']['status'] === 'complete') {
    print 'Your video finished transcoding.';
    } elseif ($response['body']['transcode']['status'] === 'in_progress') {
    print 'Your video is still transcoding.';
    } else {
    print 'Your video encountered an error during transcoding.';
    }

    // Get video URI after transcoding
    $response = $client->request($uri . '?fields=link');
    $videoURI = $response['body']['link'];
    $videoId = getVimeoVideoId($videoURI);

    // Function to extract Vimeo video ID
    function getVimeoVideoId($uri) {
        $parts = explode('/', parse_url($uri, PHP_URL_PATH));
        return end($parts);
    }

        // Insert video details into your database
        include 'database.php';

        $sql = "INSERT INTO `video_lectures` (`video_name`, `desc`, `program`, `thumbnail_path`, `video_uri`, `uploaded_at`) 
        VALUES ('$videoName', '$description', '$program', '$thumbnailPath', '$videoId', current_timestamp());";

        if (mysqli_query($conn, $sql)) {
        // Redirect back to the homepage after successful submission
        header("Location: indexQ&A.php");
        exit();
        } else {
        echo "Error: " . mysqli_error($conn);
        }

        echo "Your video has been successfully uploaded and saved to the database.";
}
?>