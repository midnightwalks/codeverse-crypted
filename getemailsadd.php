<?php
$koneksi = mysqli_connect("localhost", "root", "", "codeverse");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_part = $_POST["name_part"];
    $email_part = $_POST["email_part"];

    $sql = "INSERT INTO join_courses (name_part, email_part) VALUES ('$name_part', '$email_part')";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data berhasil disimpan.";
        header("Location: getemailsdetail.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>