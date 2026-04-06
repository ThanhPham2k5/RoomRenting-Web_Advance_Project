<?php
    $apiRole = call_api("http://backend.test/api/address/provinces");
    $provinces= $apiRole['data'] ?? [];
    $apiRole = call_api("http://backend.test/api/address/wards");
    $wards= $apiRole['data'] ?? [];
    $titleData = ['titleContent' => "Cài đặt", 'group' => false, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => false];
    
    // Đảm bảo $info tồn tại (đã lấy từ $pageData trước đó)
    $info = $info ?? [];
    $id = $id ?? "";
    // Avatar
    $displayName = $info['name'] ?? 'Admin';
    $avatarUrl = !empty($info['profileUrl'])
        ? $info['profileUrl'] 
        : "https://ui-avatars.com/api/?name=" . urlencode($displayName) . "&background=EEF2FF&color=2563EB";
        
    // Lấy trước dữ liệu để xét điều kiện 'selected' cho thẻ <option>
    $currentGender = $info['gender'] ?? '';
    $currentProvince = $info['province'] ?? '';
    $currentWard = $info['ward'] ?? '';
?>

<div class="setting-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title", false, $titleData) ?> 
    
    <div class="setting-page-main">
        <div class="left">
            <div class="item active" id="tab-info" onclick="switchTab('info')">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 15C10.2833 15 10.521 14.904 10.713 14.712C10.905 14.52 11.0007 14.2827 11 14V10C11 9.71667 10.904 9.47933 10.712 9.288C10.52 9.09667 10.2827 9.00067 10 9C9.71733 8.99933 9.48 9.09533 9.288 9.288C9.096 9.48067 9 9.718 9 10V14C9 14.2833 9.096 14.521 9.288 14.713C9.48 14.905 9.71733 15.0007 10 15ZM10 7C10.2833 7 10.521 6.904 10.713 6.712C10.905 6.52 11.0007 6.28267 11 6C10.9993 5.71733 10.9033 5.48 10.712 5.288C10.5207 5.096 10.2833 5 10 5C9.71667 5 9.47933 5.096 9.288 5.288C9.09667 5.48 9.00067 5.71733 9 6C8.99933 6.28267 9.09533 6.52033 9.288 6.713C9.48067 6.90567 9.718 7.00133 10 7ZM10 20C8.61667 20 7.31667 19.7373 6.1 19.212C4.88334 18.6867 3.825 17.9743 2.925 17.075C2.025 16.1757 1.31267 15.1173 0.788001 13.9C0.263335 12.6827 0.000667933 11.3827 1.26582e-06 10C-0.000665401 8.61733 0.262001 7.31733 0.788001 6.1C1.314 4.88267 2.02633 3.82433 2.925 2.925C3.82367 2.02567 4.882 1.31333 6.1 0.788C7.318 0.262667 8.618 0 10 0C11.382 0 12.682 0.262667 13.9 0.788C15.118 1.31333 16.1763 2.02567 17.075 2.925C17.9737 3.82433 18.6863 4.88267 19.213 6.1C19.7397 7.31733 20.002 8.61733 20 10C19.998 11.3827 19.7353 12.6827 19.212 13.9C18.6887 15.1173 17.9763 16.1757 17.075 17.075C16.1737 17.9743 15.1153 18.687 13.9 19.213C12.6847 19.739 11.3847 20.0013 10 20ZM10 18C12.2333 18 14.125 17.225 15.675 15.675C17.225 14.125 18 12.2333 18 10C18 7.76667 17.225 5.875 15.675 4.325C14.125 2.775 12.2333 2 10 2C7.76667 2 5.875 2.775 4.325 4.325C2.775 5.875 2 7.76667 2 10C2 12.2333 2.775 14.125 4.325 15.675C5.875 17.225 7.76667 18 10 18Z" fill="currentColor"/>
                </svg>
                <p>Thông tin cá nhân</p>
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.2 0L0 1L4.6 6L0 11L1.2 12L6.6 6L1.2 0Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="item" id="tab-account" onclick="switchTab('account')">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.0434 10.6614C17.8831 10.4789 17.7947 10.2443 17.7947 10.0014C17.7947 9.75845 17.8831 9.52385 18.0434 9.34136L19.3234 7.90136C19.4645 7.74403 19.5521 7.54606 19.5736 7.33587C19.5952 7.12567 19.5496 6.91405 19.4434 6.73136L17.4434 3.27136C17.3384 3.08888 17.1783 2.94424 16.9862 2.85805C16.7941 2.77186 16.5796 2.74852 16.3734 2.79136L14.4934 3.17136C14.2542 3.22079 14.0052 3.18095 13.7933 3.05936C13.5815 2.93777 13.4214 2.74284 13.3434 2.51136L12.7334 0.68136C12.6664 0.482739 12.5385 0.310225 12.3681 0.188202C12.1976 0.0661789 11.9931 0.000818796 11.7834 0.00135996H7.78345C7.56538 -0.0100221 7.34958 0.0502863 7.16901 0.173074C6.98844 0.295862 6.85303 0.474379 6.78345 0.68136L6.22345 2.51136C6.14545 2.74284 5.98542 2.93777 5.77356 3.05936C5.5617 3.18095 5.31266 3.22079 5.07345 3.17136L3.14345 2.79136C2.948 2.76374 2.74875 2.79458 2.57079 2.88C2.39284 2.96542 2.24415 3.10159 2.14345 3.27136L0.143447 6.73136C0.0346072 6.91201 -0.0143308 7.12245 0.00362973 7.33258C0.0215902 7.54272 0.105529 7.7418 0.243447 7.90136L1.51345 9.34136C1.67377 9.52385 1.76218 9.75845 1.76218 10.0014C1.76218 10.2443 1.67377 10.4789 1.51345 10.6614L0.243447 12.1014C0.105529 12.2609 0.0215902 12.46 0.00362973 12.6701C-0.0143308 12.8803 0.0346072 13.0907 0.143447 13.2714L2.14345 16.7314C2.24854 16.9138 2.40857 17.0585 2.6007 17.1447C2.79283 17.2309 3.00727 17.2542 3.21345 17.2114L5.09345 16.8314C5.33266 16.7819 5.5817 16.8218 5.79356 16.9434C6.00542 17.0649 6.16545 17.2599 6.24345 17.4914L6.85345 19.3214C6.92303 19.5283 7.05844 19.7069 7.23901 19.8296C7.41958 19.9524 7.63538 20.0127 7.85345 20.0014H11.8534C12.0631 20.0019 12.2676 19.9365 12.4381 19.8145C12.6085 19.6925 12.7364 19.52 12.8034 19.3214L13.4134 17.4914C13.4914 17.2599 13.6515 17.0649 13.8633 16.9434C14.0752 16.8218 14.3242 16.7819 14.5634 16.8314L16.4434 17.2114C16.6496 17.2542 16.8641 17.2309 17.0562 17.1447C17.2483 17.0585 17.4084 16.9138 17.5134 16.7314L19.5134 13.2714C19.6196 13.0887 19.6652 12.877 19.6436 12.6669C19.6221 12.4567 19.5345 12.2587 19.3934 12.1014L18.0434 10.6614ZM16.5534 12.0014L17.3534 12.9014L16.0734 15.1214L14.8934 14.8814C14.1732 14.7341 13.424 14.8565 12.788 15.2252C12.1521 15.5938 11.6736 16.1832 11.4434 16.8814L11.0634 18.0014H8.50345L8.14345 16.8614C7.9133 16.1632 7.43483 15.5738 6.79885 15.2052C6.16288 14.8365 5.41367 14.7141 4.69345 14.8614L3.51345 15.1014L2.21345 12.8914L3.01345 11.9914C3.5054 11.4413 3.77738 10.7293 3.77738 9.99136C3.77738 9.25343 3.5054 8.54138 3.01345 7.99136L2.21345 7.09136L3.49345 4.89136L4.67345 5.13136C5.39367 5.27858 6.14288 5.15624 6.77885 4.78756C7.41483 4.41888 7.8933 3.82952 8.12345 3.13136L8.50345 2.00136H11.0634L11.4434 3.14136C11.6736 3.83952 12.1521 4.42888 12.788 4.79756C13.424 5.16624 14.1732 5.28858 14.8934 5.14136L16.0734 4.90136L17.3534 7.12136L16.5534 8.02136C16.067 8.57012 15.7984 9.27804 15.7984 10.0114C15.7984 10.7447 16.067 11.4526 16.5534 12.0014ZM9.78345 6.00136C8.99232 6.00136 8.21896 6.23596 7.56117 6.67548C6.90337 7.11501 6.39068 7.73972 6.08793 8.47063C5.78518 9.20153 5.70597 10.0058 5.86031 10.7817C6.01465 11.5576 6.39561 12.2704 6.95502 12.8298C7.51443 13.3892 8.22716 13.7702 9.00309 13.9245C9.77901 14.0788 10.5833 13.9996 11.3142 13.6969C12.0451 13.3941 12.6698 12.8814 13.1093 12.2236C13.5489 11.5658 13.7834 10.7925 13.7834 10.0014C13.7834 8.94049 13.362 7.92308 12.6119 7.17293C11.8617 6.42279 10.8443 6.00136 9.78345 6.00136ZM9.78345 12.0014C9.38789 12.0014 9.0012 11.8841 8.67231 11.6643C8.34341 11.4445 8.08706 11.1322 7.93569 10.7667C7.78431 10.4013 7.74471 9.99914 7.82188 9.61118C7.89905 9.22322 8.08953 8.86685 8.36923 8.58715C8.64894 8.30744 9.0053 8.11696 9.39327 8.03979C9.78123 7.96262 10.1834 8.00223 10.5488 8.1536C10.9143 8.30498 11.2266 8.56132 11.4464 8.89022C11.6661 9.21912 11.7834 9.6058 11.7834 10.0014C11.7834 10.5318 11.5727 11.0405 11.1977 11.4156C10.8226 11.7906 10.3139 12.0014 9.78345 12.0014Z" fill="currentColor"/>
                </svg>
                <p>Cài đặt tài khoản</p>
                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.2 0L0 1L4.6 6L0 11L1.2 12L6.6 6L1.2 0Z" fill="currentColor"/>
                </svg>
            </div>
        </div>

        <form class="right-info" id="panel-info" style="display: flex; flex-direction: column;" onsubmit="handleSaveSettings(event)">
            <p>Hồ sơ cá nhân</p>
            <div class="avatar-edit-section">
                <img src="<?php echo htmlspecialchars($avatarUrl); ?>" alt="Avatar" class="avatar-preview" id="avatarPreview">
                <div class="avatar-action">
                    <label for="upload-avatar" class="btn-change-avatar">Tải ảnh mới</label>
                    <input type="file" id="upload-avatar" accept="image/jpeg, image/png, image/jpg" hidden>
                    <p class="avatar-hint">Định dạng JPEG, PNG. Dung lượng tối đa 2MB.</p>
                </div>
            </div>
            
            <div class="item">
                <p>Họ và tên</p>
                <input type="text" name="name" value="<?php echo htmlspecialchars($info['name'] ?? ''); ?>">
            </div>
            <div class="item">
                <p>Số điện thoại</p>
                <input type="text" name="phoneNumber" value="<?php echo htmlspecialchars($info['phoneNumber'] ?? ''); ?>">
            </div>
            <div class="item">
                <p>Email</p>
                <input type="email" name="email" value="<?php echo htmlspecialchars($info['email'] ?? ''); ?>" readonly title="Email không thể thay đổi">
            </div>
        
            <div class="item">
                <p>Địa chỉ</p>
                <input type="text" name="houseNumber" value="<?php echo htmlspecialchars($info['houseNumber'] ?? ''); ?>" placeholder="Số nhà, Tên đường" style="margin-bottom: 10px;">
                
                <div class="input-group">
                    <select name="province" id="city-select">
                        <option value="">-- Chọn Tỉnh/Thành phố --</option>
                        <?php foreach ($provinces as $province): ?>
                            <option value="<?php echo htmlspecialchars($province['name'] ?? ''); ?>" data-name="<?php echo htmlspecialchars($province['name'] ?? ''); ?>">
                                <?php echo htmlspecialchars($province['name'] ?? ''); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group">
                    <select name="ward" id="ward-select">
                        <option value="">-- Chọn Phường/Xã --</option>
                    </select>
                </div>
            </div>
            
            <p style="margin-top: 20px;">Thông tin bảo mật</p>
            <div class="item">
                <p>Căn cước công dân</p>
                <input type="text" name="pid" value="<?php echo htmlspecialchars($info['pid'] ?? ''); ?>">
            </div>
            
            <div class="item">
                <p>Giới tính</p>
                <select name="gender" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
                    <option value="">-- Chọn Giới tính --</option>
                    <option value="Nam" <?php echo ($currentGender === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($currentGender === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo ($currentGender === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>
            
            <div class="item">
                <p>Ngày sinh</p>
                <input type="date" name="dateOfBirth" value="<?php echo htmlspecialchars($info['dateOfBirth'] ?? ''); ?>">
            </div>
            <button class="btn-save">Lưu thay đổi</button>
        </form>

        <form class="right-account" id="panel-account" style="display: none; flex-direction: column;" onsubmit="handleSavePassword(event)">
            <p>Thay đổi mật khẩu</p>
            <div class="item">
                <input type="password" name="current_password" placeholder="Mật khẩu hiện tại" style="margin-bottom: 10px;">
            </div>
            <div class="item">
                <input type="password" name="new_password" placeholder="Mật khẩu mới" style="margin-bottom: 10px;">
            </div>
            <div class="item">
                <input type="password" name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới">
            </div>
            <button type="submit" class="btn-save">Cập nhật mật khẩu</button>
        </form>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // 1. Reset trạng thái active của menu trái
        document.getElementById('tab-info').classList.remove('active');
        document.getElementById('tab-account').classList.remove('active');

        // 2. Ẩn tất cả các panel bên phải
        document.getElementById('panel-info').style.display = 'none';
        document.getElementById('panel-account').style.display = 'none';

        // 3. Kích hoạt menu và hiển thị panel tương ứng với tab được click
        if (tabName === 'info') {
            document.getElementById('tab-info').classList.add('active');
            document.getElementById('panel-info').style.display = 'flex';
        } else if (tabName === 'account') {
            document.getElementById('tab-account').classList.add('active');
            document.getElementById('panel-account').style.display = 'flex';
        }
    }

    // ==========================================
    // 1. HÀM XỬ LÝ LƯU HỒ SƠ CÁ NHÂN
    // ==========================================
    function handleSaveSettings(event) {
        event.preventDefault(); // Ngăn chặn form load lại trang
        const formElement = event.target;

        // --- BƯỚC 1: VALIDATION (KIỂM TRA DỮ LIỆU) ---
        const avatarInput = formElement.querySelector('input[type="file"]#upload-avatar');
        const nameInput = formElement.querySelector('input[name="name"]');
        const phoneInput = formElement.querySelector('input[name="phoneNumber"]');
        const addressInput = formElement.querySelector('input[name="houseNumber"]');
        const provinceSelect = formElement.querySelector('select[name="province"]');
        const wardSelect = formElement.querySelector('select[name="ward"]');
        const pidInput = formElement.querySelector('input[name="pid"]');
        const genderSelect = formElement.querySelector('select[name="gender"]');
        const dobInput = formElement.querySelector('input[name="dateOfBirth"]');

        // Xóa lỗi cũ
        [avatarInput, nameInput, phoneInput, addressInput, provinceSelect, wardSelect, pidInput, genderSelect, dobInput].forEach(input => {
            if (input) Validator.clearError(input);
        });

        let isValid = true;

        if (avatarInput && avatarInput.files.length > 0) {
            const avatarErr = Validator.checkImage(avatarInput, false); 
            if (avatarErr) { Validator.showError(avatarInput, avatarErr); isValid = false; }
        }

        const nameValue = nameInput ? nameInput.value.trim() : '';
        const nameErr = Validator.isRequired(nameValue, 'Họ và tên không được để trống!') || Validator.checkLength(nameValue, 3, 255, 'Họ và tên');
        if (nameErr) { Validator.showError(nameInput, nameErr); isValid = false; }

        const phoneValue = phoneInput ? phoneInput.value.trim() : '';
        const phoneErr = Validator.isRequired(phoneValue, 'Số điện thoại không được để trống!') || Validator.isPhone(phoneValue);
        if (phoneErr) { Validator.showError(phoneInput, phoneErr); isValid = false; }

        const addressValue = addressInput ? addressInput.value.trim() : '';
        const addressErr = Validator.isRequired(addressValue, 'Địa chỉ không được để trống!') || Validator.checkLength(addressValue, 3, 255, 'Địa chỉ');
        if (addressErr) { Validator.showError(addressInput, addressErr); isValid = false; }

        const provinceErr = Validator.isRequired(provinceSelect?.value, 'Vui lòng chọn Tỉnh/Thành phố!');
        if (provinceErr) { Validator.showError(provinceSelect, provinceErr); isValid = false; }

        const wardErr = Validator.isRequired(wardSelect?.value, 'Vui lòng chọn Phường/Xã!');
        if (wardErr) { Validator.showError(wardSelect, wardErr); isValid = false; }

        const pidValue = pidInput ? pidInput.value.trim() : '';
        const pidErr = Validator.isRequired(pidValue, 'Căn cước công dân không được để trống!') || Validator.isCCCD(pidValue);
        if (pidErr) { Validator.showError(pidInput, pidErr); isValid = false; }

        const genderErr = Validator.isRequired(genderSelect?.value, 'Vui lòng chọn Giới tính!');
        if (genderErr) { Validator.showError(genderSelect, genderErr); isValid = false; }

        const dobValue = dobInput ? dobInput.value.trim() : '';
        const dobErr = Validator.isRequired(dobValue, 'Ngày sinh không được để trống!') || Validator.isDate(dobValue);
        if (dobErr) { Validator.showError(dobInput, dobErr); isValid = false; }

        // NẾU CÓ LỖI THÌ DỪNG LẠI NGAY, KHÔNG GỌI API
        if (!isValid) return; 

        // --- BƯỚC 2: GỌI API LƯU DỮ LIỆU ---
        let formData = new FormData(formElement);

        if (avatarInput && avatarInput.files.length > 0) {
            formData.append('profile_url', avatarInput.files[0]); 
        }

        const adminId = <?php echo $id; ?>; 
        formData.append('_method', 'PUT'); 
        formData.append('target_endpoint', `personalInfos/${adminId}`);

        fetch('core/api_proxy.php', {
            method: 'POST',
            headers: { "Accept": "application/json" },
            body: formData
        })
        .then(async response => {
            const result = await response.json();
            if (!response.ok || result.errors || result.status === 'error') {
                let errorMsg = result.message || "Có lỗi xảy ra!";
                if (result.errors) {
                    errorMsg += "\n" + Object.values(result.errors).map(e => e.join(", ")).join("\n");
                }
                throw new Error(errorMsg);
            }
            return result;
        })
        .then(result => {
            alert("Cập nhật thông tin thành công!");
            window.location.reload(); 
        })
        .catch(error => {
            console.error("Lỗi cập nhật:", error);
            alert(error.message);
        });
    }

    // Đổi Avatar Preview
    document.getElementById('upload-avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // ==========================================
    // 2. HÀM XỬ LÝ ĐỔI MẬT KHẨU
    // ==========================================
    function handleSavePassword(event) {
        event.preventDefault(); 
        const formElement = event.target;

        // --- BƯỚC 1: VALIDATION ---
        const currentPassInput = formElement.querySelector('input[name="current_password"]');
        const newPassInput = formElement.querySelector('input[name="new_password"]');
        const confirmPassInput = formElement.querySelector('input[name="new_password_confirmation"]');

        [currentPassInput, newPassInput, confirmPassInput].forEach(input => {
            if (input) Validator.clearError(input);
        });

        let isValid = true;

        const currPassErr = Validator.isRequired(currentPassInput?.value, 'Vui lòng nhập mật khẩu hiện tại!');
        if (currPassErr) { Validator.showError(currentPassInput, currPassErr); isValid = false; }

        const newPassValue = newPassInput ? newPassInput.value.trim() : '';
        if (newPassValue === '') {
            Validator.showError(newPassInput, 'Mật khẩu mới không được để trống!');
            isValid = false;
        } else {
            const passLenErr = Validator.checkLength(newPassValue, 8, 255, 'Mật khẩu mới');
            if (passLenErr) { Validator.showError(newPassInput, passLenErr); isValid = false; }
        }

        const confirmPassValue = confirmPassInput ? confirmPassInput.value.trim() : '';
        if (confirmPassValue === '') {
            Validator.showError(confirmPassInput, 'Vui lòng xác nhận mật khẩu mới!');
            isValid = false;
        } else if (confirmPassValue !== newPassValue) {
            Validator.showError(confirmPassInput, 'Mật khẩu xác nhận không khớp!');
            isValid = false;
        }

        // Dừng nếu có lỗi
        if (!isValid) return;

        // --- BƯỚC 2: GỌI API ---
        let formData = new FormData(formElement);
        const adminId = <?php echo $id; ?>; 
        
        formData.append('target_endpoint', `accounts/${adminId}/change-password`);
        fetch('core/api_proxy.php', {
            method: 'POST',
            headers: { "Accept": "application/json" },
            body: formData
        })
        .then(async response => {
            const result = await response.json();
            if (!response.ok || result.errors || result.status === 'error') {
                let errorMsg = result.message || "Lỗi cập nhật mật khẩu!";
                if (result.errors) {
                    errorMsg += "\n" + Object.values(result.errors).map(e => e.join(", ")).join("\n");
                }
                throw new Error(errorMsg);
            }
            return result;
        })
        .then(result => {
            alert("Đổi mật khẩu thành công! Hệ thống sẽ yêu cầu đăng nhập lại.");
            window.location.href = 'logout.php'; 
        })
        .catch(error => {
            console.error("Lỗi:", error);
            alert(error.message);
        });
    }

    // ==========================================
    // 3. XỬ LÝ LOAD TỈNH THÀNH / PHƯỜNG XÃ
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        const citySelect = document.getElementById('city-select');
        const wardSelect = document.getElementById('ward-select');

        if (citySelect && wardSelect) {
            const userProvince = "<?php echo htmlspecialchars($info['province'] ?? ''); ?>";
            const userWard = "<?php echo htmlspecialchars($info['ward'] ?? ''); ?>";

            if (userProvince) {
                citySelect.value = userProvince; 
                if (citySelect.value) {
                    // Đảm bảo bạn đã khai báo hàm loadWards ở đâu đó trong dự án nhé
                    if (typeof loadWards === 'function') {
                        loadWards(userProvince, userWard); 
                    }
                }
            }

            citySelect.addEventListener('change', function() {
                const selectedProvince = this.value; 
                if (selectedProvince && typeof loadWards === 'function') {
                    loadWards(selectedProvince, null); 
                } else {
                    wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                }
            });
        }
    });
</script>