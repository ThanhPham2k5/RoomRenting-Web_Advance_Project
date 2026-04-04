<?php 
    $rules = $rules ?? [];
    $paginationMeta = $paginationMeta ?? [];
    $currentTable = $_GET['table'] ?? "1";
    $priceInsertForm = "modal-them-gia-dang-bai";
    $priceEditForm = "modal-sua-gia-dang-bai";
    $priceInsertForm1 = "modal-them-gia-quy-doi";
    $priceEditForm1 = "modal-sua-gia-quy-doi";
    $pricingDetailForm = "modal-chi-tiet-gia-dang-bai";
    $exchangeDetailForm = "modal-chi-tiet-gia-tri-quy-doi-diem";
    $titleData = ['targetModal' => $priceInsertForm, 'targetModal1' => $priceEditForm, 'targetModal2' => $priceInsertForm1, 'targetModal3' => $priceEditForm1, 'titleContent' => "Giá cả", 'group' => false, 'insert' => true, 'edit' => false, 'delete' => false, 'handle' => false, 'restore' => true];
    $tableHeader = ['Id', 'Điểm', 'Ngày khởi tạo', 'Tình trạng', 'Chi tiết'];
    $tableHeader1 = ['Id', 'Số tiền', 'Điểm', 'Ngày khởi tạo', 'Tình trạng', 'Chi tiết'];
    $type = ['type' => "1"];
    ob_start(); 
    if(empty($rules)){
        echo '<tr><td colspan="5" style="text-align:center;">Không có dữ liệu hoặc lỗi kết nối máy chủ</td></tr>';
    }else{
        foreach ($rules as $rule){
            $targetModal = ($currentTable === '1') ? $pricingDetailForm : $exchangeDetailForm;
        ?>
        <tr onclick="selectRow(this)" style="cursor: pointer;">
            <td style="display: none;">
                <input type="radio" name="selectedRow" value="<?php echo $rule['id']; ?>">
            </td>
            <td><?php echo ($rule['id']); ?></td>
            <?php if(isset($rule['money'])) echo "<td>" . ($rule['money']) . "</td>"; ?>
            <td><?php echo ($rule['points']); ?></td>
            <td><?php echo date('d/m/Y', strtotime($rule['createdAt'])); ?></td>
            <td>
                    <?php if (($rule['deletedAt']) === null): ?>
                        <span class="badge badge-success">Đang hoạt động</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Dừng hoạt động</span>
                    <?php endif; ?>
                </td>
            <td>
                <button class="table-btn" title="Xem chi tiết" onclick="handleView(<?php echo $rule['id']; ?>, '<?php echo $targetModal; ?>')">
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

    $tableData = ['tableTitle' =>"Thông tin giá đăng bài", 'tableHeader' => $tableHeader, 'time' => true, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
    $tableData1 = ['tableTitle' =>"Thông tin giá trị quy đổi", 'tableHeader' => $tableHeader1, 'time' => true, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
?>

<div class="price-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false,$type) ?>
        <div class="line"></div>
        <div class="tab-pane">
            <a href="index.php?page=price&table=1" class="item <?php echo ($currentTable === '1') ? 'active' : ''; ?>">GIÁ ĐĂNG BÀI</a>
            <a href="index.php?page=price&table=2" class="item <?php echo ($currentTable === '2') ? 'active' : ''; ?>">GIÁ TRỊ QUY ĐỔI ĐIỂM</a>
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
        <input type="hidden" name="action" value="addPricePost">
    
        <div class="input-group">
            <label>Số điểm</label>
            <input type="text" name="points" placeholder="Nhập số điểm...">
        </div>
    <?php 
        $formInsertData = ob_get_clean();
    ?>
    <?php
    ob_start();
    ?>
        <input type="hidden" name="action" value="addPriceExchange">
    
        <div class="input-group">
            <label>Số điểm</label>
            <input type="text" name="points" placeholder="Nhập số điểm...">
        </div>
        <div class="input-group">
            <label>Số tiền</label>
            <input type="text" name="money" placeholder="Nhập số tiền...">
        </div>
    <?php 
        $formInsertData1 = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Thêm giá đăng bài', 'idModal' => $priceInsertForm, 'formData' => $formInsertData]) ?>
    <?php renderComponent("form",false,['title' => 'Thêm giá quy đổi', 'idModal' => $priceInsertForm1, 'formData' => $formInsertData1]) ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder pricing-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                    <line x1="7" y1="7" x2="7.01" y2="7"></line>
                </svg>
            </div>
            <div class="profile-title">
                <h3 id="view-pricing-title">Cấu hình giá đăng bài</h3>
                <span class="badge-detail" id="view-pricing-status">Trạng thái</span>
            </div>
        </div>

        <hr class="divider">

        <div class="detail-grid">
            <div class="info-group">
                <label>ID Cấu hình</label>
                <p id="view-pricing-id" class="info-value" style="font-family: monospace;">#</p>
            </div>
            <div class="info-group">
                <label>Ngày tạo</label>
                <p id="view-pricing-created" class="info-value">--/--/----</p>
            </div>
            
            <div class="info-group full-width" style="background-color: #EEF2FF; padding: 16px; border-radius: 8px; border: 1px dashed #C7D2FE; margin-top: 10px;">
                <label>Mức phí đăng bài</label>
                <p id="view-pricing-points" class="info-value pricing-points">0 Điểm</p>
            </div>

            <div class="info-group full-width" id="view-pricing-deleted-group" style="display: none; margin-top: 10px;">
                <label style="color: #DC2626;">Thời gian ngừng áp dụng (Đã xóa)</label>
                <p id="view-pricing-deleted" class="info-value" style="color: #EF4444; font-weight: 500;">--/--/----</p>
            </div>
        </div>
    <?php 
        $pricingDetailData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Thêm giá quy đổi', 'idModal' => $pricingDetailForm, 'formData' => $pricingDetailData]) ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder exchange-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 3h5v5"></path>
                    <path d="M21 3l-7 7"></path>
                    <path d="M8 21H3v-5"></path>
                    <path d="M3 21l7-7"></path>
                </svg>
            </div>
            <div class="profile-title">
                <h3 id="view-exchange-title">Chi tiết gói quy đổi</h3>
                <span class="badge-detail" id="view-exchange-status">Trạng thái</span>
            </div>
        </div>

        <hr class="divider">

        <div class="detail-grid">
            <div class="info-group">
                <label>ID Gói</label>
                <p id="view-exchange-id" class="info-value" style="font-family: monospace;">#</p>
            </div>
            <div class="info-group">
                <label>Ngày tạo</label>
                <p id="view-exchange-created" class="info-value">--/--/----</p>
            </div>
            
            <div class="info-group full-width" style="background-color: #F0FDFA; padding: 16px; border-radius: 8px; border: 1px solid #99F6E4; margin-top: 10px;">
                <label>Tỷ lệ quy đổi nạp tiền</label>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 8px;">
                    <div>
                        <span style="font-size: 0.9rem; color: #64748B;">Số tiền nạp</span>
                        <p id="view-exchange-money" style="font-size: 1.6rem; color: #0F766E; font-weight: 700; margin: 0;">0 đ</p>
                    </div>
                    
                    <div style="color: #0D9488;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </div>
                    
                    <div style="text-align: right;">
                        <span style="font-size: 0.9rem; color: #64748B;">Điểm nhận được</span>
                        <p id="view-exchange-points" style="font-size: 1.6rem; color: #0284C7; font-weight: 700; margin: 0;">0 Điểm</p>
                    </div>
                </div>
            </div>

            <div class="info-group full-width" id="view-exchange-deleted-group" style="display: none; margin-top: 10px;">
                <label style="color: #DC2626;">Thời gian ngừng áp dụng (Đã xóa)</label>
                <p id="view-exchange-deleted" class="info-value" style="color: #EF4444; font-weight: 500;">--/--/----</p>
            </div>
        </div>
    <?php 
        $exchangeDetailData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Thêm giá quy đổi', 'idModal' => $exchangeDetailForm, 'formData' => $exchangeDetailData]) ?>
</div>