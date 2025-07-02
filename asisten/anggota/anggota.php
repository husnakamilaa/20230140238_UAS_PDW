<?php 
include '../../config.php'; 
require_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Anggota</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Daftar Anggota</h2>

        <form method="GET" class="mb-4 flex items-center gap-2">
            <input type="text" name="search" placeholder="Cari anggota" class="border p-2 rounded w-full">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Cari</button>
            <a href="tambahAnggota.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah</a>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Password</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                    $query = "SELECT * FROM users";
                    if ($search != '') {
                        $query .= " WHERE nama LIKE '%$search%' OR role LIKE '%$search%'";
                    }
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2"><?= $row['id'] ?></td>
                        <td class="border px-4 py-2"><?= $row['nama'] ?></td>
                        <td class="border px-4 py-2"><?= $row['email'] ?></td>
                        <td class="border px-4 py-2"><?= $row['password'] ?></td>
                        <td class="border px-4 py-2"><?= $row['role'] ?></td>
                        <td class="border px-4 py-2"><?= $row['created_at'] ?></td>
                        <td class="border px-4 py-2 flex gap-2">
                            <a href="editAnggota.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                            <a href="hapusAnggota.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

          <!-- Tombol Scroll ke Atas -->
<a href="#" id="scroll-top"
   class="hidden fixed bottom-5 right-5 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg z-50">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"
       stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 15l7-7 7 7"/>
  </svg>
</a>

<script>
  const scrollTopBtn = document.getElementById("scroll-top");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 100) {
      scrollTopBtn.classList.remove("hidden");
    } else {
      scrollTopBtn.classList.add("hidden");
    }
  });

  scrollTopBtn.addEventListener("click", function (e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
</script>
</body>
</html>
