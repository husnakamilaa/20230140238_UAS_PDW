<?php
require_once 'config.php'; // koneksi database
?>

<!DOCTYPE html>
<html lang="id">                                                                                                                                                                                                                                                                                            
<head>
  <meta charset="UTF-8">
  <title>SIMPRAK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
    <div class="text-2xl font-bold text-blue-600"></div>
    <a href="login.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
  </nav>

<!-- header -->
<header class="min-h-screen flex flex-col justify-center items-center text-center">
  <h1 class="typing-animation text-6xl font-extrabold text-blue-600 font-mono mb-4">SIMPRAK</h1>
  <h2 class="text-2xl text-gray-700 mb-8">Sistem Informasi Manajemen Praktikum</h2>
  <a href="#praktikum" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 text-lg">Lihat Mata Praktikum</a>
</header>

  <!-- Daftar Praktikum -->
  <<div id="praktikum" class="scroll-mt-20 container mx-auto px-4 pt-5 pb-20">
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
          <a href="login.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Daftar Praktikum</a>
        </div>';
      }
      ?>
      <!-- imagenya disini -->
      <!-- <img src="' . htmlspecialchars($row['image']) . '" alt="Gambar Praktikum" class="w-24 h-24 mb-4 rounded"> -->
    </div>
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
