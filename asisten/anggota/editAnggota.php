<?php include '../../config.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$anggota = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Anggota</h2>

    <form method="POST" class="space-y-4">
        <input type="text" name="nama" value="<?= $anggota['nama'] ?>" placeholder="Nama" class="w-full border p-2 rounded" required>
        <input type="email" name="email" value="<?= $anggota['email'] ?>" placeholder="Email" class="w-full border p-2 rounded" required>
        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ubah password" class="w-full border p-2 rounded">
        <select name="role" class="w-full border p-2 rounded" required>
            <option value="asisten" <?= $anggota['role'] == 'asisten' ? 'selected' : '' ?>>Asisten</option>
            <option value="mahasiswa" <?= $anggota['role'] == 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
        </select>
        <div class="flex gap-2">
            <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
            <a href="anggota.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $query = "UPDATE users SET nama='$nama', email='$email', role='$role'";

        if (!empty($_POST['password'])) {
            $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query .= ", password='$hashed'";
        }

        $query .= " WHERE id='$id'";

        $update = mysqli_query($conn, $query);
        if ($update) {
            echo "<p class='text-green-600 mt-4'>Berhasil diupdate.</p>";
        } else {
            echo "<p class='text-red-600 mt-4'>Gagal: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</div>
</body>
</html>
