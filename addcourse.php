<?php
session_start();
if(empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
} else if($_SESSION['username'] !== 'admin') {
    echo "Anda tidak dapat mengakses halaman ini.";
    exit; 
}
include('koneksi.php');
    
if(isset($_POST["title_course"])){
    $title = $_POST["title_course"];
    $desc = $_POST["desc_course"];
    $link = $_POST["link_course"];
    $filename = $_FILES['img_course']['name'];
    $filenametemp = $_FILES['img_course']['tmp_name'];
    $fileextension = pathinfo($filename, PATHINFO_EXTENSION);
    $filedestination = './images/' . $filename;
    
    if(!in_array($fileextension, ['pdf', 'img', 'jpg', 'png', 'jpeg'])){
        echo "your file must be in pdf, img, jpg, or png";
    }else{
        if(move_uploaded_file($filenametemp, $filedestination)){
            echo 'a';   
            $sql = mysqli_query($konek, "INSERT INTO course(title_course, img_course, desc_course, link_course) VALUES('$title', '$filename', '$desc', '$link');");
            if($sql){
                echo "file uploaded successfully";
                header("location: home.php");
            }else{
                echo "failed to upload file";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CodeVerse</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body style="font-family: 'Poppins', sans-serif; background-image: url('background.png'); background-size: cover; background-position: center;">
    <!-- Navbar -->
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="70" height="30" class="d-inline-block align-text-top" style="margin-right: 1px;">
                <span class="mx-2">
                    <img src="logoname.png" alt="Logo" width="120" height="30" class="d-inline-block align-text-top" style="margin-right: 1px;">
                </span>
                </a>
            </div>
            <ul class="nav mx-4">

                <li class="nav-item">
                    <a class="nav-link active text-white"  href="home.php">Tutorials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" href="qna.php">Share Codes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="getemails.php">Get Emails</a>
                </li>
                <?php if($_SESSION['username'] == "admin"):?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="addcourse.php">Add Course</a>
                  </li>
                <?php endif;?>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-light text-black">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<div class="container" style="margin-top: 150px; text-align: center;">
                    
<form action="addcourse.php" method="post" enctype="multipart/form-data" class="m-4">
    <h3>Add New Course</h3>
    <div class="mb-3">
        <label for="courseName" class="form-label">Course Name</label>
        <input type="text" class="form-control" id="courseName" name="title_course" placeholder="Course Name">
    </div>
    <div class="mb-3">
        <label for="coursePicture" class="form-label">Course Picture</label>
        <input type="file" class="form-control" id="coursePicture" name="img_course">
    </div>
    <div class="mb-3">
        <label for="courseDescription" class="form-label">Course Description</label>
        <textarea class="form-control" id="courseDescription" name="desc_course" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="courseLink" class="form-label">Course Link</label>
        <input type="text" class="form-control" id="courseLink" name="link_course" placeholder="Course Link">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<div class="thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div> 
</body>
</html>
