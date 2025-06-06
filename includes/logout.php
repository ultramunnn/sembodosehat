<?php
include __DIR__ . '/../config/auth.php';
session_start();
session_destroy();
header("Location: home.php");
exit;
?>