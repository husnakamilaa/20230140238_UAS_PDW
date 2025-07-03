<?php 
include '../../config.php';
require_once '../templates/header.php'?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Laporan Masuk</h2>

    <!-- Filter Form -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6">
        <!-- Filter Modul -->
        <select name="modul" class="border p-2 rounded w-full sm:w-1/3">
            <option value="">Filter Modul</option>
            <?php
            $modul = mysqli_query($conn, "SELECT id, judul FROM modul");
            while ($row = mysqli_fetch_assoc($modul)) {
                $selected = ($_GET['modul'] ?? '') == $row['id'] ? 'selected' : '';
                echo "<option value='{$row['id']}' $selected>{$row['judul']}</option>";
            }
            ?>
        </select>

        <!-- Filter Mahasiswa -->
        <input type="text" name="mahasiswa" placeholder="Nama Mahasiswa" class="border p-2 rounded w-full sm:w-1/3" value="<?= $_GET['mahasiswa'] ?? '' ?>">

        <!-- Filter Status -->
        <select name="status" class="border p-2 rounded w-full sm:w-1/3">
            <option value="">Filter Status</option>
            <option value="Belum Dinilai" <?= ($_GET['status'] ?? '') == 'Belum Dinilai' ? 'selected' : '' ?>>Belum Dinilai</option>
            <option value="Sudah Dinilai" <?= ($_GET['status'] ?? '') == 'Sudah Dinilai' ? 'selected' : '' ?>>Sudah Dinilai</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Terapkan</button>
    </form>

    <!-- Daftar Laporan -->
    <table class="w-full table-auto border border-collapse text-sm">
        <thead>
        <tr class="bg-gray-200 text-left">
            <th class="border p-2">Nama Mahasiswa</th>
            <th class="border p-2">Modul</th>
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT 
                    laporan.id,
                    users.nama AS nama_mahasiswa,
                    modul.judul AS judul_modul,
                    laporan.tanggal_upload,
                    laporan.status
                  FROM laporan
                  JOIN users ON laporan.id_users = users.id
                  JOIN modul ON laporan.id_modul = modul.id
                  WHERE 1=1";

        if (!empty($_GET['modul'])) {
            $modul_id = mysqli_real_escape_string($conn, $_GET['modul']);
            $query .= " AND laporan.id_modul = '$modul_id'";
        }

        if (!empty($_GET['mahasiswa'])) {
            $nama = mysqli_real_escape_string($conn, $_GET['mahasiswa']);
            $query .= " AND users.nama LIKE '%$nama%'";
        }

        if (!empty($_GET['status'])) {
            $status = mysqli_real_escape_string($conn, $_GET['status']);
            $query .= " AND laporan.status = '$status'";
        }

        $query .= " ORDER BY laporan.tanggal_upload DESC";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td class='border p-2'>{$row['nama_mahasiswa']}</td>
                        <td class='border p-2'>{$row['judul_modul']}</td>
                        <td class='border p-2'>" . date("d M Y, H:i", strtotime($row['tanggal_upload'])) . "</td>
                        <td class='border p-2'>{$row['status']}</td>
                        <td class='border p-2'>
                            <a href='detail_laporan.php?id={$row['id']}' class='text-blue-600 hover:underline'>Lihat</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='border p-2 text-center text-gray-500'>Tidak ada laporan ditemukan.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
