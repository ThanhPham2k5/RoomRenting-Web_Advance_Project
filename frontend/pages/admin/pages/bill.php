<?php 
    $bills = $bills ?? [];
    $paginationMeta = $paginationMeta ?? [];
    $query = $paginationMeta['query'] ?? '';
    $currentTable = $_GET['table'] ?? "1";
    $invoiceDetailForm = "model-chi-tiet-hoa-don-thanh-toan";
    $rechargeDetailForm = "model-chi-tiet-hoa-don-nap-tien";
    $titleData = ['titleContent' => "Hóa đơn", 'group' => false, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => false];
    $tableHeader = ['ID', 'ID tài khoản', 'ID bài đăng', 'Điểm', 'Thời gian', 'Tình trạng', 'Chi tiết'];
    $tableHeader1 = ['ID', 'ID tài khoản', 'Số tiền', 'Số điểm', 'Thời gian', 'Tình trạng', 'Chi tiết'];
    $type = ['type' => "1"];
    ob_start(); 
    if(empty($bills)){
        echo '<tr><td colspan="5" style="text-align:center;">Không có dữ liệu hoặc lỗi kết nối máy chủ</td></tr>';
    }else{
        foreach ($bills as $bill){
        $targetModal = ($currentTable === '1') ? $invoiceDetailForm : $rechargeDetailForm;
        ?>
        <tr onclick="selectRow(this)" style="cursor: pointer;">
            <td style="display: none;">
                <input type="radio" name="selectedRow" value="<?php echo $bill['id']; ?>">
            </td>
            <td><?php echo ($bill['id']); ?></td>
            <td><?php echo ($bill['account']['id']); ?></td>
            <?php if(isset($bill['totalMoney'])) echo "<td>" . ($bill['totalMoney']) . "</td>"; ?>
            <?php if(isset($bill['post'])) echo "<td>" . ($bill['post']['id']) . "</td>"; ?>
            <?php if(isset($bill['points'])) echo "<td>" . ($bill['points']) . "</td>"; ?>
            <td><?php echo date('d/m/Y', strtotime($bill['createdAt'])); ?></td>
            <td>
                <?php if ($bill['status'] === 'completed'): ?>
                    <span class="badge badge-success">Đã thanh toán</span>
                <?php elseif ($bill['status'] === 'failed'): ?>
                    <span class="badge badge-danger">Chưa thanh toán</span>
                <?php else: ?>
                    <span class="badge badge-warning">Đang xử lý</span>
                <?php endif; ?>
            </td>
            <td>
                <button class="table-btn" title="Xem chi tiết" onclick="handleView(<?php echo $bill['id']; ?>, '<?php echo $targetModal; ?>')">
                    <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H19C19.2652 0 19.5196 0.105357 19.7071 0.292893C19.8946 0.48043 20 0.734784 20 1C20 1.26522 19.8946 1.51957 19.7071 1.70711C19.5196 1.89464 19.2652 2 19 2H1C0.734784 2 0.48043 1.89464 0.292893 1.70711C0.105357 1.51957 0 1.26522 0 1ZM0 5C0 4.73478 0.105357 4.48043 0.292893 4.29289C0.48043 4.10536 0.734784 4 1 4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8946 4.48043 20 4.73478 20 5C20 5.26522 19.8946 5.51957 19.7071 5.70711C19.5196 5.89464 19.2652 6 19 6H1C0.734784 6 0.48043 5.89464 0.292893 5.70711C0.105357 5.51957 0 5.26522 0 5ZM1 8C0.734784 8 0.48043 8.10536 0.292893 8.29289C0.105357 8.48043 0 8.73478 0 9C0 9.26522 0.105357 9.51957 0.292893 9.70711C0.48043 9.89464 0.734784 10 1 10H13C13.2652 10 13.5196 9.89464 13.7071 9.70711C13.8946 9.51957 14 9.26522 14 9C14 8.73478 13.8946 8.48043 13.7071 8.29289C13.5196 8.10536 13.2652 8 13 8H1Z" fill="currentColor"/>
                    </svg>
                </button>
            </td>
        </tr>
    <?php 
        }
    } 
    $tbodyHtml = ob_get_clean();

    $tableData = ['tableTitle' =>"Thông tin hóa đơn thanh toán", 'tableHeader' => $tableHeader, 'time' => true, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
    $tableData1 = ['tableTitle' =>"Thông tin hóa đơn nạp tiền", 'tableHeader' => $tableHeader1, 'time' => true, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
?>

<div class="bill-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false,$type) ?>
        <div class="line"></div>
        <div class="tab-pane">
            <a href="index.php?page=bill&table=1<?php if(isset($query)) echo '&' . $query; ?>" class="item <?php echo ($currentTable === '1') ? 'active' : ''; ?>">HÓA ĐƠN THANH TOÁN</a>
            <a href="index.php?page=bill&table=2<?php if(isset($query)) echo '&' . $query; ?>" class="item <?php echo ($currentTable === '2') ? 'active' : ''; ?>">HÓA ĐƠN NẠP TIỀN</a>
        </div>
    </div>
    <?php if($currentTable === '1'){
        renderComponent("table",false,$tableData);
    }else if($currentTable === '2'){
        renderComponent("table",false,$tableData1);
    } ?>
    <?php renderComponent("pagination",false,['paginationMeta' => $paginationMeta]) ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder invoice-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <div class="profile-title">
                <h3 id="view-invoice-title">Chi tiết giao dịch</h3>
                <span class="badge-detail" id="view-invoice-status">Trạng thái</span>
            </div>
        </div>

        <hr class="divider">

        <div class="detail-grid">
            <div class="info-group">
                <label>Mã hóa đơn</label>
                <p id="view-invoice-id" class="info-value" style="font-family: monospace;">#</p>
            </div>
            <div class="info-group">
                <label>Thời gian tạo</label>
                <p id="view-invoice-date" class="info-value">--/--/----</p>
            </div>
            
            <div class="info-group full-width">
                <label>Số điểm đã trừ</label>
                <p id="view-invoice-points" class="info-value invoice-points">+0 Điểm</p>
            </div>
        </div>

        <h4 class="section-sub-title">Thông tin người thanh toán</h4>
        <div class="detail-grid">
            <div class="info-group">
                <label>Tài khoản</label>
                <p id="view-invoice-username" class="info-value">---</p>
            </div>
            <div class="info-group">
                <label>Vai trò</label>
                <p id="view-invoice-role" class="info-value">---</p>
            </div>
        </div>

        <h4 class="section-sub-title">Chi tiết dịch vụ (Bài đăng)</h4>
        <div class="detail-grid">
            <div class="info-group full-width">
                <label>Tiêu đề bài đăng</label>
                <p id="view-invoice-post-title" class="info-value">---</p>
            </div>
            <div class="info-group">
                <label>Mã bài đăng</label>
                <p id="view-invoice-post-id" class="info-value">#</p>
            </div>
            <div class="info-group">
                <label>Giá phòng / Tháng</label>
                <p id="view-invoice-post-price" class="info-value">---</p>
            </div>
            <div class="info-group full-width">
                <label>Địa chỉ</label>
                <p id="view-invoice-post-address" class="info-value">---</p>
            </div>
        </div>
    <?php 
        $invoiceDetailData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Chi tiết hóa đơn thanh toán', 'idModal' => $invoiceDetailForm, 'formData' => $invoiceDetailData, 'save' => false]) ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder recharge-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4Z"></path>
                </svg>
            </div>
            <div class="profile-title">
                <h3 id="view-recharge-title">Chi tiết nạp tiền</h3>
                <span class="badge-detail" id="view-recharge-status">Trạng thái</span>
            </div>
        </div>

        <hr class="divider">

        <div class="detail-grid">
            <div class="info-group">
                <label>Mã giao dịch</label>
                <p id="view-recharge-id" class="info-value" style="font-family: monospace; color: #4F46E5;">#</p>
            </div>
            <div class="info-group">
                <label>Thời gian nạp</label>
                <p id="view-recharge-date" class="info-value">--/--/----</p>
            </div>
        </div>

        <h4 class="section-sub-title">Chi tiết thanh toán</h4>
        <div class="detail-grid" style="background-color: #F8FAFC; padding: 16px; border-radius: 8px; border: 1px solid #E2E8F0;">
            <div class="info-group">
                <label>Số tiền gốc</label>
                <p id="view-recharge-money" class="info-value">0 đ</p>
            </div>
            <div class="info-group">
                <label>Thuế VAT (10%)</label>
                <p id="view-recharge-vat" class="info-value" style="color: #64748B;">0 đ</p>
            </div>
            <div class="info-group full-width">
                <label>Tổng tiền thanh toán</label>
                <p id="view-recharge-total" class="info-value" style="font-size: 1.8rem; color: #DC2626; font-weight: 700;">0 đ</p>
            </div>
            <div class="info-group full-width" style="margin-top: 8px; border-top: 1px dashed #CBD5E1; padding-top: 12px;">
                <label>Số điểm nhận được</label>
                <p id="view-recharge-points" class="info-value recharge-points">+0 Điểm</p>
            </div>
        </div>

        <h4 class="section-sub-title">Thông tin tài khoản & Gói nạp</h4>
        <div class="detail-grid">
            <div class="info-group">
                <label>Tài khoản nạp</label>
                <p id="view-recharge-username" class="info-value">---</p>
            </div>
            <div class="info-group">
                <label>Vai trò</label>
                <p id="view-recharge-role" class="info-value">---</p>
            </div>
            <div class="info-group full-width">
                <label>Gói nạp áp dụng (Recharge Rule)</label>
                <div id="view-recharge-rule" class="info-value description-box" style="min-height: auto; padding: 12px;">
                    ---
                </div>
            </div>
        </div>
    <?php 
        $rechargeDetailData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Chi tiết hóa đơn nạp tiền', 'idModal' => $rechargeDetailForm, 'formData' => $rechargeDetailData, 'save' => false]) ?>
</div>
</div>