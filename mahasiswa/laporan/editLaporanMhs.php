<?php
session_start();
include '../../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../login.php");
    exit;
}

$id_laporan = $_GET['id'] ?? null;
$id_user = $_SESSION['user_id'];

if (!$id_laporan) {
    echo "ID laporan tidak valid.";
    exit;
}

// Ambil laporan dan id_praktikum dari join
$query = mysqli_query($conn, "
    SELECT l.*, m.id_praktikum
    FROM laporan l
    JOIN modul m ON l.id_modul = m.id
    WHERE l.id = $id_laporan AND l.id_users = $id_user
");
$laporan = mysqli_fetch_assoc($query);

if (!$laporan) {
    echo "Data laporan tidak ditemukan.";
    exit;
}

$pesan = ""; // Untuk menyimpan pesan sukses/gagal

if (isset($_POST['simpan'])) {
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $folder = 'file/';
    $namaBaru = time() . '_' . basename($file);

    if (move_uploaded_file($tmp, $folder . $namaBaru)) {
        // Hapus file lama jika ada
        if (file_exists($folder . $laporan['file_laporan'])) {
            unlink($folder . $laporan['file_laporan']);
        }

        // Update laporan
        $update = mysqli_query($conn, "
            UPDATE laporan 
            SET file_laporan = '$namaBaru', tanggal_upload = NOW(), status = 'Belum Dinilai'
            WHERE id = $id_laporan
        ");

        if ($update) {
            $pesan = "<p class='text-green-600 mt-4'>Laporan berhasil diedit.</p>";
        } else {
            $pesan = "<p class='text-red-600 mt-4'>Gagal update database.</p>";
        }
    } else {
        $pesan = "<p class='text-red-600 mt-4'>Gagal upload file.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Laporan</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="file" name="file" class="w-full border p-2 rounded" required>

        <div class="flex gap-2 pt-2">
            <button type="submit" name="simpan" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="../detailPraktikum/detail_praktikum.php?id_praktikum=<?= $laporan['id_praktikum'] ?>" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php if (!empty($pesan)): ?>
        <div class="mt-4"><?= $pesan ?></div>
    <?php endif; ?>
</div>
</body>
</html>
