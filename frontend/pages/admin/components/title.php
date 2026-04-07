<?php
    $titleContent = $titleContent ?? "";
    $group = $group ?? false;
    $insert = $insert ?? false;
    $edit = $edit ?? false;
    $delete = $delete ?? false;
    $handle = $handle ?? false;
    $restore = $restore ?? false;
    $targetModal = $targetModal ?? 'default-modal';
    $targetModal1 = $targetModal1 ?? 'default-modal';
    $targetModal2 = $targetModal2 ?? 'default-modal';
    $currentTable = $_GET['table'] ?? "1";
    $currentPage = $_GET['page'] ?? 'overview';
    $moduleName = $moduleName ?? $currentPage;

    // ==========================================
    // 1. MAPPING TÊN QUYỀN THEO TRANG VÀ TABLE
    // ==========================================
    $permissionPrefix = $currentPage; // Mặc định tên quyền giống tên trang (account, post...)

    if ($currentPage === 'price') {
        $permissionPrefix = ($currentTable === '2') ? 'rechargeRule' : 'payRule';
    } 
    elseif ($currentPage === 'bill') {
        $permissionPrefix = ($currentTable === '2') ? 'rechargeBill' : 'payBill';
    }
    elseif ($currentPage === 'permission') {
        $permissionPrefix = 'role';
    }

    // ==========================================
    // 2. KIỂM TRA QUYỀN (Dùng $permissionPrefix đã map)
    // ==========================================
    $canInsert  = $insert  && checkPermission($permissionPrefix . '.create');
    $canEdit    = $edit    && checkPermission($permissionPrefix . '.update');
    $canHandle  = $handle  && checkPermission($permissionPrefix . '.update'); 
    $canDelete  = $delete  && checkPermission($permissionPrefix . '.delete');
    $canRestore = $restore && checkPermission($permissionPrefix . '.restore');
?>

