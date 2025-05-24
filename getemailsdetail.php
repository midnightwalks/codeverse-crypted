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
<body style="font-family: 'Poppins', sans-serif; background-image: url('background.png'); background-size: cover; background-position: center; height: 100vh;">
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

</div>
<center style="margin-top: 80px;">
<?php
include 'koneksi.php';
if($_SESSION['username'] == 'admin'){ 
    echo '<br><br>';
    echo '<h1>List of your daily email subscriber.</h1>';
    echo '<p>Stay ahead in coding with the curated email subscriptions, the key to staying informed and empowered about the world of codes.</p>';
    echo '<br><br>';

    $query = mysqli_query($konek, "SELECT * FROM join_courses ORDER BY id_part DESC");

    // Jika ada data yang ditemukan
    if (mysqli_num_rows($query) > 0) {
        echo '<table style="border: 1px solid #ccc; border-collapse: collapse; width: 500px; background-color: #FFFAFA;">';
        echo '<tr>';
        echo '<th style="border: 1px solid #ccc; padding: 8px;"><b>Name</b></th>';
        echo '<th style="border: 1px solid #ccc; padding: 8px;"><b>Email</b></th>';
        echo '</tr>';
    
        while ($data = mysqli_fetch_array($query)) {
            echo '<tr>';
            echo '<td style="border: 1px solid #ccc; padding: 8px;">' . $data['name_part'] . '</td>';
            echo '<td style="border: 1px solid #ccc; padding: 8px;">' . $data['email_part'] . '</td>';
            echo '</tr>';
        }
    echo '</table>';
    echo '<br><br>';
} else {
    echo 'No data available';
}

} else {
    echo '<br><br>';
    echo '<h1>Enjoy our daily newspaper, ' . $_SESSION['username'] . '!</h1>';
    echo '<p>Stay ahead in coding with our curated email subscriptions, your key to staying informed and empowered about the world of codes.</p>';
    echo '<br><br>';
$query = mysqli_query($konek, "SELECT * FROM join_courses ORDER BY id_part DESC LIMIT 1"); // Mengambil hanya 1 data terakhir dengan ORDER BY dan LIMIT

// Jika ada data yang ditemukan
if ($data = mysqli_fetch_array($query)) {
    echo '<div style="border: 1px solid #ccc; border-radius: 5px; padding: 15px; margin-bottom: 20px; width: 500px;">';
    echo '<div style="/* Style untuk bagian konten dalam card */">';

    // Menampilkan data nama dan email
    echo "<p> <b>Daily emails will be send to: </b></p>";
    echo "<p>Name: " . $data['name_part'] . "</p>";
    echo "<p>Email: " . $data['email_part'] . "</p>";
    echo '</div>'; // Tutup div btn-group

    echo '</div>'; // Tutup div card-body
    echo '</div>'; // Tutup div card
}
}
?>

</center>
<div class="thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div> 
</body>
</html>
