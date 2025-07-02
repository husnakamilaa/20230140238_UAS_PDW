<?php
include '../../config.php';
$id = intval($_GET['id']); // Sanitasi id

$data = mysqli_query($conn, "SELECT * FROM modul WHERE id='$id'");
$modul = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Modul</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Edit Modul</h2>

    <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <!-- Dropdown Praktikum -->
        <select name="id_praktikum" class="w-full border p-2 rounded" required>
            <option value="">Pilih Praktikum</option>
            <?php
            $praktikum = mysqli_query($conn, "SELECT id_praktikum, nama_praktikum FROM praktikum");
            while ($row = mysqli_fetch_assoc($praktikum)) {
                $selected = ($row['id_praktikum'] == $modul['id_praktikum']) ? 'selected' : '';
                echo "<option value='{$row['id_praktikum']}' $selected>{$row['nama_praktikum']}</option>";
            }
            ?>
        </select>

        <!-- Input Judul & Deskripsi -->
        <input type="text" name="judul" value="<?= htmlspecialchars($modul['judul']) ?>" class="w-full border p-2 rounded" required>
        <textarea name="deskripsi" class="w-full border p-2 rounded"><?= htmlspecialchars($modul['deskripsi']) ?></textarea>

        <!-- File -->
        <p>File saat ini:
            <a href="file/<?= htmlspecialchars($modul['file']) ?>" class="text-blue-600 underline" download><?= htmlspecialchars($modul['file']) ?></a>
        </p>
        <input type="file" name="file" class="w-full border p-2 rounded">

        <!-- Tombol -->
        <div class="flex gap-2">
            <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
            <a href="modul.php" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $judul = mysqli_real_escape_string($conn, $_POST['judul']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
        $id_praktikum = $_POST['id_praktikum'];
        $updateQuery = "UPDATE modul SET judul='$judul', deskripsi='$deskripsi', id_praktikum='$id_praktikum'";

        if (!empty($_FILES['file']['name'])) {
            $folder = 'modul/file/';
            $namaBaru = time() . '_' . basename($_FILES['file']['name']);
            $tmp = $_FILES['file']['tmp_name'];

            if (move_uploaded_file($tmp, $folder . $namaBaru)) {
                $updateQuery .= ", file='$namaBaru'";
            } else {
                echo "<p class='text-red-600 mt-4'>Gagal upload file baru.</p>";
            }
        }

        $updateQuery .= " WHERE id='$id'";
        $update = mysqli_query($conn, $updateQuery);

        echo $update
            ? "<p class='text-green-600 mt-4'>Modul berhasil diupdate.</p>"
            : "<p class='text-red-600 mt-4'>Gagal update: " . mysqli_error($conn) . "</p>";
    }
    ?>
</div>
</body>
</html>
