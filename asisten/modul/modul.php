<?php 
include '../../config.php'; 
require_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Modul</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Daftar Modul</h2>

        <form method="GET" class="mb-4 flex items-center gap-2">
            <input type="text" name="search" placeholder="Cari modul" class="border p-2 rounded w-full" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Cari</button>
            <a href="tambahModul.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah</a>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Judul</th>
                        <th class="border px-4 py-2">Deskripsi</th>
                        <th class="border px-4 py-2">Praktikum</th>
                        <th class="border px-4 py-2">File</th>
                        <th class="border px-4 py-2">Tanggal Upload</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                    
                    // JOIN untuk ambil nama_praktikum
                    $query = "SELECT m.*, p.nama_praktikum 
                              FROM modul m
                              LEFT JOIN praktikum p ON m.id_praktikum = p.id_praktikum";
                    
                    if ($search != '') {
                        $query .= " WHERE m.judul LIKE '%$search%' OR m.deskripsi LIKE '%$search%' OR p.nama_praktikum LIKE '%$search%'";
                    }

                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2"><?= $row['id'] ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['judul']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_praktikum']) ?></td>
                        <td class="border px-4 py-2">
                            <a href="file/<?= $row['file'] ?>" class="text-blue-600 hover:underline" download>Download</a>
                        </td>
                        <td class="border px-4 py-2"><?= $row['uploaded_at'] ?></td>
                        <td class="border px-4 py-2 flex gap-2">
                            <a href="editModul.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                            <a href="hapusModul.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
