<?php
function imageToCiphertext($imagePath) {
    $imageData = file_get_contents($imagePath);
    $encodedData = base64_encode($imageData);

    $encryptedData = encryptText($encodedData);

    return $encryptedData;
}

function ciphertextToImage($ciphertext, $outputPath) {
    // Dekripsi ciphertext kembali ke format asli gambar
    $decodedData = decryptText($ciphertext);
    $imageData = base64_decode($decodedData);

    // Simpan gambar hasil dekripsi
    file_put_contents($outputPath, $imageData);
}
?>
