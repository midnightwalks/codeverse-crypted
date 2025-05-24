<?php
include 'encryption_helper.php';
include 'steganography_helper.php';
include 'fileencrypt_helper.php';

$koneksi = mysqli_connect("localhost", "root", "", "codeverse");

if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$name_qna = $_POST['name_qna'];
$question_qna = encryptText($_POST['question_qna']); // Encrypt the question

$image_qna = "";
if (isset($_FILES['image_qna']) && $_FILES['image_qna']['error'] == 0) {
    $imagePath = $_FILES['image_qna']['tmp_name'];
    $encryptedImage = imageToCiphertext($imagePath); // Encrypt image file
    $image_qna = $encryptedImage;
}

// Assuming the encrypted file content is sent via POST
$file_qna = "";
if (isset($_FILES['file_qna']) && $_FILES['file_qna']['error'] == 0) {
    $filePath = $_FILES['file_qna']['tmp_name'];
    $encryptedFile = encryptFile($filePath, 5); // Gunakan kunci 5
    if ($encryptedFile !== false) {
        $file_qna = base64_encode($encryptedFile); // Simpan sebagai base64
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Validasi nama (maksimal 20 karakter)
    $name = trim($_POST['name_qna']);
    if (strlen($name) > 20) {
        $errors[] = "Name must not exceed 20 characters.";
    }

    // Validasi deskripsi kode (maksimal 5000 karakter)
    $description = trim($_POST['question_qna']);
    if (strlen($description) > 5000) {
        $errors[] = "Description must not exceed 5000 characters.";
    }

    // Validasi file gambar (hanya menerima JPG atau PNG)
    if (!empty($_FILES['image_qna']['name'])) {
        $allowedImageTypes = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['image_qna']['type'], $allowedImageTypes)) {
            $errors[] = "Only JPG and PNG images are allowed.";
        }
    }

    // Validasi file lampiran (hanya menerima TXT file)
    if (!empty($_FILES['file_qna']['name'])) {
        $allowedFileExtensions = ['txt'];
        $fileExtension = pathinfo($_FILES['file_qna']['name'], PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $allowedFileExtensions)) {
            $errors[] = "Only TXT files are allowed.";
        }
    }

    // Jika ada error, tampilkan dan hentikan proses
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        exit();
    }

    // Proses upload jika semua validasi lolos
    echo "<p style='color: green;'>Form submitted successfully!</p>";
}

$query = "INSERT INTO qna (name_qna, question_qna, image_qna, file_qna) VALUES ('$name_qna', '$question_qna', '$image_qna', '$file_qna')";

if (mysqli_query($koneksi, $query)) {
    header("Location: qna.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
