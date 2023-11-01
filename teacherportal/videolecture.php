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
    $teacher_id = $_SESSION['teacher_id'];
} else {
    // Redirect to the login page or handle the case where the name is not set
    header("Location: teacher_login.php");
    exit();
}



require '../vendor/autoload.php';

use Vimeo\Vimeo;

// Your Vimeo API credentials
$client = new Vimeo("7d583b1ea12167d94e267a5a922ee614a5f710a8", "aHjS6Z1GnPy2QZNr0hnoKA7Cm9iSJUj6FPDQQROGgQSWXE8VV08DELkVX745wypN78CSpJIw2/WVXfKKJxO5xxO5RG925Li/iZaHnvk+SgsTzrx7RVacuLTwntQrN1zp", "6c59f6fcfe9829ebf5c989631cc639e0");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form data
    if (isset($_POST['videoName'])) {
        $videoName = $_POST['videoName'];
    }
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

       // Function to extract Vimeo video ID
       function getVimeoVideoId($uri) {
        $parts = explode('/', parse_url($uri, PHP_URL_PATH));
        return end($parts);
    }
    // Get video URI after transcoding
    $response = $client->request($uri . '?fields=link');
    $videoURI = $response['body']['link'];
    $videoId = getVimeoVideoId($videoURI);

    // Document Upload
    $apiKey = 'osamajamshed44@gmail.com_c599b9cf820868db3da6e1eae2e676f2cae4ffb77482fdc2398a2a35e5ea149d3a9641e1';
    $fileName = $_FILES["document"]["name"];
    $tempFile = $_FILES["document"]["tmp_name"];

    if (empty($fileName) || empty($tempFile)) {
        die("No file uploaded.");
    }

    // Get a presigned URL for document upload from PDF.co
    $pdfcoApiUrl = "https://api.pdf.co/v1/file/upload/get-presigned-url?name=" . urlencode($fileName) . "&encrypt=true";

    // Set up headers with your API key
    $headers = [
        'Content-Type: application/json',
        'x-api-key: ' . $apiKey,
    ];

    // Make the API request
    $pdfcoApiResponse = file_get_contents($pdfcoApiUrl, false, stream_context_create(['http' => ['header' => $headers]]));

    // Parse the response JSON
    $pdfcoResponse = json_decode($pdfcoApiResponse, true);

    // Check for any errors
    if ($pdfcoResponse["error"]) {
        die("Error: " . $pdfcoResponse["message"]);
    }

    // Extract the presigned URL
    $presignedUrl = $pdfcoResponse["presignedUrl"];

    // Use cURL to upload the file to the presigned URL
    $ch = curl_init($presignedUrl);
    $fileHandle = fopen($tempFile, "r");

    curl_setopt($ch, CURLOPT_PUT, true);
    curl_setopt($ch, CURLOPT_INFILE, $fileHandle);
    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($tempFile));

    $uploadResult = curl_exec($ch);

    fclose($fileHandle);
    curl_close($ch);

    if ($uploadResult) {
        echo "Document uploaded successfully.";
        $pdfcoResponseData = json_decode($pdfcoApiResponse, true);
        $documentUrl = $pdfcoResponseData["url"];
    } else {
        echo "Failed to upload document.";
    }

 

        // Insert video details into your database
        include 'database.php';

        $sql = "INSERT INTO `video_lectures` (`video_name`, `desc`, `program`, `thumbnail_path`, `video_uri`, `uploaded_at`, `document_url`) 
        VALUES ('$videoName', '$description', '$program', '$thumbnailPath', '$videoId', current_timestamp(), '$documentUrl')";

        if (mysqli_query($conn, $sql)) {                       
        // Redirect back to the homepage after successful submission
        header("Location: videolecture.php");
        exit();
        } else {
        echo "Error: " . mysqli_error($conn);
        }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <head>
        <style>
        ::-webkit-scrollbar{
            background: white;
            width: 0;
        }
        </style>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Dashboard Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand "
        style="background-color: blueviolet;border: 1px solid white; border-radius: 10px;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="teacher_index.php"
            style="color: white; font-size: 22px;"><strong><?php echo $fullname; ?></strong></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
            id="sidebarToggle" href="#!"
            style="margin-left: 40px; color: white;"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="container" style=" margin-left: 105px;">
            <div class="row">
                <div class
                    style="padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <nav class="main-nav">
                        <a href="teacher_index.html" class="active"
                            style="color: white; padding-left: 30px;">Home</a>
                        <a href="tables ofstudent.html"
                            style="color: white; padding-left: 30px;">Student Area</a>
                        <a href="videolecture.html" style="color: white; padding-left: 30px;">Video Section</a>
                        <a href="../indexQ&A.php?userid=<?php echo $teacher_id; ?>" style="color: white; padding-left: 30px;">Q&A</a>
                        <a href="course.html" style="color: white; padding-left: 30px;">Courses</a>
                    </nav>
                </div>
            </div>
        </div>
        <form
            class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group" style="  margin-right: 200px;">
                <input class="form-control" type="text"
                    placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                    <button class="button" style=" background-color: black; color: white; border: 20px; width: 60px; border-radius: 3px;"
                    id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: white;"
                    id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="teacherlogout.php">Logout</a></li>
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
                        <a class="nav-link" href="teacher_index.html">
                            <div class="sb-nav-link-icon"><i
                                    class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="course.html">
                            <div class="sb-nav-link-icon"><i
                                    class="fas fa-columns"></i></div>
                            Upload Course

                        </a>
                        <a class="nav-link" href="videolecture.html">
                            <div class="sb-nav-link-icon"><i
                                    class="fas fa-table"></i></div>
                            Upload Video lecture
                        </a>
                        <a class="nav-link" href="tables ofstudent.html">
                            <div class="sb-nav-link-icon"><i
                                    class="fas fa-table"></i></div>
                            Table Of Student's
                        </a>
                        <a class="nav-link" href="answer.html">
                            <div class="sb-nav-link-icon"><i
                                    class="fas fa-table"></i></div>
                            Answer Section
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
                    border-radius: 20px; font-size: 16px;" >

                    <ol class="breadcrumb mb-4">
                        <a href="teacher_index.html">
                            <h1 class="mt-4">Upload Video</h1>
                        </a>

                    </ol>
                    <div class="dashboardwork"
                        style="border: 1px solid blueviolet;  border-radius: 20px;
                                 padding: 3px; margin-bottom: 20px;">
                        <div class="container-fluid px-4">
                            <div class="container mt-5">
                                
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="videoName">Video Name: </label>
                                        <input type="text" class="form-control" id="videoName" name="videoName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description: </label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="program">Program Related: </label>
                                        <input type="text" class="form-control" id="program" name="program" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail Image: </label>
                                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*" required>
                                    
                                        <label for="video">Video File: </label>
                                        <input type="file" class="form-control-file" id="video" name="video" accept="video/*" required>
                                        <br>
                                        <br>
                                        <label for="document">Reading Material (if any):</label>
                                        <input type="file" name="document" accept=".pdf">
        
                                    </div>
                                    <br>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span id="progress-status"></span>
                                     <br>   
                                    <button style="margin-bottom: 10px;" type="submit" class="btn btn-primary">Upload</button>
                                           
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div
                        class="d-flex align-items-center justify-content-between small">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to update the progress bar
        function updateProgress(percentage) {
            $(".progress-bar").css("width", percentage + "%");
            $(".progress-bar").attr("aria-valuenow", percentage);
        }

        // Your form submission
        $("form").submit(function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'http://localhost/Peer%20Learning%20Platform/teacherportal/videolecture.php', // Adjust the URL to your upload script
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (e) {
                        if (e.lengthComputable) {
                            var percentage = (e.loaded / e.total) * 100;
                            updateProgress(percentage);
                            $("#progress-status").text(percentage.toFixed(2) + "% uploading");
                        }
                    }, false);
                    return xhr;
                },
                success: function (response) {
                $("#progress-status").text("Upload complete");
                $(".alert").show(); // Assuming you have a Bootstrap alert
            }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>