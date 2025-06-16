<?php
session_start();
session_destroy();
header("Location: user/home.php");
exit;
?>
