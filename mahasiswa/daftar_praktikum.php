<?php
session_start();
include '../config.php';

$mahasiswa_id = $_SESSION['user_id'];
$id_praktikum = $_GET['id_praktikum'];

// Cek apakah sudah pernah daftar
$cek = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE mahasiswa_id = '$mahasiswa_id' AND id_praktikum = '$id_praktikum'");
if (mysqli_num_rows($cek) > 0) {
    header("Location: my_courses.php?msg=sudah_daftar");
    exit;
}

// Insert jika belum terdaftar
mysqli_query($conn, "INSERT INTO pendaftaran (mahasiswa_id, id_praktikum, tanggal_daftar) VALUES ('$mahasiswa_id', '$id_praktikum', NOW())");

header("Location: my_courses.php?msg=berhasil_daftar");
exit;

