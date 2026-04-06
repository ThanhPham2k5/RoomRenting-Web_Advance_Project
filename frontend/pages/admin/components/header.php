<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $adminName = $_SESSION['admin_user'] ?? "";
    $adminRole = $_SESSION['admin_role'] ?? "";
    $adminAvatar = $_SESSION['user_avatar'] ?? "../../assets/admin/images/avatar.png";
?>

<div class="header-component">
    <div class="main-content">
        <div class="info">
            <img src="<?php echo $adminAvatar ?>" alt="avatar">
            <div class="desc">
                <p><?php echo $adminName ?></p>
                <p>Chức vụ: <?php echo $adminRole ?></p>
            </div>
        </div>
    </div>
</div>