<?php include '../../config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Tambah Anggota</h2>

    <form method="POST" class="space-y-4">
        <input type="text" name="nama" placeholder="Nama" class="w-full border p-2 rounded" required>
        <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded" required>
        <select name="role" class="w-full border p-2 rounded" required>
            <option value="">Pilih Role</option>
            <option value="asisten">Asisten</option>
            <option value="mahasiswa">Mahasiswa</option>
        </select>
        <div class="flex gap-2">
            <button type="submit" name="simpan" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="anggota.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $insert = mysqli_query($conn, "INSERT INTO users (nama, email, password, role, created_at) VALUES ('$nama', '$email', '$password', '$role', NOW())");
        if ($insert) {
            echo "<p class='text-green-600 mt-4'>Berhasil disimpan.</p>";
        } else {
            echo "<p class='text-red-600 mt-4'>Gagal: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</div>
</body>
</html>
