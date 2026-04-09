const Validator = {
    // 1. Kiểm tra rỗng (Áp dụng cho mọi loại: Text, Select, Checkbox Array)
    isRequired: function(value, customMessage = 'Trường này không được để trống!') {
        if (value === null || value === undefined) return customMessage;
        if (typeof value === 'string' && value.trim() === '') return customMessage;
        if (Array.isArray(value) && value.length === 0) return customMessage;
        return undefined;
    },

    // 2. Kiểm tra độ dài (Tích hợp cả Min và Max)
    // - Truyền min = 0 nếu chỉ cần check Max (VD: Thanh tìm kiếm, Mô tả)
    checkLength: function(value, min, max, fieldName = 'Dữ liệu') {
        const val = value ? value.trim() : '';
        if (val.length < min || val.length > max) {
            if (min === 0) return `${fieldName} không được vượt quá ${max} ký tự!`;
            return `${fieldName} phải từ ${min} đến ${max} ký tự!`;
        }
        return undefined;
    },

    // 3. Kiểm tra Email
    isEmail: function(value) {
        if (!value || value.trim() === '') return undefined; // Nếu trống thì để isRequired lo
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(value) ? undefined : 'Email không đúng định dạng!';
    },

    // 4. Kiểm tra Số điện thoại (Đầu 03, 05, 07, 08, 09 và đủ 10 số)
    isPhone: function(value) {
        if (!value || value.trim() === '') return undefined;
        const regex = /^(03|05|07|08|09)[0-9]{8}$/;
        return regex.test(value) ? undefined : 'Số điện thoại không hợp lệ (Phải có 10 số, đầu 03/05/07/08/09)!';
    },

    // 5. Kiểm tra Căn cước công dân (Đúng 12 số)
    isCCCD: function(value) {
        if (!value || value.trim() === '') return undefined;
        const regex = /^[0-9]{12}$/;
        return regex.test(value) ? undefined : 'Căn cước công dân phải bao gồm đúng 12 chữ số!';
    },

    // 6. Kiểm tra Ngày sinh (Định dạng yyyy-mm-dd)
    isDate: function(value) {
        if (!value || value.trim() === '') return undefined;
        const regex = /^\d{4}-\d{2}-\d{2}$/;
        if (!regex.test(value)) return 'Ngày sinh phải theo định dạng YYYY-MM-DD!';
        
        // Kiểm tra xem ngày có tồn tại thực tế không (VD: 2026-02-30 sẽ bị chặn)
        const dateObj = new Date(value);
        if (Number.isNaN(dateObj.getTime()) || dateObj.toISOString().slice(0,10) !== value) {
            return 'Ngày không hợp lệ!';
        }
        return undefined;
    },

    // 7. Kiểm tra File Ảnh (JPG/PNG, Max 2MB)
    // Biến isRequiredFile = true cho Bài đăng, false cho Hồ sơ cá nhân
    checkImage: function(fileInput, isRequiredFile = false) {
        const files = fileInput.files;
        
        if (!files || files.length === 0) {
            return isRequiredFile ? 'Vui lòng tải lên ít nhất 1 ảnh!' : undefined;
        }

        const file = files[0]; // Lấy ảnh đầu tiên
        
        // Check định dạng
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            return 'Ảnh chỉ chấp nhận định dạng JPG hoặc PNG!';
        }

        // Check dung lượng (2MB = 2 * 1024 * 1024 bytes)
        const maxSize = 2 * 1024 * 1024; 
        if (file.size > maxSize) {
            return 'Dung lượng ảnh không được vượt quá 2MB!';
        }

        return undefined;
    },

    // ==========================================
    // HÀM TIỆN ÍCH HIỂN THỊ LỖI LÊN GIAO DIỆN
    // ==========================================

    showError: function(inputElement, errorMessage) {
        if (!inputElement) return;
        // Tìm thẻ <span class="error-msg"> nằm gần thẻ input
        // Nếu bạn bọc input trong <div class="input-group"> thì có thể dùng parentElement
        const parent = inputElement.closest('.input-group') || inputElement.parentElement;
        let errorSpan = parent.querySelector('.error-msg');
        
        // Nếu chưa có thẻ span báo lỗi, tự động tạo ra
        if (!errorSpan) {
            errorSpan = document.createElement('span');
            errorSpan.className = 'error-msg';
            errorSpan.style.color = '#DC2626';
            errorSpan.style.fontSize = '13px';
            errorSpan.style.marginTop = '4px';
            errorSpan.style.display = 'block';
            parent.appendChild(errorSpan);
        }

        errorSpan.innerText = errorMessage;
        inputElement.style.borderColor = '#DC2626'; 
    },

    clearError: function(inputElement) {
        if (!inputElement) return;
        const parent = inputElement.closest('.input-group') || inputElement.parentElement;
        const errorSpan = parent.querySelector('.error-msg');
        if (errorSpan) {
            errorSpan.innerText = '';
        }
        inputElement.style.borderColor = '';
    }
};
// Hàm hiển thị Toast Toàn cục
function showToast({ title = '', message = '', type = 'info', duration = 3000 }) {
    const main = document.getElementById('toast-container');
    if (main) {
        const toast = document.createElement('div');

        // Tự động xóa Toast sau thời gian duration + animation
        const autoRemoveId = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 400); // 400ms là thời gian hiệu ứng fadeOut chạy

        // Xóa Toast khi người dùng click vào nút X
        toast.onclick = function (e) {
            if (e.target.closest('.toast-close')) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
            success: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`,
            error: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`,
            warning: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>`,
            info: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>`
        };

        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2); // Tính giây để truyền vào CSS

        toast.classList.add('toast-msg', type);
        toast.style.setProperty('--delay', `${delay}s`);
        toast.style.setProperty('--duration', `${duration}ms`);

        toast.innerHTML = `
            <div class="toast-icon">${icon}</div>
            <div class="toast-body">
                <h3 class="toast-title">${title}</h3>
                <p class="toast-desc">${message}</p>
            </div>
            <button class="toast-close">&times;</button>
        `;
        
        main.appendChild(toast);
    }
}
// ===============================================
// 1. HÀM HIỂN THỊ CONFIRM (CÓ / KHÔNG)
// ===============================================
function showConfirm(title, message, isDanger = false) {
    return new Promise((resolve) => {
        const overlay = document.createElement('div');
        overlay.className = 'custom-dialog-overlay';
        
        const confirmBtnClass = isDanger ? 'danger' : 'confirm';
        const confirmText = isDanger ? 'Xóa' : 'Xác nhận';

        overlay.innerHTML = `
            <div class="custom-dialog-box">
                <div class="custom-dialog-title">${title}</div>
                <div class="custom-dialog-message">${message}</div>
                <div class="custom-dialog-actions">
                    <button class="btn-dialog cancel" id="dialog-btn-cancel">Hủy (ESC)</button>
                    <button class="btn-dialog ${confirmBtnClass}" id="dialog-btn-confirm">${confirmText} (Enter)</button>
                </div>
            </div>
        `;

        document.body.appendChild(overlay);
        setTimeout(() => overlay.classList.add('show'), 10);

        const btnCancel = overlay.querySelector('#dialog-btn-cancel');
        const btnConfirm = overlay.querySelector('#dialog-btn-confirm');

        // Bắt sự kiện bàn phím
        const handleKeyDown = (e) => {
            if (e.key === 'Enter') {
                e.preventDefault(); // Ngăn hành vi mặc định của Enter (ví dụ: submit form nếu lỡ nằm trong form)
                btnConfirm.click();
            } else if (e.key === 'Escape') {
                e.preventDefault();
                btnCancel.click();
            }
        };
        document.addEventListener('keydown', handleKeyDown);

        const closeDialog = () => {
            overlay.classList.remove('show');
            document.removeEventListener('keydown', handleKeyDown); // Dọn dẹp sự kiện phím
            setTimeout(() => overlay.remove(), 200);
        };

        btnCancel.addEventListener('click', () => {
            closeDialog();
            resolve(false);
        });

        btnConfirm.addEventListener('click', () => {
            closeDialog();
            resolve(true);
        });
    });
}

