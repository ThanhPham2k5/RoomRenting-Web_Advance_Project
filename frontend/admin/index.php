<?php
require_once __DIR__ . '/core/function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="assets/css/reset.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/searchbar.css" />
    <link rel="stylesheet" href="assets/css/header.css" />
    <link rel="stylesheet" href="assets/css/navigation.css" />
    <link rel="stylesheet" href="assets/css/table.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/overview.css" />
    <link rel="stylesheet" href="assets/css/title.css" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/account.css" />
    <link rel="stylesheet" href="assets/css/permission.css" />
</head>
<body>
    <div class="index-content">
        <div class="nav">
            <?php renderComponent("navigation",false) ?>
        </div>

        <div class="main-page">
            <?php
            renderComponent('permission', true);
            ?>
        </div>
    </div>
</body>
</html>