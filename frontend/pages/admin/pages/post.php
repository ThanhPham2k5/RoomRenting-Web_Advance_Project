<?php 
$titleData = ['titleContent' => "Bài đăng", 'group' => false, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => false];
?>

<div class="post-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false) ?>
        <div class="line"></div>
        <div class="tab-pane">
            <p class="item active">ĐANG HIỂN THỊ (0)</p>
            <p class="item">BỊ TỪ CHỐI (0)</p>
            <p class="item">CHỜ DUYỆT (0)</p>
            <p class="item">HẾT HẠN (0)</p>
            <p class="item">BỊ XÓA (0)</p>
        </div>
    </div>
    <div class="post-list">
        <?php renderComponent("postcontainer",false) ?>
        <?php renderComponent("pagination",false) ?>
    </div>
</div>