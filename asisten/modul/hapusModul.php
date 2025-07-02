<?php
include '../../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = mysqli_query($conn, "SELECT file FROM modul WHERE id='$id'");
    $modul = mysqli_fetch_assoc($data);
    if ($modul && file_exists("file/" . $modul['file'])) {
        unlink("file/" . $modul['file']);
    }
    mysqli_query($conn, "DELETE FROM modul WHERE id='$id'");
    header('Location: modul.php');
}
?>
