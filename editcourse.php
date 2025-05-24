<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
} else if($_SESSION['username'] !== 'admin') {
    echo "Anda tidak dapat mengakses halaman ini.";
    exit; 
}
include('koneksi.php');

$id = $_GET['id'];
$result = mysqli_query($konek, "SELECT * FROM course WHERE id_course = '$id'");
$row = mysqli_fetch_assoc($result);

$oldTitle = $row['title_course'];
$oldDesc = $row['desc_course'];
$oldLink = $row['link_course'];
if (isset($_POST["title_course"])) {
    $id = $_GET['id'];
    $title = $_POST["title_course"];
    $desc = $_POST["desc_course"];
    $link = $_POST["link_course"];
    $desc = htmlspecialchars($desc);
    $filename = $_FILES['img_course']['name'];
    $filenametemp = $_FILES['img_course']['tmp_name'];
    $fileextension = pathinfo($filename, PATHINFO_EXTENSION);
    $filedestination = './images/' . $filename;

    if (!in_array($fileextension, ['pdf', 'img', 'jpg', 'png', 'jpeg'])) {
        echo "your file must be in pdf, img, jpg, or png";
    } else {
        if (move_uploaded_file($filenametemp, $filedestination)) {

            $sql = mysqli_query($konek, "UPDATE course SET title_course = '$title', desc_course = '$desc', img_course = '$filename', link_course = '$link' WHERE id_course = '$id'");
            if ($sql) {
                echo "file uploaded successfully";
                header("location: home.php");
            } else {
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
                    <a class="nav-link active text-white" href="home.php">Tutorials</a>
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

    <div class="container" style="margin-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="editcourse.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <h3>Edit Course</h3>
                    <div class="mb-3">
                        <label for="title_course" class="form-label">Course Name</label>
                        <input type="text" name="title_course" class="form-control" id="title_course" placeholder="Course Name" value="<?php echo $oldTitle; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="img_course" class="form-label">Course Picture</label>
                        <input type="file" class="form-control" id="img_course" name="img_course">
                    </div>
                    <div class="mb-3">
                        <label for="desc_course" class="form-label">Course Description</label>
                        <textarea class="form-control" id="desc_course" name="desc_course" rows="3"><?php echo $oldDesc; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link_course" class="form-label">Course Link</label>
                        <input type="text" name="link_course" class="form-control" id="link_course" placeholder="Course Link" value="<?php echo $oldLink; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div>
</body>

</html>
