<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_query = "SELECT * FROM user WHERE username = '$username'";
    $check_result = mysqli_query($konek, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username sudah terdaftar. Silakan gunakan username lain.";
    } else {
        $hashed_username = hash('sha256', $username);
        $hashed_password = hash('sha256', $password);

        $insert_query = "INSERT INTO user (username, password)
        VALUES ('$hashed_username', '$hashed_password')";

        if (mysqli_query($konek, $insert_query)) {
            $_SESSION['username'] = $username;
            $_SESSION['status']   = "login";
            header("Location: home.php");
            exit;
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($konek);
        }
    }
}
?>

