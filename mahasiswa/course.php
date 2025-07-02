<?php
include '../config.php'; // koneksi ke database
require_once 'templates/header_mahasiswa.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cari Praktikum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div class="scroll-mt-20 container mx-auto px-4 pt-5 pb-20">
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-10">DAFTAR MATA PRAKTIKUM</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      <?php
      $sql = "SELECT * FROM praktikum";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center text-center hover:shadow-lg transition">
          <h2 class="text-lg font-semibold text-gray-800">' . htmlspecialchars($row['nama_praktikum']) . '</h2>
          <p class="text-sm text-gray-600 mb-4">Semester: ' . htmlspecialchars($row['semester']) . '</p>
          <a href="daftar_praktikum.php?id_praktikum=' . $row['id_praktikum'] . '" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Daftar Praktikum</a>
        </div>';
      }
      ?>
      <!-- imagenya disini -->
      <!-- <img src="' . htmlspecialchars($row['image']) . '" alt="Gambar Praktikum" class="w-24 h-24 mb-4 rounded"> -->
    </div>
  </div>
  </div>
</body>
</html>
