<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
include '../config.php';
require_once 'templates/header_mahasiswa.php';

$mahasiswa_id = $_SESSION['user_id'];

// Ambil data praktikum yang sudah didaftarkan oleh mahasiswa
$sql = "
    SELECT p.id_praktikum, p.nama_praktikum, p.semester 
    FROM pendaftaran d
    JOIN praktikum p ON d.id_praktikum = p.id_praktikum
    WHERE d.mahasiswa_id = '$mahasiswa_id'
";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Praktikum Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-10">

        <!-- Notifikasi -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="mb-6">
                <?php if ($_GET['msg'] == 'berhasil_daftar'): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center" role="alert">
                        ✅ Berhasil mendaftar ke praktikum!
                    </div>
                <?php elseif ($_GET['msg'] == 'sudah_daftar'): ?>
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded text-center" role="alert">
                        ⚠️ Kamu sudah mendaftar ke praktikum ini sebelumnya.
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold text-blue-600 text-center mb-10">PRAKTIKUM YANG SUDAH KAMU DAFTAR</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">
                            <?= htmlspecialchars($row['nama_praktikum']) ?>
                        </h2>
                        <p class="text-sm text-gray-600 mb-4">Semester: <?= htmlspecialchars($row['semester']) ?></p>
                        <a href="detail_praktikum.php?id_praktikum=<?= $row['id_praktikum'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Lihat Detail
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-600 col-span-full text-center">Kamu belum mendaftar ke praktikum manapun.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('[role="alert"]');
            if (alert) alert.remove();
        }, 4000);
    </script>
</body>
</html>
