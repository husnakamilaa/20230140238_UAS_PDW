<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    header('Location: anggota.php');
} else {
    echo "ID tidak ditemukan!";
}
?>