<div class="title-component">
    <?php if (!empty(trim($titleContent))): ?>
        <p class="content"><?php echo htmlspecialchars($titleContent); ?></p>
    <?php endif; ?>
    <?php  
    if($group){
    ?>
        <div class="group">
            <div class="item">
                <div class="info">
                    <p class="sub-info">Khách hàng mới</p>
                    <p class="main-number" id="kpi-users-total">Đang tải</p>
                    <p class="trend positive" id="kpi-users-trend">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                            Đang tải
                        </span> 
                        so với tháng trước
                    </p>
                </div>
                <div class="icon blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                </div>
            </div>

            <div class="item">
                <div class="info">
                    <p class="sub-info">Tin đang hoạt động</p>
                    <p class="main-number" id="kpi-posts-total">Đang tải</p>
                    <p class="trend positive" id="kpi-posts-trend">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                            Đang tải
                        </span> 
                        so với tháng trước
                    </p>
                </div>
                <div class="icon purple">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
            </div>

            <div class="item">
                <div class="info">
                    <p class="sub-info">Doanh thu tháng này</p>
                    <p class="main-number" id="kpi-revenue-total">Đang tải</p>
                    <p class="trend negative" id="kpi-revenue-trend">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                            -Đang tải
                        </span> 
                        so với tháng trước
                    </p>
                </div>
                <div class="icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
            </div>

            <div class="item">
                <div class="info">
                    <p class="sub-info">Tin chờ kiểm duyệt</p>
                    <p class="main-number" id="kpi-pending-total">Đang tải</p>
                    <p class="trend warning" id="kpi-pending-trend">
                        <span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            Cần xử lý ngay
                        </span> 
                    </p>
                </div>
                <div class="icon orange">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <?php 
    if($canInsert || $canEdit || $canHandle || $canDelete || $canRestore) { 
    ?>
        <div class="cta">
            <?php 
                // XỬ LÝ NÚT THÊM
                if($canInsert && $currentPage !== "account"){
                    $actualModal = ($currentTable == '1') ? $targetModal : $targetModal2;        
            ?> 
                <div class="btn_insert" onclick="openModal('<?php echo $actualModal ?>')">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18ZM10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C3.85752 17.9997 4.95991 18.7362 6.17317 19.2388C7.38642 19.7413 8.68678 20 10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0ZM11 5H9V9H5V11H9V15H11V11H15V9H11V5Z" fill="currentColor"/>
                    </svg>
                    <p>Thêm</p>
                </div>
            <?php 
                } else if($canInsert && $currentPage === "account"){     
            ?> 
                <div class="btn_insert" onclick="openModal('<?php echo $targetModal ?>')">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18ZM10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C3.85752 17.9997 4.95991 18.7362 6.17317 19.2388C7.38642 19.7413 8.68678 20 10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0ZM11 5H9V9H5V11H9V15H11V11H15V9H11V5Z" fill="currentColor"/>
                    </svg>
                    <p>Thêm</p>
                </div>
            <?php } ?>

            <?php 
                // XỬ LÝ NÚT SỬA / XỬ LÝ
                if($canEdit || $canHandle){
            ?> 
                <div class="btn_edit" onclick="handleEdit('<?php echo $targetModal1 ?>')">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 3.00011L11 6.00011M12.385 4.58511C12.7788 4.19126 13.0001 3.65709 13.0001 3.10011C13.0001 2.54312 12.7788 2.00895 12.385 1.61511C11.9912 1.22126 11.457 1 10.9 1C10.343 1 9.80885 1.22126 9.415 1.61511L1 10.0001V13.0001H4L12.385 4.58511Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p><?php echo $canEdit ? "Sửa" : "Xử lý"; ?></p>
                </div>
            <?php } ?>

            <?php 
                // XỬ LÝ NÚT XÓA
                if($canDelete){        
            ?> 
                <div class="btn_delete" onclick="handleDelete()">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 2C5 1.46957 5.21071 0.960859 5.58579 0.585786C5.96086 0.210714 6.46957 0 7 0H13C13.5304 0 14.0391 0.210714 14.4142 0.585786C14.7893 0.960859 15 1.46957 15 2V4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8946 4.48043 20 4.73478 20 5C20 5.26522 19.8946 5.51957 19.7071 5.70711C19.5196 5.89464 19.2652 6 19 6H17.931L17.064 18.142C17.0281 18.6466 16.8023 19.1188 16.4321 19.4636C16.0619 19.8083 15.5749 20 15.069 20H4.93C4.42414 20 3.93707 19.8083 3.56688 19.4636C3.1967 19.1188 2.97092 18.6466 2.935 18.142L2.07 6H1C0.734784 6 0.48043 5.89464 0.292893 5.70711C0.105357 5.51957 0 5.26522 0 5C0 4.73478 0.105357 4.48043 0.292893 4.29289C0.48043 4.10536 0.734784 4 1 4H5V2ZM7 4H13V2H7V4ZM4.074 6L4.931 18H15.07L15.927 6H4.074ZM8 8C8.26522 8 8.51957 8.10536 8.70711 8.29289C8.89464 8.48043 9 8.73478 9 9V15C9 15.2652 8.89464 15.5196 8.70711 15.7071C8.51957 15.8946 8.26522 16 8 16C7.73478 16 7.48043 15.8946 7.29289 15.7071C7.10536 15.5196 7 15.2652 7 15V9C7 8.73478 7.10536 8.48043 7.29289 8.29289C7.48043 8.10536 7.73478 8 8 8ZM12 8C12.2652 8 12.5196 8.10536 12.7071 8.29289C12.8946 8.48043 13 8.73478 13 9V15C13 15.2652 12.8946 15.5196 12.7071 15.7071C12.5196 15.8946 12.2652 16 12 16C11.7348 16 11.4804 15.8946 11.2929 15.7071C11.1054 15.5196 11 15.2652 11 15V9C11 8.73478 11.1054 8.48043 11.2929 8.29289C11.4804 8.10536 11.7348 8 12 8Z" fill="currentColor"/>
                    </svg>
                    <p>Xóa</p>
                </div>
            <?php } ?>

            <?php 
                // XỬ LÝ NÚT KHÔI PHỤC
                if($canRestore){        
            ?> 
                <div class="btn_restore" onclick="handleRestore()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.49999 20.344H6.48499V17.5M17.515 6.5V3.656L20.5 3.5M15 2.458C13.256 1.90997 11.3953 1.85047 9.61986 2.28594C7.84447 2.72141 6.22241 3.63521 4.92999 4.928C1.02399 8.834 1.02399 15.166 4.92999 19.071C5.26865 19.411 5.62466 19.7207 5.99799 20M8.99999 21.541C10.7441 22.0892 12.6051 22.1488 14.3807 21.7134C16.1562 21.2779 17.7785 20.364 19.071 19.071C22.977 15.166 22.977 8.834 19.071 4.929C18.7317 4.589 18.3753 4.27933 18.002 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 11.5C12.663 11.5 13.2989 11.2366 13.7678 10.7678C14.2366 10.2989 14.5 9.66304 14.5 9C14.5 8.33696 14.2366 7.70107 13.7678 7.23223C13.2989 6.76339 12.663 6.5 12 6.5C11.337 6.5 10.7011 6.76339 10.2322 7.23223C9.76339 7.70107 9.5 8.33696 9.5 9C9.5 9.66304 9.76339 10.2989 10.2322 10.7678C10.7011 11.2366 11.337 11.5 12 11.5ZM12 11.5C10.9391 11.5 9.92172 11.9214 9.17157 12.6716C8.42143 13.4217 8 14.4391 8 15.5M12 11.5C13.0609 11.5 14.0783 11.9214 14.8284 12.6716C15.5786 13.4217 16 14.4391 16 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p>Khôi phục</p>
                </div>
            <?php } ?>
        </div>    
    <?php } ?>
</div>