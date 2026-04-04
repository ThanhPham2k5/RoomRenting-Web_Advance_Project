<?php
    $apiRole = call_api("http://127.0.0.1:8000/api/roles?per_page=all");
    $roles= $apiRole['data'] ?? [];
    $paginationMeta = $paginationMeta ?? [];
    $currentTable = $_GET['table'] ?? "1";
    $accounts = $accounts ?? [];
    $accountInsertForm = "modal-them-tai-khoan";
    $accountEditForm = "modal-sua-tai-khoan";
    $accountDetailForm = "modal-chi-tiet-tai-khoan";
    $titleData = ['targetModal' => $accountInsertForm, 'targetModal1' => $accountEditForm, 'titleContent' => "Tài khoản", 'group' => false, 'insert' => true, 'edit' => true, 'delete' => true, 'handle' => false, 'restore' => true];
    $tableHeader = ['Id', 'Tên tài khoản', 'Chức vụ', 'Tình trạng', 'Chi tiết'];
    $type = ['type' => "1"];
    ob_start(); 
    if(empty($accounts)){
        echo '<tr><td colspan="5" style="text-align:center;">Không có dữ liệu hoặc lỗi kết nối máy chủ</td></tr>';
    }else{
        foreach ($accounts as $user){
        ?>
            <tr onclick="selectRow(this)" style="cursor: pointer;">
                <td style="display: none;">
                    <input type="radio" name="selectedRow" value="<?php echo $user['id']?>">
                </td>
                <td><?php echo ($user['id']); ?></td>
                <td class="user-name"><?php echo ($user['username']); ?></td>
                <td><?php echo ($user['role']) ?? ""; ?></td>
                <td>
                    <?php if (($user['deletedAt']) === null): ?>
                        <span class="badge badge-success">Đang hoạt động</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Dừng hoạt động</span>
                    <?php endif; ?>
                </td>
                <td>
                    <button class="table-btn" title="Xem chi tiết" onclick="handleView(<?php echo $user['id'] ?>, '<?php echo $accountDetailForm ?>')">
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
    $tableData = ['tableTitle' =>"Thông tin tài khoản", 'tableHeader' => $tableHeader, 'time' => false, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
?>

<div class="account-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false,$type) ?>
        <div class="line"></div>
        <div class="tab-pane">
            <a href="index.php?page=account&table=1" class="item <?php echo ($currentTable === '1') ? 'active' : ''; ?>">KHÁCH HÀNG</a>
            <a href="index.php?page=account&table=2" class="item <?php echo ($currentTable === '2') ? 'active' : ''; ?>">NHÂN VIÊN</a>
        </div>
    </div>
    <?php renderComponent("table",false,$tableData) ?>
    <?php renderComponent("pagination",false, ['paginationMeta' => $paginationMeta]) ?>
    <?php
    ob_start();
    ?>
        <input type="hidden" name="action" value="addAccount">
    
        <div class="input-group">
            <label>Số điện thoại</label>
            <input type="text" name="phone_number" placeholder="Nhập vào số điện thoại">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Nhập vào email">
        </div>
        <div class="input-group">
            <label>Tên tài khoản</label>
            <input type="text" name="username" placeholder="Nhập vào tên tài khoản">
        </div>
        <div class="input-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập vào mật khẩu">
        </div>
        <div class="input-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
        </div>
        <div class="input-group">
            <label>Chức vụ</label>
            <select name="role">
                <option value="">-- Chọn chức vụ --</option>
                <option value="employee">Nhân viên</option>
                <option value="user">Khách hàng</option>
            </select>
        </div>
        <div class="input-group">
            <label>Chọn quyền hạn</label>
            <select name="roles[]">
                <option value="">-- Chọn quyền hạn --</option>
                <?php if(empty($roles)){?>
                    <option value="">Không có dữ liệu hoặc lỗi kết nối máy chủ</option>
                <?php
                }else{
                    foreach ($roles as $role){?>
                        <option value="<?php echo $role['name'] ?>"><?php echo htmlspecialchars($role['name']) ?></option>
                    <?php
                    }
                }?>
            </select>
        </div>
    <?php 
        $formInsertData = ob_get_clean();
    ?>
    <?php
    ob_start();
    ?>
        <input type="hidden" name="action" value="editAccount">
        <input type="hidden" name="id" value="">

        <div class="input-group">
            <label>Tên tài khoản</label>
            <input type="text" name="username" value="" placeholder="Nhập vào tên tài khoản">
        </div>
        <div class="input-group">
            <label>Mật khẩu mới</label>
            <input type="password" name="password" placeholder="Nhập vào mật khẩu mới">
        </div>
        <div class="input-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
        </div>
        <div class="input-group">
            <label>Chức vụ</label>
            <select name="role" disabled style="background-color: #e9ecef;">
                <option value="">-- Chọn chức vụ --</option>
                <option value="employee">Nhân viên</option>
                <option value="user">Khách hàng</option>
            </select>
        </div>
        <div class="input-group">
            <label>Chọn quyền hạn</label>
            <select name="roles[]">
                <option value="">-- Chọn quyền hạn --</option>
                <?php 
                if(empty($roles)){ ?>
                    <option value="">Không có dữ liệu</option>
                <?php } else {
                    foreach ($roles as $role){ ?>
                        <option value="<?php echo $role['name'] ?>">
                            <?php echo htmlspecialchars($role['name']) ?>
                        </option>
                <?php } 
                } ?>
            </select>
        </div>
    <?php 
        $formEditData = ob_get_clean();
    ?>
    <?php
    ob_start();
    ?>
        <div class="detail-profile-header">
            <div class="avatar-placeholder" id="view-avatar-text">A</div>
            <div class="profile-title">
                <h3 id="view-username">Tên tài khoản</h3>
                <span class="badge-detail badge-detail-role" id="view-role">Chức vụ</span>
            </div>
        </div>

        <hr class="divider">

        <!-- Khu vực lưới thông tin -->
        <div class="detail-grid">
            <div class="info-group">
                <label>ID Tài khoản</label>
                <p id="view-id" class="info-value">#</p>
            </div>
            <div class="info-group">
                <label>Tình trạng</label>
                <p id="view-status" class="info-value"><span class="badge-detail">Trạng thái</span></p>
            </div>
            <div class="info-group">
                <label>Email</label>
                <p id="view-email" class="info-value">Chưa cập nhật</p>
            </div>
            <div class="info-group">
                <label>Số điện thoại</label>
                <p id="view-phone" class="info-value">Chưa cập nhật</p>
            </div>
            <div class="info-group full-width">
                <label>Quyền hạn</label>
                <div id="view-roles-container" class="roles-badge-container">
                </div>
            </div>
        </div>
    <?php 
        $formDetailData = ob_get_clean();
    ?>
    <?php renderComponent("form",false,['title' => 'Thêm tài khoản', 'idModal' => $accountInsertForm, 'formData' => $formInsertData]) ?>
    <?php renderComponent("form",false,['title' => 'Sửa tài khoản', 'idModal' => $accountEditForm, 'formData' => $formEditData]) ?>
    <?php renderComponent("form",false,['title' => 'Chi tiết tài khoản', 'idModal' => $accountDetailForm, 'formData' => $formDetailData]) ?>
</div>