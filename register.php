<?php
if(isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "Login gagal! Username dan Password salah!";
    } else if ($_GET['pesan'] == "logout") {
        echo "Anda telah berhasil logout";
    } else if ($_GET['pesan'] == "belum_login") {
        echo "Anda harus login untuk mengakses halaman admin";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body style="font-family: 'Poppins', sans-serif; background-image: url('background.png'); background-size: cover; background-position: center;" >
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="70" height="30" class="d-inline-block align-text-top" style="margin-right: 1px;">
                <span class="mx-2">
                    <img src="logoname.png" alt="Logo" width="120" height="30" class="d-inline-block align-text-top" style="margin-right: 1px;">
                </span>
            </a>
        </div>
    </nav>

    <center>
        <img src="logomove-unscreen.gif" alt="logo" style="width: 15%; height: auto;">
        <div style="font-size: 30pt; margin-left: 15px; padding-bottom: 5px;"> Register to access our content</div>
        <p>Unlock the World of Possibilities with Our Comprehensive Coding Tutorials.</p>
    </center>
    <p></p>

    <div class="signin-cont" style="padding: 400px;  padding-top: 0px; padding-bottom: 150px;">
    <form id="loginForm" action="regist.php" method="post" class="p-5">
    <div class="mb-3">
        <label for="username" class="form-label"><b>Username</b></label>
        <input type="text" class="form-control" name="username" placeholder="Input your username" aria-label="Username" maxlength="10" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label"><b>Password</b></label>
        <input type="password" class="form-control" name="password" placeholder="Input your password" aria-label="Password" maxlength="20" required><br>
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-info" type="submit">Register</button>
    </div>
</form>
<center>
    <p>Already have an account? <a href="index.php">LOGIN</a></p>
</center>

    <div class="fixed-bottom thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div> 
</body>
</html>
