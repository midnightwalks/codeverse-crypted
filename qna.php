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
    <style>
      .btn-lilac {
        background-color: #C8A2C8; /* Lilac color */
        color: white;
        border: none;
      }
      .btn-lilac:hover {
        background-color: #b08db0; /* Darker lilac for hover effect */
        color: white;
      }
      </style>
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
                    <a class="nav-link active text-white" aria-current="page" href="#">Share Codes</a>
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
<center>
<div class="container" style="margin-top: 100px; margin-bottom: 0px; text-align: center;">
<img src="logomove-unscreen.gif" alt="logo" style="width: 15%; height: auto;">
    <?php if ($_SESSION['username'] != "admin"): ?>
    <h2><?php echo $_SESSION['username']; ?>, share your gems, discover new treasures. </h2>
    <?php endif; ?>

</div>
    </center>

<section class="gradient-custom" style="margin-bottom: 40px;">
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10 col-xl-8">
        <div class="card">
          <div class="card-body p-4">
            <h4 class="text-center mb-4 pb-2">Share Codes</h4>

            <?php
$koneksi = mysqli_connect("localhost", "root", "", "codeverse");

if (mysqli_connect_error()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$query = "SELECT * FROM qna";
$result = mysqli_query($koneksi, $query);

if (!$result) {
  die("Query failed: " . mysqli_error($koneksi));
}

include 'encryption_helper.php'; // Pastikan untuk meng-include file helper
include 'steganography_helper.php';
include 'fileencrypt_helper.php'; 

$encryptionKey = "aecb9d60522aeaa5d35bde0910ad9c44975f6151755d2d2993a20d4ae48efd8f";

$query = "SELECT * FROM qna";
$result = mysqli_query($koneksi, $query);

if (!$result) {
  die("Query failed: " . mysqli_error($koneksi));
}

while ($row = mysqli_fetch_assoc($result)) {
  $decryptedQuestion = decryptText($row['question_qna']); // Dekripsi teks sebelum ditampilkan

  echo '
  <div class="d-flex flex-start mt-4">
    <div class="flex-grow-1 flex-shrink-1">
      <div>
        <div class="d-flex justify-content-between align-items-center">
          <p class="mb-1">
            <strong>'.$row['name_qna'].'</strong> <span class="small text-muted">- Just now</span>
          </p>
        </div>
        <p class="small mb-0">
          '.$decryptedQuestion.' 
        </p>';

    // **Tampilan gambar yang didekripsi ditempatkan di sini**
    if (!empty($row['image_qna'])) {
      $decryptedImagePath = 'uploads/images/' . uniqid() . '.png'; // Tempat penyimpanan sementara gambar didekripsi
      ciphertextToImage($row['image_qna'], $decryptedImagePath);
      echo '<img src="' . $decryptedImagePath . '" alt="Image" style="width: 100%; height: auto; max-width: 450px; margin-top: 20px;">';
    }

    if (!empty($row['file_qna'])) {
      $decryptedFileContent = decryptFile(base64_decode($row['file_qna']), 5);
      $decryptedFilePath = 'uploads/files/' . uniqid() . '_decrypted.txt';
      saveDecryptedFile($decryptedFileContent, $decryptedFilePath);
  
      echo '<a href="' . $decryptedFilePath . '" class="btn btn-lilac" id="downloadFileBtn" style="float: right; margin-right: 10px; margin-top: 20px;" download>Download File</a>';
  }  
    echo '</div>
    </div>
  </div>
  <hr style="border: 1px solid #b08db0; margin: 20px 1;">'; // Garis pembatas antar postingan
}

mysqli_close($koneksi);
?>


    <?php if($_SESSION['username'] != 'admin'){?>
            <br><hr>
            <div class="mt-5">
            <h5 class="mb-3" style="text-align: center; color: purple;">Add Your Code</h5>
              <form action="qnaprocess.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                      <label for="nama" class="form-label">Name <span class="small text-muted" style="margin-left: 487px;">(Max. 20 characters)</span></label>
                      <input type="text" class="form-control" id="nama" name="name_qna" maxlength="20">
                  </div>
                  <div class="mb-3">
                      <label for="komentar" class="form-label">Code Description  <span class="small text-muted" style="margin-left: 380px;">(Max. 5000 characters)</span></label>
                      <textarea class="form-control" id="komentar" name="question_qna" rows="3" maxlength="5000"></textarea>
                  </div>
                  <div class="mb-3">
                      <label for="image_qna" class="form-label">Upload Image  <span class="small text-muted" style="margin-left: 412px;">(Accept: JPG, PNG file)</span></label>
                      <input type="file" class="form-control" id="image_qna" name="image_qna" accept="image/*">
                  </div>
                  <div class="mb-3">
                      <label for="file_qna" class="form-label">Upload File  <span class="small text-muted" style="margin-left: 477px;">(Accept: TXT file)</span></label>
                      <input type="file" class="form-control" id="file_qna" name="file_qna" accept=".txt">
                  </div>
                  <button type="submit" class="btn btn-info" style="float: right; margin-top: 20px; background-color: pink;">Share Code</button>
              </form>
            </div>
    <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class=" thecontent" style="background-color: #222222; padding-top: 20px; padding-bottom: 7px; text-align: center;">
        <p style="color: white; font-family: 'Raleway', sans-serif;">
            © CodeVerse 2023
        </p>
    </div> 
</body>
</html> 

<!-- Script untuk validasi input -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        const nameInput = document.querySelector('#nama');
        const descriptionInput = document.querySelector('#komentar');
        const imageInput = document.querySelector('#image_qna');
        const fileInput = document.querySelector('#file_qna');

        form.addEventListener('submit', (e) => {
            let errors = [];

            // Validasi nama
            if (nameInput.value.length > 20) {
                errors.push("Name must not exceed 20 characters.");
            }

            // Validasi deskripsi kode
            if (descriptionInput.value.length > 5000) {
                errors.push("Description must not exceed 5000 characters.");
            }

            // Validasi gambar
            if (imageInput.files.length > 0) {
                const allowedImageTypes = ['image/jpeg', 'image/png'];
                if (!allowedImageTypes.includes(imageInput.files[0].type)) {
                    errors.push("Only JPG and PNG images are allowed.");
                }
            }

            // Validasi file
            if (fileInput.files.length > 0) {
                const allowedFileExtensions = ['txt'];
                const fileExtension = fileInput.files[0].name.split('.').pop();
                if (!allowedFileExtensions.includes(fileExtension)) {
                    errors.push("Only TXT files are allowed.");
                }
            }

            // Tampilkan error jika ada
            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join("\n"));
            }
        });
    });
</script>
</body>
</html>
