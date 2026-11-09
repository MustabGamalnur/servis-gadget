<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "root", "db_servis");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$KUNCI_SISTEM = "TEKNISI2026";

function enkripsi($data, $kunci) {
    return openssl_encrypt($data, 'AES-128-ECB', $kunci);
}

function dekripsi($data, $kunci) {
    $hasil = openssl_decrypt($data, 'AES-128-ECB', $kunci);
    if ($hasil === false || $hasil === "") {
        return '<span class="text-rose-400 font-mono text-xs">[Gagal Dekripsi / Kunci Salah]</span>';
    }
    return htmlspecialchars($hasil);
}
?>