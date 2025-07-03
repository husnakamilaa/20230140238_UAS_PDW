<?php
session_start();
include '../../config.php';

// Cek login & role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_laporan = $_GET['id'] ?? null;

if (!$id_laporan) {
    echo "ID laporan tidak valid.";
    exit;
}

// Ambil file dan id_praktikum dari database
$query = mysqli_query($conn, "
    SELECT l.file_laporan, m.id_praktikum
    FROM laporan l
    JOIN modul m ON l.id_modul = m.id
    WHERE l.id = $id_laporan AND l.id_users = $id_user
");

$data = mysqli_fetch_assoc($query);
if (!$data) {
    echo "Laporan tidak ditemukan atau Anda tidak memiliki akses.";
    exit;
}

$file_path = "../laporan/file/" . $data['file_laporan'];
if (file_exists($file_path)) {
    unlink($file_path); // Hapus file dari folder
}

// Hapus data dari tabel laporan
$delete = mysqli_query($conn, "DELETE FROM laporan WHERE id = $id_laporan AND id_users = $id_user");

if ($delete) {
    // Redirect ke halaman detail praktikum sesuai dengan id_praktikum yang diambil dari DB
    header("Location: ../detailPraktikum/detail_praktikum.php?id_praktikum=" . $data['id_praktikum']);
    exit;
} else {
    echo "Gagal menghapus laporan.";
}
?>
