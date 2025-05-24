<?php
session_start();
if(empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
}
include('koneksi.php');
$sqlSearch = mysqli_query($konek, "SELECT * FROM course");
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
<body style="font-family: 'Poppins', sans-serif; background-image: url('background.png'); background-size: cover; background-position: center;" >
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
                    <a class="nav-link active text-white" aria-current="page" href="#">Tutorials</a>
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

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="whatiscoding.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="https://youtu.be/zOjov-2OZ0E?si=s7z2DZ9TQ6c_LVOT" class="text-decoration-none text-light">
                    <h5>Introduction to Coding</h5>
                </a>
                <a href="https://youtu.be/zOjov-2OZ0E?si=s7z2DZ9TQ6c_LVOT" class="text-decoration-none text-light">
                    <p>Coding involves using specific languages to create instructions that computers can understand, enabling them to perform various tasks and operations.</p>
                </a>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <img src="introjvs2.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="https://youtu.be/PkZNo7MFNFg?si=fE86kuBQwHlAn-HX" class="text-decoration-none text-light">
                    <h5>Learn Javascript</h5>
                </a>
                <a href="https://youtu.be/PkZNo7MFNFg?si=fE86kuBQwHlAn-HX" class="text-decoration-none text-light">
                    <p>JavaScript is a scripting language primarily used to add interactivity and dynamic elements to web pages, allowing for user interaction, content updates, and building complex web applications.</p>
                </a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="intropython.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <a href="https://youtu.be/rfscVS0vtbw?si=HMAS7ym6GHTK2azh" class="text-decoration-none text-light">
                    <h5>Learn Python</h5>
                </a>
                <a href="https://youtu.be/rfscVS0vtbw?si=HMAS7ym6GHTK2azh" class="text-decoration-none text-light">
                    <p>Python is a versatile and readable programming language known for its simplicity and efficiency, often used in web development, data analysis, artificial intelligence, and scientific computing.</p>
                </a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php
if ($_SESSION['username'] != "admin"): ?>
    <div class="container" style="margin-top: 150px; text-align: center;">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>
            What do you want to learn today?<br><br>
        </p>
        <hr>
    </div>
    <?php endif;?>

    <div class="row row-cols-1 row-cols-md-2 g-4" style="margin: 200px; margin-top: 50px;">
<?php 

while($data = mysqli_fetch_assoc($sqlSearch)){
?>
  <div class="col">
    <div class="card">
      <img src="images/<?= $data['img_course']?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><a href="<?= $data['link_course']?>">Learn <?= $data['title_course']?></a></h5>
        <p class="card-text"><?= $data['desc_course']?></p>
        <center>
          <?php if($_SESSION['username'] == 'admin'){?>
            <a href="editcourse.php?id=<?php echo $data['id_course']?>" class="btn btn-primary">Edit</a>
            <a href="deletecourse.php?id=<?php echo $data['id_course']?>" class="btn btn-primary">Delete</a>
          <?php } ?>
        </center>
      </div>
    </div>
  </div>
<?php } ?>
</div>

<div class="thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</body>
</html>
