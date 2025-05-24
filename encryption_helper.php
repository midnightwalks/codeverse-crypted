<?php
function caesarEncrypt($text, $shift) {
    $result = '';
    foreach (str_split($text) as $char) {
        $code = ord($char);
        // Shift only letters
        if ($code >= 65 && $code <= 90) {
            $result .= chr((($code - 65 + $shift) % 26) + 65);
        } elseif ($code >= 97 && $code <= 122) {
            $result .= chr((($code - 97 + $shift) % 26) + 97);
        } else {
            $result .= $char;
        }
    }
    return $result;
}

function rc4Encrypt($data, $key) {
    $s = range(0, 255);
    $j = 0;
    $result = '';

    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
        list($s[$i], $s[$j]) = [$s[$j], $s[$i]];
    }

    $i = $j = 0;
    for ($y = 0, $len = strlen($data); $y < $len; $y++) {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        list($s[$i], $s[$j]) = [$s[$j], $s[$i]];
        $result .= $data[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
    }
    return $result;
}

function encryptText($text) {
    $shift = 3;
    $rc4Key = 'secure_key';
    $caesarEncrypted = caesarEncrypt($text, $shift);
    $rc4Encrypted = rc4Encrypt($caesarEncrypted, $rc4Key);
    return base64_encode($rc4Encrypted);
}

function decryptText($encryptedText) {
    $shift = 3;
    $rc4Key = 'secure_key';
    $rc4Decrypted = rc4Encrypt(base64_decode($encryptedText), $rc4Key);
    return caesarEncrypt($rc4Decrypted, 26 - $shift);
}
?>  