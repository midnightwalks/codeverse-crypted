<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$hashed_username = hash('sha256', $username);
$hashed_password = hash('sha256', $password);

$data = mysqli_query($konek, "SELECT * FROM user WHERE username='$hashed_username' AND password='$hashed_password'")
    or die(mysqli_error($konek));

$cek = mysqli_num_rows($data);
if ($cek > 0) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status']   = "login";
    header("Location: home.php");
} else {
    header("location:index.php?pesan=gagal");
}
?>
