<?php 

include __DIR__ ."/../config/functions_tambahartikel.php";

$id = $_GET['id'];
hapus_artikel($conn, $id);
header("Location: ../admin/index.php?page=dashboard.php");

?>