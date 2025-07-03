<?php // File: tambahLaporanMhs.php
session_start();
include '../../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_modul = $_GET['id_modul'] ?? null;

if (!$id_modul) {
    echo "ID modul tidak valid.";
    exit;
}

// Ambil id_praktikum berdasarkan id_modul
$modul = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_praktikum FROM modul WHERE id = $id_modul"));
$id_praktikum = $modul['id_praktikum'] ?? null;

if (!$id_praktikum) {
    echo "ID praktikum tidak ditemukan dari modul.";
    exit;
}

if (isset($_POST['simpan'])) {
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $folder = '../laporan/file/';
    $namaSimpan = time() . '_' . basename($file);

    if (move_uploaded_file($tmp, "$folder$namaSimpan")) {
        $tanggal_upload = date('Y-m-d H:i:s');
        $query = mysqli_query($conn, "INSERT INTO laporan (id_users, id_modul, file_laporan, tanggal_upload, status) VALUES ('$id_user', '$id_modul', '$namaSimpan', '$tanggal_upload', 'Belum Dinilai')");
        if ($query) {
            echo "<p class='text-green-600 mt-4'>Laporan berhasil dikumpulkan.</p>";
        } else {
            echo "<p class='text-red-600 mt-4'>Gagal menyimpan ke database: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p class='text-red-600 mt-4'>Gagal upload file ke folder.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kumpulkan Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Kumpulkan Laporan</h2>
    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="file" name="file" class="w-full border p-2 rounded" required>
        <div class="flex gap-2 pt-2">
            <button type="submit" name="simpan" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="../detailPraktikum/detail_praktikum.php?id_praktikum=<?= $id_praktikum ?>" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>