<?php

// Rail Fence Cipher Encryption
function railFenceEncrypt($plaintext, $key) {
    $rail = array_fill(0, $key, []);
    $directionDown = false;
    $row = 0;

    foreach (str_split($plaintext) as $char) {
        $rail[$row][] = $char;

        // Ubah arah jika di baris pertama atau terakhir
        if ($row == 0 || $row == $key - 1) {
            $directionDown = !$directionDown;
        }
        $row += $directionDown ? 1 : -1;
    }

    // Gabungkan semua karakter dari semua rail
    $encryptedText = '';
    foreach ($rail as $level) {
        $encryptedText .= implode('', $level);
    }

    return $encryptedText;
}

// Rail Fence Cipher Decryption
function railFenceDecrypt($ciphertext, $key) {
    $rail = array_fill(0, $key, []);
    $plaintext = '';
    $directionDown = null;
    $row = 0;

    $len = strlen($ciphertext);
    $mark = array_fill(0, $key, array_fill(0, $len, false));

    // Tandai posisi rail untuk setiap karakter
    for ($col = 0; $col < $len; $col++) {
        $mark[$row][$col] = true;

        if ($row == 0) {
            $directionDown = true;
        }
        if ($row == $key - 1) {
            $directionDown = false;
        }

        $row += $directionDown ? 1 : -1;
    }

    $index = 0;
    for ($r = 0; $r < $key; $r++) {
        for ($c = 0; $c < $len; $c++) {
            if ($mark[$r][$c] && $index < $len) {
                $rail[$r][$c] = $ciphertext[$index++];
            }
        }
    }

    $row = 0;
    $directionDown = null;
    for ($col = 0; $col < $len; $col++) {
        $plaintext .= $rail[$row][$col] ?? '';

        if ($row == 0) {
            $directionDown = true;
        }
        if ($row == $key - 1) {
            $directionDown = false;
        }

        $row += $directionDown ? 1 : -1;
    }

    return $plaintext;
}

function encryptFile($filePath, $key) {
    $plaintext = file_get_contents($filePath);
    if ($plaintext === false) {
        return false;
    }
    return railFenceEncrypt($plaintext, $key);
}

function decryptFile($encryptedContent, $key) {
    return railFenceDecrypt($encryptedContent, $key);
}

function saveDecryptedFile($decryptedContent, $filePath) {
    file_put_contents($filePath, $decryptedContent);
}

?>
