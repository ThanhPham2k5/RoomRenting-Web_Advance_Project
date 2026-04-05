<?php 
    $currentKeyword = $_GET['filter']['all'] ?? '';
    $comments = $comments ?? [];
    $paginationMeta = $paginationMeta ?? [];
    $commentDetailForm = "model-chi-tiet-binh-luan";
    $titleData = ['titleContent' => "Bình luận", 'group' => false, 'insert' => false, 'edit' => false, 'delete' => true, 'handle' => false];
    $tableHeader = ['Người bình luận', 'Nội dung bình luận', 'ID bài đăng', 'Thời gian', 'Chi tiết'];
    $type = ['type' => "1", 'keyword' => $currentKeyword];
    ob_start(); 
    if(empty($comments)){
        echo '<tr><td colspan="5" style="text-align:center;">Không có dữ liệu hoặc lỗi kết nối máy chủ</td></tr>';
    }else{
        foreach ($comments as $comment){
            if(!isset($comment['deletedAt'])){
    ?>
        <tr onclick="selectRow(this)" style="cursor: pointer;">
            <td style="display: none;">
                <input type="radio" name="selectedRow" value="<?php echo $comment['id']; ?>">
            </td>
            <td class="user-name"><?php echo ($comment['account']['username']); ?></td>
            <td><?php echo ($comment['content']); ?></td>
            <td><?php echo ($comment['account']['id']); ?></td>
            <td><?php echo date('d/m/Y', strtotime($comment['createdAt'])); ?></td>
            <td>
                <button class="table-btn" title="Xem chi tiết" onclick="handleView(<?php echo $comment['id']; ?>, '<?php echo $commentDetailForm; ?>')">
                    <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H19C19.2652 0 19.5196 0.105357 19.7071 0.292893C19.8946 0.48043 20 0.734784 20 1C20 1.26522 19.8946 1.51957 19.7071 1.70711C19.5196 1.89464 19.2652 2 19 2H1C0.734784 2 0.48043 1.89464 0.292893 1.70711C0.105357 1.51957 0 1.26522 0 1ZM0 5C0 4.73478 0.105357 4.48043 0.292893 4.29289C0.48043 4.10536 0.734784 4 1 4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8946 4.48043 20 4.73478 20 5C20 5.26522 19.8946 5.51957 19.7071 5.70711C19.5196 5.89464 19.2652 6 19 6H1C0.734784 6 0.48043 5.89464 0.292893 5.70711C0.105357 5.51957 0 5.26522 0 5ZM1 8C0.734784 8 0.48043 8.10536 0.292893 8.29289C0.105357 8.48043 0 8.73478 0 9C0 9.26522 0.105357 9.51957 0.292893 9.70711C0.48043 9.89464 0.734784 10 1 10H13C13.2652 10 13.5196 9.89464 13.7071 9.70711C13.8946 9.51957 14 9.26522 14 9C14 8.73478 13.8946 8.48043 13.7071 8.29289C13.5196 8.10536 13.2652 8 13 8H1Z" fill="currentColor"/>
                    </svg>
                </button>
            </td>
        </tr>
    <?php 
            }
        }
    }
    $tbodyHtml = ob_get_clean();

    $tableData = ['tableTitle' =>"Kiểm duyệt bình luận", 'tableHeader' => $tableHeader, 'time' => true, 'status' => false, 'tbodyHtml' => $tbodyHtml];
?>

<div class="comment-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false,$type) ?>
    </div>
    <?php renderComponent("table",false,$tableData) ?>
    <?php renderComponent("pagination",false,['paginationMeta' => $paginationMeta]) ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder comment-icon" id="view-comment-avatar-text">U</div>
            <div class="profile-title">
                <h3 id="view-comment-username">Tên người dùng</h3>
                <span class="badge-detail badge-detail-role" id="view-comment-role">Vai trò</span>
            </div>
        </div>

        <hr class="divider">

        <div class="detail-grid">
            <div class="info-group">
                <label>ID Bình luận</label>
                <p id="view-comment-id" class="info-value">#</p>
            </div>
            <div class="info-group">
                <label>Trạng thái</label>
                <p id="view-comment-status" class="info-value"><span class="badge-detail">Trạng thái</span></p>
            </div>
            <div class="info-group">
                <label>Ngày bình luận</label>
                <p id="view-comment-date" class="info-value">--/--/----</p>
            </div>
            <div class="info-group">
                <label>ID Người đăng</label>
                <p id="view-comment-account-id" class="info-value">#</p>
            </div>
            
            <div class="info-group full-width">
                <label>Nội dung chi tiết</label>
                <div id="view-comment-content" class="info-value comment-content-box">
                    Nội dung bình luận sẽ hiển thị ở đây...
                </div>
            </div>
        </div>
    <?php 
        $commentDetailData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Chi tiết bình luận', 'idModal' => $commentDetailForm, 'formData' => $commentDetailData, 'save' => false]) ?>
</div>