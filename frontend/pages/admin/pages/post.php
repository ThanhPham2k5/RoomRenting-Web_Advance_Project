<?php 
$posts = $posts ?? [];
$paginationMeta = $paginationMeta ?? [];
$currentTable = $_GET['table'] ?? "1";
$titleData = ['titleContent' => "Bài đăng", 'group' => false, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => false];
?>

<div class="post-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false) ?>
        <div class="line"></div>
        <div class="tab-pane">
            <a href="index.php?page=post&table=1" class="item <?php echo ($currentTable === '1') ? 'active' : ''; ?>">ĐANG HIỂN THỊ</a>
            <a href="index.php?page=post&table=2" class="item <?php echo ($currentTable === '2') ? 'active' : ''; ?>">BỊ TỪ CHỐI</a>
            <a href="index.php?page=post&table=3" class="item <?php echo ($currentTable === '3') ? 'active' : ''; ?>">CHỜ DUYỆT</a>
            <a href="index.php?page=post&table=4" class="item <?php echo ($currentTable === '4') ? 'active' : ''; ?>">HẾT HẠN</a>
            <a href="index.php?page=post&table=5" class="item <?php echo ($currentTable === '5') ? 'active' : ''; ?>">BỊ XÓA</a>
        </div>
    </div>
    <div class="post-list">
        <?php renderComponent("postcontainer",false,['posts' => $posts]) ?>
        <?php renderComponent("pagination",false,['paginationMeta' => $paginationMeta]) ?>
    </div>
    <?php renderComponent("postdetail",false) ?>
</div>