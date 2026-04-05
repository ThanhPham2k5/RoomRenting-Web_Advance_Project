<?php 
    $permissions = $permissions ?? [];
    $paginationMeta = $paginationMeta ?? [];
    $permissionInsertForm = "modal-them-phan-quyen";
    $permissionEditForm = "modal-sua-phan-quyen";
    $permissionListAccountForm = "modal-danh-sach-nhan-vien";
    $permissionDetailForm = "modal-chi-tiet-quyen";
    $titleData = ['targetModal' => $permissionInsertForm, 'targetModal1' => $permissionEditForm, 'titleContent' => "Phân quyền", 'group' => false, 'insert' => true, 'edit' => true, 'delete' => true, 'handle' => false];
    $tableHeader = ['Id', 'Tên quyền', 'Mô tả', 'Danh sách người sở hữu', 'Chi tiết'];
    $type = ['type' => "1"];
    ob_start(); 
    if(empty($permissions)){
        echo '<tr><td colspan="5" style="text-align:center;">Không có dữ liệu hoặc lỗi kết nối máy chủ</td></tr>';
    }else{
        foreach ($permissions as $permission){
    ?>
        <tr onclick="selectRow(this)" style="cursor: pointer;">
            <td style="display: none;">
                <input type="radio" name="selectedRow" value="<?php echo $permission['id']; ?>">
            </td>
            <td><?php echo ($permission['id']); ?></td>
            <td><?php echo ($permission['name']); ?></td>
            <td><?php echo ($permission['description']); ?></td>
            <td>
                <button class="table-btn" title="Xem danh sách" onclick="openAccountListModal(event, '<?php echo $permissionListAccountForm; ?>', '<?php echo $permission['name']; ?>', <?php echo $permission['id']; ?>)">
                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19 2H3C2.73478 2 2.48043 2.10536 2.29289 2.29289C2.10536 2.48043 2 2.73478 2 3V17C2 17.2652 2.10536 17.5196 2.29289 17.7071C2.48043 17.8946 2.73478 18 3 18H19C19.2652 18 19.5196 17.8946 19.7071 17.7071C19.8946 17.5196 20 17.2652 20 17V3C20 2.73478 19.8946 2.48043 19.7071 2.29289C19.5196 2.10536 19.2652 2 19 2ZM3 0C2.20435 0 1.44129 0.316071 0.87868 0.87868C0.31607 1.44129 0 2.20435 0 3V17C0 17.7956 0.31607 18.5587 0.87868 19.1213C1.44129 19.6839 2.20435 20 3 20H19C19.7956 20 20.5587 19.6839 21.1213 19.1213C21.6839 18.5587 22 17.7956 22 17V3C22 2.20435 21.6839 1.44129 21.1213 0.87868C20.5587 0.316071 19.7956 0 19 0H3ZM5 5H7V7H5V5ZM10 5C9.73478 5 9.48043 5.10536 9.29289 5.29289C9.10536 5.48043 9 5.73478 9 6C9 6.26522 9.10536 6.51957 9.29289 6.70711C9.48043 6.89464 9.73478 7 10 7H16C16.2652 7 16.5196 6.89464 16.7071 6.70711C16.8946 6.51957 17 6.26522 17 6C17 5.73478 16.8946 5.48043 16.7071 5.29289C16.5196 5.10536 16.2652 5 16 5H10ZM7 9H5V11H7V9ZM9 10C9 9.73478 9.10536 9.48043 9.29289 9.29289C9.48043 9.10536 9.73478 9 10 9H16C16.2652 9 16.5196 9.10536 16.7071 9.29289C16.8946 9.48043 17 9.73478 17 10C17 10.2652 16.8946 10.5196 16.7071 10.7071C16.5196 10.8946 16.2652 11 16 11H10C9.73478 11 9.48043 10.8946 9.29289 10.7071C9.10536 10.5196 9 10.2652 9 10ZM7 13H5V15H7V13ZM9 14C9 13.7348 9.10536 13.4804 9.29289 13.2929C9.48043 13.1054 9.73478 13 10 13H16C16.2652 13 16.5196 13.1054 16.7071 13.2929C16.8946 13.4804 17 13.7348 17 14C17 14.2652 16.8946 14.5196 16.7071 14.7071C16.5196 14.8946 16.2652 15 16 15H10C9.73478 15 9.48043 14.8946 9.29289 14.7071C9.10536 14.5196 9 14.2652 9 14Z" fill="currentColor"/>
                    </svg>
                </button>
            </td>
            <td>
                <button class="table-btn" title="Xem chi tiết" onclick="handleView(<?php echo $permission['id'] ?>, '<?php echo $permissionDetailForm ?>')">
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

    $tableData = ['tableTitle' =>"Thông tin quyền", 'tableHeader' => $tableHeader, 'time' => false, 'status' => false, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
?>

<div class="permission-page">
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
        <input type="hidden" name="action" value="addPermission">
    
        <div class="input-group">
            <label>Tên quyền</label>
            <input type="text" name="name" placeholder="Nhập tên quyền...">
        </div>
        <div class="input-group">
            <label>Mô tả</label>
            <input type="text" name="description" placeholder="Nhập mô tả...">
        </div>
        <div class="input-group full-width">
            <label>Phân quyền chức năng</label>
            
            <div class="permission-accordion">
                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý tài khoản</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.create"> <span>Thêm</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.update"> <span>Sửa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.delete"> <span>Xóa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.restore"> <span>Khôi phục</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý phân quyền</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.create"> <span>Thêm</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.update"> <span>Sửa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.delete"> <span>Xóa</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý bài đăng</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.update"> <span>Sửa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.delete"> <span>Xóa</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý bình luận</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="comment.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="comment.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="comment.delete"> <span>Xóa</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý hóa đơn</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payBill.getAll"> <span>Xem danh sách hóa đơn thanh toán</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeBill.getAll"> <span>Xem danh sách hóa đơn nạp tiền</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeBill.get"> <span>Xem chi tiết hóa đơn nạp tiền</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payBill.get"> <span>Xem chi tiết hóa đơn thanh toán</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payBill.update"> <span>Sửa hóa đơn thanh toán</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeBill.update"> <span>Sửa hóa đơn nạp tiền</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý giá</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.getAll"> <span>Xem danh sách giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.getAll"> <span>Xem danh sách giá trị quy đổi</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.get"> <span>Xem chi tiết giá trị quy đổi</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.get"> <span>Xem chi tiết giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.create"> <span>Thêm giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.create"> <span>Thêm giá trị quy đổi</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.restore"> <span>Khôi phục giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.restore"> <span>Khôi phục giá trị quy đổi</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý thông tin cá nhân</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="personalInfo.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="personalInfo.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="personalInfo.update"> <span>Sửa</span></label>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        $formInsertData = ob_get_clean();
    ?>
    <?php
    ob_start();
    ?>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên tài khoản</th>
                        <th>Chức vụ</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="role-account-list-body">
                    <tr>
                        <td>1</td>
                        <td style="font-weight: 500;">Tuan</td>
                        <td>tuanvietcode@gmail.com</td>
                        <td class="text-center">
                            <button class="table-btn red" type="button" onclick="alert('Mô phỏng tước quyền')">Tước quyền</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td style="font-weight: 500;">Nguyễn Văn A</td>
                        <td>nguyen.a@example.com</td>
                        <td class="text-center">
                            <button class="table-btn red" type="button" onclick="alert('Mô phỏng tước quyền')">Tước quyền</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td style="font-weight: 500;">Tuan</td>
                        <td>tuanvietcode@gmail.com</td>
                        <td class="text-center">
                            <button class="table-btn red" type="button" onclick="alert('Mô phỏng tước quyền')">Tước quyền</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td style="font-weight: 500;">Nguyễn Văn A</td>
                        <td>nguyen.a@example.com</td>
                        <td class="text-center">
                            <button class="table-btn red" type="button" onclick="alert('Mô phỏng tước quyền')">Tước quyền</button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td style="font-weight: 500;">Tuan</td>
                        <td>tuanvietcode@gmail.com</td>
                        <td class="text-center">
                            <button class="table-btn red" type="button" onclick="alert('Mô phỏng tước quyền')">Tước quyền</button>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td style="font-weight: 500;">Nguyễn Văn A</td>
                        <td>nguyen.a@example.com</td>
                        <td class="text-center">
                            <button class="table-btn red" type="button" onclick="alert('Mô phỏng tước quyền')">Tước quyền</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php 
        $formListAccountData = ob_get_clean();
    ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder permission-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <div class="profile-title">
                <h3 id="view-permission-name">Tên Role</h3>
                <span class="badge-detail badge-detail-guard" id="view-guard-name">Guard: api</span>
            </div>
        </div>

        <hr class="divider">

        <div class="detail-grid">
            <div class="info-group">
                <label>ID Role</label>
                <p id="view-permission-id" class="info-value">#</p>
            </div>
            <div class="info-group">
                <label>Mã định danh (Key)</label>
                <p id="view-permission-key" class="info-value" style="font-family: monospace; color: #2563EB;">role_key</p>
            </div>
            <div class="info-group">
                <label>Ngày tạo</label>
                <p id="view-created-at" class="info-value">--/--/----</p>
            </div>
            
            <div class="info-group full-width">
                <label>Mô tả chi tiết</label>
                <div id="view-description" class="info-value description-box">
                    Chưa có mô tả cho role này.
                </div>
            </div>

            <div class="info-group full-width">
                <label>Quyền hạn chi tiết (Permissions)</label>
                <div id="view-sub-permissions-container" class="roles-badge-container permissions-list">
                    </div>
            </div>
        </div>
    <?php 
        $formDetailData = ob_get_clean();
    ?>
    <?php
    ob_start();
    ?>
        <input type="hidden" name="action" value="editPermission">
        <input type="hidden" name="id"> <div class="input-group">
            <label>Tên quyền</label>
            <input type="text" name="name" placeholder="Nhập tên quyền...">
        </div>
        
        <div class="input-group">
            <label>Mô tả</label>
            <input type="text" name="description" placeholder="Nhập mô tả...">
        </div>

        <div class="input-group full-width">
            <label>Phân quyền chức năng</label>
            
            <div class="permission-accordion">
                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý tài khoản</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.create"> <span>Thêm</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.update"> <span>Sửa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.delete"> <span>Xóa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="account.restore"> <span>Khôi phục</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý phân quyền</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.create"> <span>Thêm</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.update"> <span>Sửa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="role.delete"> <span>Xóa</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý bài đăng</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.update"> <span>Sửa</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="post.delete"> <span>Xóa</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý bình luận</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="comment.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="comment.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="comment.delete"> <span>Xóa</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý hóa đơn</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payBill.getAll"> <span>Xem danh sách hóa đơn thanh toán</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeBill.getAll"> <span>Xem danh sách hóa đơn nạp tiền</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeBill.get"> <span>Xem chi tiết hóa đơn nạp tiền</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payBill.get"> <span>Xem chi tiết hóa đơn thanh toán</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payBill.update"> <span>Sửa hóa đơn thanh toán</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeBill.update"> <span>Sửa hóa đơn nạp tiền</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý giá</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.getAll"> <span>Xem danh sách giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.getAll"> <span>Xem danh sách giá trị quy đổi</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.get"> <span>Xem chi tiết giá trị quy đổi</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.get"> <span>Xem chi tiết giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.create"> <span>Thêm giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.create"> <span>Thêm giá trị quy đổi</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="payRule.restore"> <span>Khôi phục giá đăng bài</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="rechargeRule.restore"> <span>Khôi phục giá trị quy đổi</span></label>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header" onclick="toggleAccordion(this)">
                        <span class="module-title">Quản lý thông tin cá nhân</span>
                        <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="accordion-body">
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="personalInfo.getAll"> <span>Xem danh sách</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="personalInfo.get"> <span>Xem chi tiết</span></label>
                        <label class="custom-checkbox"><input type="checkbox" name="permissions[]" value="personalInfo.update"> <span>Sửa</span></label>
                    </div>
                </div>
            </div>
        </div>
    <?php 
    $editPermissionData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Thêm quyền', 'idModal' => $permissionInsertForm, 'formData' => $formInsertData]) ?>
    <?php renderComponent("form",false,['title' => 'Sửa quyền', 'idModal' => $permissionEditForm, 'formData' => $editPermissionData]) ?>
    <?php renderComponent("form",false,['title' => 'Danh sách nhân viên', 'idModal' => $permissionListAccountForm, 'formData' => $formListAccountData]) ?>
    <?php renderComponent("form",false,['title' => 'Chi tiết quyền', 'idModal' => $permissionDetailForm, 'formData' => $formDetailData, 'save' => false]) ?>
</div>
<script>
function validatePermissionMaster(form) {
    // 1. Lấy các phần tử DOM cần kiểm tra
    const nameInput = form.querySelector('input[name="name"]');
    const descInput = form.querySelector('input[name="description"]');
    // Với checkbox dạng mảng, ta cần chọn tất cả để kiểm tra xem có cái nào được check không
    const permissionCheckboxes = form.querySelectorAll('input[name="permissions[]"]');

    // 2. Xóa các thông báo lỗi cũ trước khi thực hiện kiểm tra mới
    [nameInput, descInput].forEach(input => {
        if (input) Validator.clearError(input);
    });
    
    // Vì checkbox nằm trong một cấu trúc accordion phức tạp, ta cần tìm container chung gần nhất
    // để hiển thị lỗi, ví dụ div chứa toàn bộ accordion.
    const accordionContainer = form.querySelector('.permission-accordion');
    if (accordionContainer) Validator.clearError(accordionContainer);

    let isValid = true;

    // --- KIỂM TRA TÊN QUYỀN ---
    // Yêu cầu: Không được rỗng, độ dài tối đa 255 kí tự
    if (nameInput) {
        const nameValue = nameInput.value.trim();
        const nameEmptyErr = Validator.isRequired(nameValue, 'Tên quyền không được để trống!');
        
        if (nameEmptyErr) {
            Validator.showError(nameInput, nameEmptyErr);
            isValid = false;
        } else {
            const nameLenErr = Validator.checkLength(nameValue, 1, 255, 'Tên quyền');
            if (nameLenErr) {
                Validator.showError(nameInput, nameLenErr);
                isValid = false;
            }
        }
    }

    // --- KIỂM TRA MÔ TẢ ---
    // Yêu cầu: Không được rỗng, độ dài tối đa 255 kí tự
    if (descInput) {
        const descValue = descInput.value.trim();
        const descEmptyErr = Validator.isRequired(descValue, 'Mô tả không được để trống!');
        
        if (descEmptyErr) {
            Validator.showError(descInput, descEmptyErr);
            isValid = false;
        } else {
            const descLenErr = Validator.checkLength(descValue, 1, 255, 'Mô tả');
            if (descLenErr) {
                Validator.showError(descInput, descLenErr);
                isValid = false;
            }
        }
    }

    // --- KIỂM TRA TÙY CHỌN CHỨC NĂNG (QUYỀN) ---
    // Yêu cầu: Không được rỗng (phải chọn ít nhất 1 checkbox)
    if (permissionCheckboxes.length > 0) {
        let isAnyChecked = false;
        // Duyệt qua NodeList để xem có checkbox nào đang được checked không
        for (let i = 0; i < permissionCheckboxes.length; i++) {
            if (permissionCheckboxes[i].checked) {
                isAnyChecked = true;
                break;
            }
        }

        if (!isAnyChecked) {
            // Nếu không có checkbox nào được chọn, hiển thị lỗi ở container bọc ngoài
            if (accordionContainer) {
                 Validator.showError(accordionContainer, 'Vui lòng chọn ít nhất một chức năng!');
            }
            isValid = false;
        }
    }

    return isValid;
}
document.addEventListener('DOMContentLoaded', function() {
    const permissions = document.querySelectorAll('input[name="permissions[]"]');

    const setCheck = (valName, state) => {
        const cb = document.querySelector(`input[value="${valName}"]`);
        if (cb) cb.checked = state;
    };

    const viewPerms = ['get', 'getAll'];
    const actionPerms = ['create', 'update', 'delete', 'restore'];

    permissions.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const val = this.value;
            const isChecked = this.checked;
            const [module, action] = val.split('.');

            // ==========================================
            // 1. NHÓM HÓA ĐƠN: payBill và rechargeBill
            // ==========================================
            if (['payBill', 'rechargeBill'].includes(module)) {
                const billGets = ['payBill.get', 'payBill.getAll', 'rechargeBill.get', 'rechargeBill.getAll'];
                const billUpdates = ['payBill.update', 'rechargeBill.update'];

                if (isChecked) {
                    if (viewPerms.includes(action)) billGets.forEach(v => setCheck(v, true));
                    if (action === 'update') {
                        billUpdates.forEach(v => setCheck(v, true));
                        billGets.forEach(v => setCheck(v, true));
                    }
                } else {
                    if (viewPerms.includes(action)) {
                        billGets.forEach(v => setCheck(v, false));
                        billUpdates.forEach(v => setCheck(v, false));
                    }
                    if (action === 'update') billUpdates.forEach(v => setCheck(v, false));
                }
                return; 
            }

            // ==========================================
            // 2. NHÓM QUẢN LÝ GIÁ: payRule và rechargeRule
            // ==========================================
            if (['payRule', 'rechargeRule'].includes(module)) {
                const ruleGets = ['payRule.get', 'payRule.getAll', 'rechargeRule.get', 'rechargeRule.getAll'];
                const ruleCreates = ['payRule.create', 'rechargeRule.create'];
                const ruleRestores = ['payRule.restore', 'rechargeRule.restore'];

                if (isChecked) {
                    if (viewPerms.includes(action)) ruleGets.forEach(v => setCheck(v, true));
                    if (action === 'create') {
                        ruleCreates.forEach(v => setCheck(v, true));
                        ruleGets.forEach(v => setCheck(v, true)); // Thêm thì phải Xem được
                    }
                    if (action === 'restore') {
                        ruleRestores.forEach(v => setCheck(v, true));
                        ruleGets.forEach(v => setCheck(v, true)); // Khôi phục thì phải Xem được
                    }
                } else {
                    if (viewPerms.includes(action)) {
                        ruleGets.forEach(v => setCheck(v, false));
                        ruleCreates.forEach(v => setCheck(v, false)); // Mất Xem -> Hủy Thêm
                        ruleRestores.forEach(v => setCheck(v, false)); // Mất Xem -> Hủy Khôi phục
                    }
                    if (action === 'create') ruleCreates.forEach(v => setCheck(v, false));
                    if (action === 'restore') ruleRestores.forEach(v => setCheck(v, false));
                }
                return;
            }

            // ==========================================
            // 3. LOGIC MẶC ĐỊNH CHO CÁC MODULE CÒN LẠI (Account, Post, Comment...)
            // ==========================================
            if (isChecked) {
                if (viewPerms.includes(action)) {
                    setCheck(`${module}.get`, true);
                    setCheck(`${module}.getAll`, true);
                } else if (actionPerms.includes(action)) {
                    setCheck(`${module}.get`, true);
                    setCheck(`${module}.getAll`, true);
                }
            } else {
                if (viewPerms.includes(action)) {
                    setCheck(`${module}.get`, false);
                    setCheck(`${module}.getAll`, false);
                    actionPerms.forEach(act => setCheck(`${module}.${act}`, false));
                }
            }
        });
    });
});
</script>