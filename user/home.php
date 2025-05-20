<?php
$pageTitle = "Beranda - SembodoSehat";

ob_start();
include __DIR__ . '/../includes/herosection_home.php';
include __DIR__ . '/../includes/artikelterbaru_home.php';
include __DIR__ . '/../includes/about_home.php';
$content = ob_get_clean();

$showNavbar = true;
$showFooter = true;

include __DIR__ . '/../includes/app.php';
