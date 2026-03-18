<?php
require_once __DIR__ . '/core/function.php';

$page = $_GET['page'] ?? 'overview';
$validPage = ['overview', 'account', 'bill', 'comment', 'permission', 'post', 'price', 'sale'];

if(!in_array($page, $validPage)){
    $page = "overview";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../../css/admin/reset.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin/searchbar.css" />
    <link rel="stylesheet" href="../../css/admin/header.css" />
    <link rel="stylesheet" href="../../css/admin/navigation.css" />
    <link rel="stylesheet" href="../../css/admin/table.css" />
    <link rel="stylesheet" href="../../css/admin/main.css" />
    <link rel="stylesheet" href="../../css/admin/overview.css" />
    <link rel="stylesheet" href="../../css/admin/title.css" />
    <link rel="stylesheet" href="../../css/admin/index.css" />
    <link rel="stylesheet" href="../../css/admin/account.css" />
    <link rel="stylesheet" href="../../css/admin/permission.css" />
    <link rel="stylesheet" href="../../css/admin/sale.css" />
    <link rel="stylesheet" href="../../css/admin/comment.css" />
    <link rel="stylesheet" href="../../css/admin/bill.css" />
    <link rel="stylesheet" href="../../css/admin/price.css" />
    <link rel="stylesheet" href="../../css/admin/card.css" />
    <link rel="stylesheet" href="../../css/admin/pagination.css" />
    <link rel="stylesheet" href="../../css/admin/postcontainer.css" />
    <link rel="stylesheet" href="../../css/admin/postcontainer.css" />
    <link rel="stylesheet" href="../../css/admin/post.css" />
    <link rel="stylesheet" href="../../css/admin/form.css" />
</head>
<body>
    <?php renderComponent("form",false) ?>
    <div class="index-content">
        <div class="nav">
            <?php renderComponent("navigation",false, ['currentPage' => $page]) ?> 
        </div>

        <div class="main-page">
            <?php
            renderComponent($page, true);
            ?>
        </div>
    </div>
</body>
<script>
    function openModal(idModal) {
        document.getElementById(idModal).style.display = 'flex';
    }
    function closeModal(idModal) {
        document.getElementById(idModal).style.display = 'none';
    }
</script>
</html>