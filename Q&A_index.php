<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q&A Forum</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .user-profile {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
    </style>
</head>

<body>
<?php include 'database.php';?>

    <div class="container mt-5">
        <h1 class="display-4">Welcome to the Peer Learning Platform</h1>
        <div class="jumbotron">
            <h2 class="mb-4">Ask a Question</h2>
            <form method="post" action="post_question.php">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <textarea class="form-control" id="title" name="title" rows="2" required></textarea>
                    <br>
                    <label for="question">Question:</label>
                    <textarea class="form-control" id="question" name="question" rows="4" required></textarea>
                </div>
               
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="Python">Python</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="React.js">React.js</option>
                        <option value="Php">Php</option>
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="public" name="privacy" value="public" checked>
                    <label class="form-check-label" for="public">Public</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="private" name="privacy" value="private">
                    <label class="form-check-label" for="private">Private</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
        <h2 class="mt-4">Categories</h2>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">Python</a>
            <a href="#" class="list-group-item list-group-item-action">JavaScript</a>
            <a href="#" class="list-group-item list-group-item-action">React.js</a>
            <a href="#" class="list-group-item list-group-item-action">Php</a>
            <!-- Add more categories here (placeholders) -->
        </div>
</div>

 <!-- Start of the loop to display questions -->
<div class="container mb-5" id="ques">
    <h1 class="py-4">Browse Questions</h1>
    <?php
    include 'database.php';
    // $userid = $_GET['userid'];
    // $user_id = $_GET['student_id'];
    // $sql = "SELECT * FROM `questions` WHERE category_id=$cat_id"; 
    $sql = "SELECT * FROM `questions`";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['question_id'];
        $title = $row['question_title'];
        $desc = $row['question_desc']; 
        $thread_time = $row['created_at']; 
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

        echo '<div class="media my-3 jumbotron">
            <img src="assets/images/user_default.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">'.
                '<h5 class="mt-0"> <a class="text-dark" href="#commentModal_'.$id.'">'. $title . ' </a></h5>
                <p class="mx-2">'. $desc . '</p>
                
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModalLong">
                     Comment
                    </button>
            </div>'.'<div class="font-weight-bold my-0"> '. $row2['fullname'] . ' <br>at '. $thread_time. '</div>'.
        '</div>';  

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
</div>
<!-- End of the loop to display questions -->

      

    <!-- Modal for Question Details -->

        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="container mt-5 mb-5">
                        <div class="d-flex justify-content-center row">
                            <div class="d-flex flex-column col-md-8">
                                <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                                    <div class="profile-image"><img class="rounded-circle" src="https://i.imgur.com/t9toMAQ.jpg" width="70"></div>
                                    <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1"><i class="fa fa-sort-up fa-2x hit-voting"></i><span>127</span><i class="fa fa-sort-down fa-2x hit-voting"></i></div>
                                    <div class="d-flex flex-column ml-3">
                                        <div class="d-flex flex-row post-title">
                                            <h5>Is sketch 3.9.1 stable?</h5><span class="ml-2">(Jesshead)</span></div>
                                        <div class="d-flex flex-row align-items-center align-content-center post-title"><span class="bdge mr-1">video</span><span class="mr-2 comments">13 comments&nbsp;</span><span class="mr-2 dot"></span><span>6 hours ago</span></div>
                                    </div>
                                </div>
                                <div class="coment-bottom bg-white p-2 px-4">
                                    <div class="d-flex flex-row add-comment-section mt-4 mb-4"><img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/qdiP4DB.jpg" width="38"><input type="text" class="form-control mr-3" placeholder="Add comment"><button class="btn btn-primary" type="button">Comment</button></div>
                                    <div
                                        class="commented-section mt-2">
                                        <div class="d-flex flex-row align-items-center commented-user">
                                            <h5 class="mr-2">Corey oates</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">4 hours ago</span></div>
                                        <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                                        <div
                                            class="reply-section">
                                            <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span class="dot ml-2"></span>
                                                <h6 class="ml-2 mt-1">Reply</h6>
                                            </div>
                                </div>
                            </div>
                            <div class="commented-section mt-2">
                                <div class="d-flex flex-row align-items-center commented-user">
                                    <h5 class="mr-2">Samoya Johns</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">5 hours ago</span></div>
                                <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..</span></div>
                                <div class="reply-section">
                                    <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">15</span><span class="dot ml-2"></span>
                                        <h6 class="ml-2 mt-1">Reply</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="commented-section mt-2">
                                <div class="d-flex flex-row align-items-center commented-user">
                                    <h5 class="mr-2">Makhaya andrew</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">10 hours ago</span></div>
                                <div class="comment-text-sm"><span>Nunc sed id semper risus in hendrerit gravida rutrum. Non odio euismod lacinia at quis risus sed. Commodo ullamcorper a lacus vestibulum sed arcu non odio euismod. Enim facilisis gravida neque convallis a. In mollis nunc sed id. Adipiscing elit pellentesque habitant morbi tristique senectus et netus. Ultrices mi tempus imperdiet nulla malesuada pellentesque.</span></div>
                                <div
                                    class="reply-section">
                                    <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">25</span><span class="dot ml-2"></span>
                                        <h6 class="ml-2 mt-1">Reply</h6>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
   
    <br>
    <br>

    <!-- Include Bootstrap and JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>