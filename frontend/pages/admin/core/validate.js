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
            errorSpan.style.color = '#DC2626'; // Đỏ
            errorSpan.style.fontSize = '13px';
            errorSpan.style.marginTop = '4px';
            errorSpan.style.display = 'block';
            parent.appendChild(errorSpan);
        }

        errorSpan.innerText = errorMessage;
        inputElement.style.borderColor = '#DC2626'; // Viền đỏ
    },

    clearError: function(inputElement) {
        if (!inputElement) return;
        const parent = inputElement.closest('.input-group') || inputElement.parentElement;
        const errorSpan = parent.querySelector('.error-msg');
        if (errorSpan) {
            errorSpan.innerText = '';
        }
        inputElement.style.borderColor = ''; // Trả lại viền mặc định
    }
};