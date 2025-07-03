<?php
session_start();
include '../../config.php';
require_once '../templates/header_mahasiswa.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_praktikum = $_GET['id_praktikum'] ?? null;

if (!$id_praktikum) {
    echo "ID praktikum tidak valid.";
    exit;
}

// Ambil info praktikum
$praktikum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM praktikum WHERE id_praktikum = $id_praktikum"));
if (!$praktikum) {
    echo "Praktikum tidak ditemukan.";
    exit;
}

// Ambil modul dari praktikum ini
$modul_query = mysqli_query($conn, "
    SELECT m.*, l.id AS laporan_id, l.status, l.nilai, l.feedback
    FROM modul m
    LEFT JOIN laporan l ON l.id_modul = m.id AND l.id_users = $id_user
    WHERE m.id_praktikum = $id_praktikum
    ORDER BY m.id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Praktikum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Detail Praktikum</h2>

    <!-- Info Praktikum -->
    <div class="mb-6">
        <h3 class="text-xl font-bold"><?= htmlspecialchars($praktikum['nama_praktikum']) ?></h3>
        <p class="text-gray-700"><?= nl2br(htmlspecialchars($praktikum['deskripsi'])) ?></p>
        <p class="text-sm text-gray-500 mt-2">Semester: <?= $praktikum['semester'] ?></p>
    </div>

    <!-- Daftar Modul -->
    <h4 class="text-lg font-semibold mb-2">Modul Tersedia:</h4>
    <table class="w-full border border-collapse text-sm">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="border p-2">Judul Modul</th>
                <th class="border p-2">File</th>
                <th class="border p-2">Status Laporan</th>
                <th class="border p-2">Nilai</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($modul = mysqli_fetch_assoc($modul_query)): ?>
            <tr>
                <td class="border p-2"><?= htmlspecialchars($modul['judul']) ?></td>
                <td class="border p-2">
                    <a href="../../asisten/modul/modul/file/<?= $modul['file'] ?>" target="_blank" class="text-blue-600 hover:underline">Download</a>
                </td>
                <td class="border p-2"><?= $modul['status'] ?? 'Belum Mengumpulkan' ?></td>
                <td class="border p-2"><?= $modul['nilai'] ?? '-' ?></td>
                <td class="border p-2">
                    <?php if ($modul['laporan_id']): ?>
                        <?php if ($modul['status'] === 'Belum Dinilai'): ?>
                            <a href="../laporan/editLaporanMhs.php?id=<?= $modul['laporan_id'] ?>" class="text-yellow-600 hover:underline">Edit</a> |
                            <a href="../laporan/hapusLaporanMhs.php?id=<?= $modul['laporan_id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus laporan?')">Hapus</a>
                        <?php else: ?>
                            <span class="text-gray-500 italic">Terkunci</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="../laporan/tambahLaporanMhs.php?id_modul=<?= $modul['id'] ?>" class="text-green-600 hover:underline">Kumpulkan</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</div>
</body>
</html>
