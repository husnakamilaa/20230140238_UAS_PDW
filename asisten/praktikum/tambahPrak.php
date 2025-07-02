<?php include '../../config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Praktikum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Praktikum</h2>

    <form method="POST" class="space-y-4">
        <input type="text" name="nama_praktikum" placeholder="Nama Praktikum" class="w-full border p-2 rounded" required>
        <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border p-2 rounded" required></textarea>
        <input type="number" name="semester" placeholder="Semester" class="w-full border p-2 rounded" required>
        <input type="text" name="image" placeholder="URL Gambar (opsional)" class="w-full border p-2 rounded">
        <div class="flex gap-2">
            <button type="submit" name="simpan" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="praktikum.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama_praktikum'];
        $deskripsi = $_POST['deskripsi'];
        $semester = $_POST['semester'];
        $image = $_POST['image'];

        $insert = mysqli_query($conn, "INSERT INTO praktikum (nama_praktikum, deskripsi, semester, image) VALUES ('$nama', '$deskripsi', '$semester', '$image')");
        if ($insert) {
            echo "<p class='text-green-600 mt-4'>Berhasil disimpan. <a href='praktikum.php' class='underline'>Lihat daftar</a></p>";
        } else {
            echo "<p class='text-red-600 mt-4'>Gagal: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</div>
</body>
</html>