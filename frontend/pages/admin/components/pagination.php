<?php
    $meta = $paginationMeta ?? [];
    $currentPage = (int)($meta['current_page'] ?? 1);
    $lastPage = (int)($meta['last_page'] ?? 1);
    $baseUrl = $meta['base_url'] ?? '#';

    if ($lastPage <= 1) {
        return; 
    }

    $maxButtons = 3;

    // Tính điểm bắt đầu (Luôn ưu tiên trang hiện tại nằm giữa)
    $startPage = max(1, $currentPage - 1);
    
    // Tính điểm kết thúc dựa vào điểm bắt đầu
    $endPage = min($lastPage, $startPage + $maxButtons - 1);

    // Xử lý góc viền: Khi đang ở những trang cuối cùng, cần lùi điểm bắt đầu lại 
    // để luôn đảm bảo hiển thị đủ 3 nút (nếu tổng số trang >= 3)
    if ($endPage - $startPage + 1 < $maxButtons) {
        $startPage = max(1, $endPage - $maxButtons + 1);
    }
?>

<div class="pagination-component">
    <div class="main-content">
        
        <?php if ($currentPage > 1): ?>
            <a href="<?php echo $baseUrl . '&p=1'; ?>" style="color: inherit; display: flex; align-items: center;">
                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.5 12L12.7 11L8.19995 6L12.7 1L11.6 0L6.09995 6L11.5 12ZM5.49995 12L6.59995 11L2.09995 6L6.59995 1L5.49995 0L-4.95911e-05 6L5.49995 12Z" fill="currentColor"/>
                </svg>
            </a>
            
            <a href="<?php echo $baseUrl . '&p=' . ($currentPage - 1); ?>" style="color: inherit; display: flex; align-items: center;">
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.4001 12L6.6001 11L2.0001 6L6.6001 1L5.4001 0L9.72748e-05 6L5.4001 12Z" fill="currentColor"/>
                </svg>
            </a>
        <?php else: ?>
            <span style="opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                <svg width="13" height="12" viewBox="0 0 13 12" fill="none"><path d="M11.5 12L12.7 11L8.19995 6L12.7 1L11.6 0L6.09995 6L11.5 12ZM5.49995 12L6.59995 11L2.09995 6L6.59995 1L5.49995 0L-4.95911e-05 6L5.49995 12Z" fill="currentColor"/></svg>
            </span>
            <span style="opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none"><path d="M5.4001 12L6.6001 11L2.0001 6L6.6001 1L5.4001 0L9.72748e-05 6L5.4001 12Z" fill="currentColor"/></svg>
            </span>
        <?php endif; ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <a href="<?php echo $baseUrl . '&p=' . $i; ?>" 
               class="btn <?php echo ($i === $currentPage) ? 'active' : ''; ?>"
               style="text-decoration: none; color: inherit; display: flex; align-items: center; justify-content: center;">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($currentPage < $lastPage): ?>
            <a href="<?php echo $baseUrl . '&p=' . ($currentPage + 1); ?>" style="color: inherit; display: flex; align-items: center;">
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.2 0L0 1L4.6 6L0 11L1.2 12L6.6 6L1.2 0Z" fill="currentColor"/>
                </svg>
            </a>
            
            <a href="<?php echo $baseUrl . '&p=' . $lastPage; ?>" style="color: inherit; display: flex; align-items: center;">
                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.2 0L0 1L4.5 6L0 11L1.1 12L6.6 6L1.2 0ZM7.2 0L6.1 1L10.6 6L6.1 11L7.2 12L12.7 6L7.2 0Z" fill="currentColor"/>
                </svg>
            </a>
        <?php else: ?>
            <span style="opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none"><path d="M1.2 0L0 1L4.6 6L0 11L1.2 12L6.6 6L1.2 0Z" fill="currentColor"/></svg>
            </span>
            <span style="opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                <svg width="13" height="12" viewBox="0 0 13 12" fill="none"><path d="M1.2 0L0 1L4.5 6L0 11L1.1 12L6.6 6L1.2 0ZM7.2 0L6.1 1L10.6 6L6.1 11L7.2 12L12.7 6L7.2 0Z" fill="currentColor"/></svg>
            </span>
        <?php endif; ?>

    </div>
</div>  