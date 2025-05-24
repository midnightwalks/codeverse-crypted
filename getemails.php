<?php
session_start();
if(empty($_SESSION['username'])) {
    header("location:index.php?pesan=belum_login");
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
                    <a class="nav-link text-white" aria-current="page" href="getemails.php">Get Emails</a>
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

<center>
<?php if ($_SESSION['username'] == "admin") {
    header("Location: getemailsdetail.php");
 } else { ?>
    <div class="container" style="margin-top: 80px; text-align: center;">
    <img src="logomove-unscreen.gif" alt="logo" style="width: 15%; height: auto;">
        <h1><?php echo $_SESSION['username']; ?>, get our daily newspaper in one click!</h1>
        <p>
            Stay ahead in coding with our curated email subscriptions, your key to staying informed and empowered about the world of codes.
        </p>
        <br><hr>
    </div>
    <div class="signin-cont" style="padding: 40px 50px 0; font-family: 'League Spartan', sans-serif; margin: 0 auto; max-width: 600px;">
    <form id="loginForm" action="getemailsadd.php" method="post" style="padding-bottom: 10px; padding-right: 5px; padding-top: 5px;">
    <div style="padding-bottom: 15px;">
        <label for="name"><b>Name</b></label><br>
        <input type="text" class="form-control" name="name_part" placeholder="Input Name" aria-label="name" aria-describedby="basic-addon1" style="padding-left: 5px; border-radius: 8px; background-color: #ecf4fc;" required>
    </div>
    <div>
        <label for="Email"><b>Email</b></label><br>
        <input type="email" class="form-control" name="email_part" placeholder="Input Email" aria-label="Password" aria-describedby="basic-addon1" style="padding-left: 5px; padding-bottom: 5px; border-radius: 8px; background-color: #ecf4fc;" required>
    </div>
    <br>
    <div class="d-grid gap-2" style="padding-bottom: 230px;">
        <button class="btn btn-info" type="submit" style="background-color: #C8A2C8;">Submit</button>
    </div>
</form>

    </div>
<?php } ?>
</center>

<div class="thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div> 
</body>
</html>
