<?php 
include '../../config.php'; 
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM praktikum WHERE id_praktikum = $id");
header("Location: praktikum.php");
exit();