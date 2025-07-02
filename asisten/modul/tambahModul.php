<?php include '../../config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Modul</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Modul</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <!-- Dropdown Praktikum -->
        <select name="id_praktikum" class="w-full border p-2 rounded" required>
            <option value="">Pilih Praktikum</option>
            <?php
            $praktikum = mysqli_query($conn, "SELECT id_praktikum, nama_praktikum FROM praktikum");
            if ($praktikum && mysqli_num_rows($praktikum) > 0) {
                while ($row = mysqli_fetch_assoc($praktikum)) {
                    echo "<option value='{$row['id_praktikum']}'>{$row['nama_praktikum']}</option>";
                }
            } else {
                echo "<option disabled>Data praktikum belum tersedia</option>";
            }
            ?>
        </select>

        <!-- Input Judul & Deskripsi -->
        <input type="text" name="judul" placeholder="Judul Modul" class="w-full border p-2 rounded" required>
        <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border p-2 rounded"></textarea>
        <input type="file" name="file" class="w-full border p-2 rounded" required>

        <!-- Tombol -->
        <div class="flex gap-2 pt-2">
            <button type="submit" name="simpan" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="modul.php" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $id_praktikum = $_POST['id_praktikum'];
        $judul = mysqli_real_escape_string($conn, $_POST['judul']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

        $file = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $folder = 'modul/file/';
        $namaSimpan = time() . '_' . basename($file); // Hindari path injection

        if (move_uploaded_file($tmp, $folder . $namaSimpan)) {
            $query = mysqli_query($conn, "INSERT INTO modul (id_praktikum, judul, deskripsi, file) VALUES ('$id_praktikum', '$judul', '$deskripsi', '$namaSimpan')");
            if ($query) {
                echo "<p class='text-green-600 mt-4'>Modul berhasil ditambahkan.</p>";
            } else {
                echo "<p class='text-red-600 mt-4'>Gagal menyimpan ke database: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p class='text-red-600 mt-4'>Gagal upload file ke folder.</p>";
        }
    }
    ?>
</div>
</body>
</html>
