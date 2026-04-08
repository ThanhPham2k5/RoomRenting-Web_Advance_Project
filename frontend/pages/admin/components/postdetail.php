<?php
    $apiRole = call_api("http://backend.test/api/address/provinces");
    $provinces= $apiRole['data'] ?? [];
    $apiRole = call_api("http://backend.test/api/address/wards");
    $wards= $apiRole['data'] ?? [];
?>

<div class="post-detail-component-overlay view-mode" id="post-detail-modal">
    <div class="post-detail-component-content">
        <div class="post-img">
            <div class="main-image-wrapper image-slot" data-slot="main" style="cursor: pointer;">
                <img id="img-main" src="../../assets/admin/images/post_img.png" alt="Ảnh chính">
                <button class="btn-delete-img" type="button" title="Xóa ảnh này">×</button>
                <input type="hidden" name="existing_images[main]" value="url_anh_chinh_cu.jpg">
            </div>

            <div class="sub-post-img" id="detail-sub-imgs">
                <div class="image-wrapper image-slot" data-slot="sub_1" style="cursor: pointer;">
                    <img id="img-sub_1" src="../../assets/admin/images/post_img.png" alt="Ảnh phụ 1">
                    <button class="btn-delete-img" type="button" title="Xóa ảnh này">×</button>
                    <input type="hidden" name="existing_images[sub_1]" value="url_anh_phu_1_cu.jpg">
                </div>
                
                <div class="image-wrapper image-slot" data-slot="sub_2" style="cursor: pointer;">
                    <img id="img-sub_2" src="../../assets/admin/images/post_img.png" alt="Ảnh phụ 2">
                    <button class="btn-delete-img" type="button" title="Xóa ảnh này">×</button>
                    <input type="hidden" name="existing_images[sub_2]" value="url_anh_phu_2_cu.jpg">
                </div>
                
                <div class="image-wrapper image-slot" data-slot="sub_3" style="cursor: pointer;">
                    <img id="img-sub_3" src="../../assets/admin/images/post_img.png" alt="Ảnh phụ 3">
                    <button class="btn-delete-img" type="button" title="Xóa ảnh này">×</button>
                    <input type="hidden" name="existing_images[sub_3]" value="url_anh_phu_3_cu.jpg">
                </div>
            </div>
            <label class="btn-upload-img">Nhấn vào ảnh để sửa</label>
            <input type="file" id="hidden-file-input" accept="image/*" style="display: none;">
        </div>

        <div class="right-column-slider">
            <div class="slider-track">
                <div class="post-info" id="info-view">
                    <p id="detail-id">ID bài đăng: 123</p>
                    <p id="detail-title">Phòng giá 5 tỷ/ tháng, đường Trương Phước Phan, phường Bình Trị Đông, quận Bình Tân</p>
                    <div class="location">
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.72 14.64C2.97461 14.5657 3.24829 14.5957 3.48083 14.7232C3.71338 14.8507 3.88574 15.0654 3.96 15.32C4.03426 15.5746 4.00434 15.8483 3.87681 16.0808C3.74929 16.3134 3.53461 16.4857 3.28 16.56C2.78 16.706 2.42 16.86 2.189 17C2.427 17.143 2.803 17.303 3.325 17.452C4.48 17.782 6.133 18 8 18C9.867 18 11.52 17.782 12.675 17.452C13.198 17.303 13.573 17.143 13.811 17C13.581 16.86 13.221 16.706 12.721 16.56C12.4704 16.4825 12.2603 16.3096 12.136 16.0786C12.0117 15.8476 11.9831 15.577 12.0564 15.3251C12.1298 15.0733 12.2991 14.8603 12.528 14.7321C12.7569 14.604 13.0269 14.5709 13.28 14.64C13.948 14.835 14.56 15.085 15.03 15.406C15.465 15.705 16 16.226 16 17C16 17.783 15.452 18.308 15.01 18.607C14.532 18.929 13.907 19.18 13.224 19.375C11.846 19.77 10 20 8 20C6 20 4.154 19.77 2.776 19.375C2.093 19.18 1.468 18.929 0.99 18.607C0.548 18.307 0 17.783 0 17C0 16.226 0.535 15.705 0.97 15.406C1.44 15.085 2.052 14.835 2.72 14.64ZM8 0C9.98912 0 11.8968 0.790176 13.3033 2.1967C14.7098 3.60322 15.5 5.51088 15.5 7.5C15.5 10.068 14.1 12.156 12.65 13.64C12.0736 14.2239 11.4542 14.7638 10.797 15.255C10.203 15.701 8.845 16.537 8.845 16.537C8.58744 16.6834 8.29626 16.7604 8 16.7604C7.70374 16.7604 7.41256 16.6834 7.155 16.537C6.48106 16.1462 5.82938 15.7182 5.203 15.255C4.54484 14.765 3.92534 14.2251 3.35 13.64C1.9 12.156 0.5 10.068 0.5 7.5C0.5 5.51088 1.29018 3.60322 2.6967 2.1967C4.10322 0.790176 6.01088 0 8 0ZM8 2C6.54131 2 5.14236 2.57946 4.11091 3.61091C3.07946 4.64236 2.5 6.04131 2.5 7.5C2.5 9.316 3.496 10.928 4.78 12.24C5.746 13.228 6.81 13.98 7.547 14.442L8 14.716L8.453 14.442C9.189 13.98 10.254 13.228 11.22 12.241C12.504 10.928 13.5 9.317 13.5 7.5C13.5 6.04131 12.9205 4.64236 11.8891 3.61091C10.8576 2.57946 9.45869 2 8 2ZM8 4.5C8.39397 4.5 8.78407 4.5776 9.14805 4.72836C9.51203 4.87913 9.84274 5.1001 10.1213 5.37868C10.3999 5.65726 10.6209 5.98797 10.7716 6.35195C10.9224 6.71593 11 7.10603 11 7.5C11 7.89397 10.9224 8.28407 10.7716 8.64805C10.6209 9.01203 10.3999 9.34274 10.1213 9.62132C9.84274 9.8999 9.51203 10.1209 9.14805 10.2716C8.78407 10.4224 8.39397 10.5 8 10.5C7.20435 10.5 6.44129 10.1839 5.87868 9.62132C5.31607 9.05871 5 8.29565 5 7.5C5 6.70435 5.31607 5.94129 5.87868 5.37868C6.44129 4.81607 7.20435 4.5 8 4.5ZM8 6.5C7.73478 6.5 7.48043 6.60536 7.29289 6.79289C7.10536 6.98043 7 7.23478 7 7.5C7 7.76522 7.10536 8.01957 7.29289 8.20711C7.48043 8.39464 7.73478 8.5 8 8.5C8.26522 8.5 8.51957 8.39464 8.70711 8.20711C8.89464 8.01957 9 7.76522 9 7.5C9 7.23478 8.89464 6.98043 8.70711 6.79289C8.51957 6.60536 8.26522 6.5 8 6.5Z" fill="currentColor"/>
                        </svg>
                        <p id="detail-location">Phường Bình Trị Đông, Tp Hồ Chí Minh</p>
                    </div>
                    <div class="price">
                        <p class="main" id="detail-price">3.000.000 VNĐ/ tháng</p>
                        <p class="area" id="detail-area">57.5 m²</p>
                    </div>
                    <p id="detail-deposit">Số tiền cọc: 3 tỷ</p>
                    <div class="roomtype">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 19H13V16H6V19ZM15 19H18V16H15V19ZM6 14H9V11.025H6V14ZM11 14H18V11.025H11V14ZM7.3 9.025H16.7L12 5.5L7.3 9.025ZM6 21C5.45 21 4.97933 20.8043 4.588 20.413C4.19667 20.0217 4.00067 19.5507 4 19V10C4 9.68333 4.071 9.38333 4.213 9.1C4.355 8.81667 4.55067 8.58333 4.8 8.4L10.8 3.9C10.9833 3.76667 11.175 3.66667 11.375 3.6C11.575 3.53333 11.7833 3.5 12 3.5C12.2167 3.5 12.425 3.53333 12.625 3.6C12.825 3.66667 13.0167 3.76667 13.2 3.9L19.2 8.4C19.45 8.58333 19.646 8.81667 19.788 9.1C19.93 9.38333 20.0007 9.68333 20 10V19C20 19.55 19.804 20.021 19.412 20.413C19.02 20.805 18.5493 21.0007 18 21H6Z" fill="currentColor"/>
                        </svg>
                        <p id="room-type">Phường Bình Trị Đông, Tp Hồ Chí Minh</p>
                    </div>
                    <div class="occupants">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 11C17.66 11 18.99 9.66 18.99 8C18.99 6.34 17.66 5 16 5C14.34 5 13 6.34 13 8C13 9.66 14.34 11 16 11ZM8 11C9.66 11 10.99 9.66 10.99 8C10.99 6.34 9.66 5 8 5C6.34 5 5 6.34 5 8C5 9.66 6.34 11 8 11ZM8 13C5.67 13 1 14.17 1 16.5V18C1 18.55 1.45 19 2 19H14C14.55 19 15 18.55 15 18V16.5C15 14.17 10.33 13 8 13ZM16 13C15.71 13 15.38 13.02 15.03 13.05C15.05 13.06 15.06 13.08 15.07 13.09C16.21 13.92 17 15.03 17 16.5V18C17 18.35 16.93 18.69 16.82 19H22C22.55 19 23 18.55 23 18V16.5C23 14.17 18.33 13 16 13Z" fill="#1F2937"/>
                        </svg>
                        <p id="occupants-data">Phường Bình Trị Đông, Tp Hồ Chí Minh</p>
                    </div>
                    <p>Mô tả chi tiết</p>
                    <p class="detail" id="detail-description">Địa chỉ: Đường Tân Nhất 13 , Phường Tân Thới Nhất , Quận 12  
                        Phòng ngay trục đường Trường Chinh QUẬN 12 , thuận tiện di chuyển qua Tân Bình , Gv, ...Cách trường HUFLIT Hốc Môn 4km  
                        Cổng vân tay, camera an ninh  
                        Giờ giấc tự do, không chung chủ  
                        Có Thang máy và Sân Thượng</p>
                    <p id="detail-user-id">ID người đăng bài: 123</p>
                    <p id="detail-employee-id">ID nhân viên duyệt bài: 123</p>
                    <div class="payment-history">
                        <p class="section-title">Lịch sử thanh toán</p>
                        <div class="history-list">
                            <div class="history-item">
                                <div class="hist-icon success">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </div>
                                <div class="hist-info">
                                    <span class="hist-desc">Thanh toán đẩy tin VIP 3 ngày</span>
                                    <span class="hist-date">06/04/2026 - 14:30</span>
                                </div>
                                <span class="hist-amount minus">- 150.000đ</span>
                            </div>
                            <div class="history-item">
                                <div class="hist-icon success">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </div>
                                <div class="hist-info">
                                    <span class="hist-desc">Đăng tin phòng trọ (Gói cơ bản)</span>
                                    <span class="hist-date">01/04/2026 - 09:15</span>
                                </div>
                                <span class="hist-amount minus">- 20.000đ</span>
                            </div>
                        </div>
                    </div>
                    <p id="reason"></p>
                    <div class="post-info-btn">
                        <button class="handle" style="background-color: #3B82F6;" onclick="switchToEdit()">Chỉnh sửa</button>
                    </div>
                </div>

                <div class="post-edit" id="info-edit">
                    <form onsubmit="handleSave(event, this)" method="POST" id="form-edit-post" action="">
                        <input type="hidden" name="action" value="editPost">
                        <div class="post-edit-body">
                            <input type="hidden" name="id" value="">

                            <div class="input-group">
                                <label>Tiêu đề bài đăng</label>
                                <input type="text" name="title" value="" placeholder="Ví dụ: Cho thuê phòng trọ khép kín mới xây...">
                            </div>
                            
                            <div class="input-group">
                                <label>Giá thuê (VNĐ/tháng)</label>
                                <input type="number" name="price" value="" placeholder="Ví dụ: 3000000" min="0">
                            </div>
                            
                            <div class="input-group">
                                <label>Tiền đặt cọc (VNĐ)</label>
                                <input type="number" name="deposit" value="" placeholder="Ví dụ: 1000000" min="0">
                            </div>
                            
                            <div class="input-group">
                                <label>Diện tích (m²)</label>
                                <input type="number" name="area" value="" placeholder="Ví dụ: 25" min="1" step="0.1">
                            </div>

                            <div class="input-group">
                                <label>Số nhà</label>
                                <input type="number" name="houseNumber" value="" placeholder="Ví dụ: 36">
                            </div>
                            
                            <div class="input-group">
                                <label>Tỉnh, Thành Phố</label>
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
                                <label>Quận, Huyện, Phường, Xã</label>
                                <select name="ward" id="ward-select">
                                    <option value="">-- Chọn Phường/Xã --</option>
                                    </select>
                            </div>
                            
                            <div class="input-group">
                                <label>Kiểu phòng</label>
                                <select name="roomType">
                                    <option value="">-- Chọn kiểu phòng --</option>
                                    <option value="room">Phòng trọ khép kín</option>
                                    <option value="apartment">Chung cư mini</option>
                                    <option value="dorm">Ở ghép</option>
                                </select>
                            </div>
                            
                            <div class="input-group">
                                <label>Số người ở tối đa</label>
                                <input type="number" name="maxOccupants" value="" placeholder="Ví dụ: 2">
                            </div>
                            
                            <div class="input-group" style="grid-column: 1 / -1;"> <label>Mô tả chi tiết</label>
                                <textarea name="description" placeholder="Mô tả về tiện ích, an ninh, điện nước..." rows="5"></textarea>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button class="submit btn-form-edit" type="submit">Xác nhận</button>
                            <button class="cancel btn-form-edit" type="button" onclick="switchToView()">Quay lại</button>                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function validatePostForm(form) {
    let hasError = false;
    
    // Khởi tạo mảng các rule cần kiểm tra cho Form Bài Đăng
    const rules = [
        // 1. Tiêu đề
        {
            input: form.title,
            checks: [
                () => Validator.isRequired(form.title.value, "Tiêu đề không được để trống."),
                () => Validator.checkLength(form.title.value, 0, 255, "Tiêu đề")
            ]
        },
        // 2. Giá thuê
        {
            input: form.price,
            checks: [
                () => Validator.isRequired(form.price.value, "Giá thuê không được để trống."),
                () => (Number(form.price.value) <= 0 ? "Giá thuê phải lớn hơn 0." : undefined)
            ]
        },
        // 3. Tiền đặt cọc
        {
            input: form.deposit,
            checks: [
                () => Validator.isRequired(form.deposit.value, "Tiền đặt cọc không được để trống."),
                () => (Number(form.deposit.value) < 0 ? "Tiền đặt cọc không được là số âm." : undefined),
                // Luật so sánh: Cọc phải nhỏ hơn Giá thuê
                () => {
                    const priceVal = form.price.value;
                    const depositVal = form.deposit.value;
                    // Chỉ so sánh khi cả Giá và Cọc đều đã được người dùng nhập
                    if (priceVal && depositVal) {
                        if (Number(depositVal) >= Number(priceVal)) {
                            return "Tiền đặt cọc phải nhỏ hơn giá thuê.";
                        }
                    }
                    return undefined;
                }
            ]
        },
        // 4. Diện tích
        {
            input: form.area,
            checks: [() => Validator.isRequired(form.area.value, "Diện tích không được để trống.")]
        },
        // 5. Tỉnh/Thành phố
        {
            input: form.province,
            checks: [() => Validator.isRequired(form.province.value, "Tỉnh, Thành phố không được để trống.")]
        },
        // 6. Phường/Xã
        {
            input: form.ward,
            checks: [() => Validator.isRequired(form.ward.value, "Quận, Huyện, Phường, Xã không được để trống.")]
        },
        // 7. Kiểu phòng
        {
            input: form.room_type,
            checks: [() => Validator.isRequired(form.room_type.value, "Kiểu phòng không được để trống.")]
        },
        // 8. Số người ở tối đa
        {
            input: form.max_occupants,
            checks: [
                () => Validator.isRequired(form.max_occupants.value, "Số người ở tối đa không được để trống."),
                // Luật số người không được âm (Thực tế số người ở tối thiểu phải là 1)
                () => (Number(form.max_occupants.value) <= 0 ? "Số người ở tối đa phải lớn hơn 0." : undefined)
            ]
        },
        // 9. Mô tả chi tiết
        {
            input: form.description,
            checks: [
                () => Validator.checkLength(form.description.value, 0, 255, "Mô tả")
            ]
        }
    ];

    // Chạy vòng lặp kiểm tra toàn bộ các trường text/select
    rules.forEach(item => {
        if (!item.input) return; // Bỏ qua nếu field không tồn tại trong form
        
        Validator.clearError(item.input); // Dọn lỗi cũ đi trước
        let errorMsg = undefined;

        // Chạy qua từng luật (Ví dụ Tiêu đề chạy qua 2 luật: isRequired và checkLength)
        for (let checkFunc of item.checks) {
            errorMsg = checkFunc();
            if (errorMsg) break; // Nếu đụng 1 lỗi thì dừng lại, không check tiếp luật sau
        }

        if (errorMsg) {
            Validator.showError(item.input, errorMsg);
            hasError = true;
        }
    });

    // ===============================================
    // 10. KIỂM TRA ẢNH ĐẠI DIỆN CHÍNH (GIAO DIỆN CLICK TO EDIT)
    // ===============================================
    const imgMain = document.getElementById('img-main');
    const mainImgWrapper = document.querySelector('.main-image-wrapper');
    
    // Dọn dẹp lỗi cũ (nếu có)
    if (mainImgWrapper) Validator.clearError(mainImgWrapper);
    
    let hasMainImage = false;

    // Kiểm tra xem hình ảnh hiện tại có phải là hình mặc định không
    // Nếu src không chứa chữ 'post_img.png' -> Tức là đã có ảnh thật (ảnh cũ từ DB hoặc ảnh vừa tải lên)
    if (imgMain && imgMain.src && !imgMain.src.includes('post_img.png')) {
        hasMainImage = true;
    }

    // Nếu không có ảnh -> Gán lỗi thẳng vào cái khung bao bọc ảnh chính
    if (!hasMainImage) {
        if (mainImgWrapper) {
            Validator.showError(mainImgWrapper, "Bắt buộc phải có ảnh đại diện (Ảnh chính).");
        }
        hasError = true;
    }

    // Nếu CÓ lỗi thì trả về false (ngăn chặn submit form)
    return !hasError; 
}
// Hàm đổ dữ liệu Lịch sử thanh toán
function renderPaymentHistory(payBills) {
    const listContainer = document.querySelector('.history-list');
    
    // Nếu không tìm thấy vùng chứa HTML, thoát luôn
    if (!listContainer) return;

    // Nếu mảng rỗng (không có lịch sử)
    if (!payBills || payBills.length === 0) {
        listContainer.innerHTML = '<p style="text-align:center; color:#94A3B8; padding: 10px 0;">Chưa có lịch sử thanh toán nào.</p>';
        return;
    }

    // Xóa sạch dữ liệu mẫu (HTML cứng)
    listContainer.innerHTML = '';

    let htmlContent = '';

    payBills.forEach(bill => {
        // 1. Xử lý format ngày tháng (từ 2026-04-05T02... -> 05/04/2026 - 09:04)
        const dateObj = new Date(bill.createdAt);
        const day = String(dateObj.getDate()).padStart(2, '0');
        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
        const year = dateObj.getFullYear();
        const hours = String(dateObj.getHours()).padStart(2, '0');
        const minutes = String(dateObj.getMinutes()).padStart(2, '0');
        const formattedDate = `${day}/${month}/${year} - ${hours}:${minutes}`;

        // 2. Chuẩn bị Icon và Màu sắc tương ứng với Status
        let iconSvg = '';
        let statusClass = '';
        let statusText = '';

        switch (bill.status) {
            case 'completed': // Thành công (Màu Xanh lá)
                statusClass = 'success';
                statusText = 'Thanh toán thành công';
                iconSvg = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
                break;
            case 'failed': // Thất bại (Màu Đỏ)
                statusClass = 'error';
                statusText = 'Thanh toán thất bại';
                iconSvg = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`;
                break;
            case 'pending': // Đang chờ (Màu Cam)
                statusClass = 'warning';
                statusText = 'Đang chờ xử lý';
                iconSvg = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>`;
                break;
            default:
                statusClass = 'info';
                statusText = 'Không xác định';
                iconSvg = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>`;
        }

        // 3. Nối HTML cho từng dòng (Gắn biến vào chuỗi bằng Dấu Backtick `)
        htmlContent += `
            <div class="history-item">
                <div class="hist-icon ${statusClass}">
                    ${iconSvg}
                </div>
                <div class="hist-info">
                    <span class="hist-desc">${statusText} (Mã: #${bill.id})</span>
                    <span class="hist-date">${formattedDate}</span>
                </div>
                <span class="hist-amount minus">- ${bill.points} điểm</span>
            </div>
        `;
    });

    // Bơm toàn bộ HTML vừa tạo vào vùng chứa
    listContainer.innerHTML = htmlContent;
}
</script>