<?php 
session_start();
include('koneksi.php');
$id = $_GET['id'];

if($_SESSION['username'] !== 'admin') {
    echo "Anda tidak dapat mengakses halaman ini.";
    exit;
} else if($_SESSION['username'] == 'admin') {
$sql = mysqli_query($konek, "DELETE FROM course WHERE id_course = '$id'");
if($sql)
    header("Location: home.php");
else
    echo 'error';
}
?>