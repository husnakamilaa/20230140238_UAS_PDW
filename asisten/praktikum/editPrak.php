<?php 
include '../../config.php'; 
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM praktikum WHERE id_praktikum = $id");
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Praktikum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Praktikum</h2>

    <form method="POST" class="space-y-4">
        <input type="text" name="nama_praktikum" value="<?= $data['nama_praktikum'] ?>" class="w-full border p-2 rounded" required>
        <textarea name="deskripsi" class="w-full border p-2 rounded" required><?= $data['deskripsi'] ?></textarea>
        <input type="number" name="semester" value="<?= $data['semester'] ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="image" value="<?= $data['image'] ?>" class="w-full border p-2 rounded">
        <div class="flex gap-2">
            <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
            <a href="praktikum.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama_praktikum'];
        $deskripsi = $_POST['deskripsi'];
        $semester = $_POST['semester'];
        $image = $_POST['image'];

        $update = mysqli_query($conn, "UPDATE praktikum SET nama_praktikum='$nama', deskripsi='$deskripsi', semester='$semester', image='$image' WHERE id_praktikum=$id");
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