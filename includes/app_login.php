<?php
// includes/app.php
if (!isset($pageTitle))
    $pageTitle = "SembodoSehat";
if (!isset($content))
    $content = "<p>Konten belum tersedia.</p>";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="assets/css/output.css" rel="stylesheet" />
  
</head>

<body>

    <?= $content ?>

 
</body>

</html>