// ===============================================
// 2. HÀM HIỂN THỊ PROMPT (NHẬP DỮ LIỆU)
// ===============================================
function showPrompt(title, message, placeholder = "") {
    return new Promise((resolve) => {
        const overlay = document.createElement('div');
        overlay.className = 'custom-dialog-overlay';

        overlay.innerHTML = `
            <div class="custom-dialog-box">
                <div class="custom-dialog-title">${title}</div>
                <div class="custom-dialog-message">${message}</div>
                <input type="text" class="custom-dialog-input" placeholder="${placeholder}" id="dialog-input">
                <div class="custom-dialog-actions">
                    <button class="btn-dialog cancel" id="dialog-btn-cancel">Hủy (ESC)</button>
                    <button class="btn-dialog confirm" id="dialog-btn-confirm">Xác nhận (Enter)</button>
                </div>
            </div>
        `;

        document.body.appendChild(overlay);
        setTimeout(() => overlay.classList.add('show'), 10);

        const inputField = overlay.querySelector('#dialog-input');
        inputField.focus(); 

        const btnCancel = overlay.querySelector('#dialog-btn-cancel');
        const btnConfirm = overlay.querySelector('#dialog-btn-confirm');

        // Bắt sự kiện bàn phím
        const handleKeyDown = (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                btnConfirm.click();
            } else if (e.key === 'Escape') {
                e.preventDefault();
                btnCancel.click();
            }
        };
        document.addEventListener('keydown', handleKeyDown);

        const closeDialog = () => {
            overlay.classList.remove('show');
            document.removeEventListener('keydown', handleKeyDown); // Dọn dẹp sự kiện phím
            setTimeout(() => overlay.remove(), 200);
        };

        btnCancel.addEventListener('click', () => {
            closeDialog();
            resolve(null); 
        });

        btnConfirm.addEventListener('click', () => {
            closeDialog();
            resolve(inputField.value); 
        });
    });
}