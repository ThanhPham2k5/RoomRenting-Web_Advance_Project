<?php
session_start();
if (!isset($_SESSION['api_token'])) {
    header('Location: login.php');
    exit;
}
$adminName = $_SESSION['admin_user'] ?? "";
$adminRole = $_SESSION['admin_role'] ?? "";
$adminId = $_SESSION['admin_id'] ?? "";
require_once __DIR__ . '/core/function.php';
$pageData = [];
$page = $_GET['page'] ?? 'overview';
$validPage = ['overview', 'account', 'bill', 'comment', 'permission', 'post', 'price', 'setting'];
$currentTable = $_GET['table'] ?? '1';
$pageNum = $_GET['p'] ?? 1;
if(!in_array($page, $validPage)){
    $page = "overview";
}
$filterQuery = '';
if (isset($_GET['filter'])) {
    $filterQuery = '&' . http_build_query(['filter' => $_GET['filter']]);
}
switch ($page) {
    case 'account':
        $apiRole = ($currentTable === '1') ? 'user' : 'employee';
        $apiResult = call_api("http://backend.test/api/accounts?per_page=4&page={$pageNum}&filter[role]={$apiRole}" . $filterQuery);
        $pageData['accounts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=account&table={$currentTable}" . $filterQuery
        ];
        break;
    case 'comment':
        $apiResult = call_api("http://backend.test/api/comments?per_page=4&page={$pageNum}&include=account" . $filterQuery);
        $pageData['comments'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=comment&table={$currentTable}" . $filterQuery 
        ];
        break;
    case 'post':
        $apiSt = match($currentTable) {
            '1' => 'completed',
            '2' => 'rejected',
            '3' => 'pending',
            '4' => 'expired',
            '5' => 'failed',
            default => 'completed'
        };
        $apiResult = call_api("http://backend.test/api/posts?per_page=8&page={$pageNum}&include=postImages&filter[status]={$apiSt}" . $filterQuery);
        $pageData['posts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=post&table={$currentTable}" . $filterQuery
        ];
        break;
    case 'price':
        $apiType = match($currentTable) {
            '1' => 'payRules',
            '2' => 'rechargeRules',
            default => 'payRules'
        };
        $apiResult = call_api("http://backend.test/api/{$apiType}?per_page=4&page={$pageNum}" . $filterQuery);
        $pageData['rules'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=price&table={$currentTable}" . $filterQuery 
        ];
        break;
    case 'bill':
        $apiType = match($currentTable) {
            '1' => 'payBills',
            '2' => 'rechargeBills',
            default => 'payBills'
        };
        $apiInclude = match($currentTable) {
            '1' => 'account,post',
            '2' => 'account',
            default => 'account,post'
        };
        $apiResult = call_api("http://backend.test/api/{$apiType}?per_page=4&page={$pageNum}&include={$apiInclude}" . $filterQuery);
        $pageData['bills'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=bill&table={$currentTable}" . $filterQuery 
        ];
        break;
    case 'permission':
        $apiResult = call_api("http://backend.test/api/roles?per_page=4&page={$pageNum}" . $filterQuery);
        $pageData['permissions'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=permission&table={$currentTable}" . $filterQuery 
        ];
        break;
    case 'setting':
        $apiResult = call_api("http://backend.test/api/personalInfos/$adminId");
        $pageData['info'] = $apiResult['data'] ?? [];
        $pageData['id'] = $adminId ?? "";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../../css/admin/reset.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin/searchbar.css" />
    <link rel="stylesheet" href="../../css/admin/header.css" />
    <link rel="stylesheet" href="../../css/admin/navigation.css" />
    <link rel="stylesheet" href="../../css/admin/table.css" />
    <link rel="stylesheet" href="../../css/admin/main.css" />
    <link rel="stylesheet" href="../../css/admin/overview.css" />
    <link rel="stylesheet" href="../../css/admin/title.css" />
    <link rel="stylesheet" href="../../css/admin/index.css" />
    <link rel="stylesheet" href="../../css/admin/account.css" />
    <link rel="stylesheet" href="../../css/admin/permission.css" />
    <link rel="stylesheet" href="../../css/admin/comment.css" />
    <link rel="stylesheet" href="../../css/admin/bill.css" />
    <link rel="stylesheet" href="../../css/admin/price.css" />
    <link rel="stylesheet" href="../../css/admin/card.css" />
    <link rel="stylesheet" href="../../css/admin/pagination.css" />
    <link rel="stylesheet" href="../../css/admin/postcontainer.css" />
    <link rel="stylesheet" href="../../css/admin/postcontainer.css" />
    <link rel="stylesheet" href="../../css/admin/post.css" />
    <link rel="stylesheet" href="../../css/admin/form.css" />
    <link rel="stylesheet" href="../../css/admin/setting.css" />
    <link rel="stylesheet" href="../../css/admin/postdetail.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php renderComponent("form",false) ?>
    <div class="index-content">
        <div class="nav">
            <?php renderComponent("navigation",false, ['currentPage' => $page]) ?> 
        </div>
        <div class="main-page">
            <?php
            renderComponent($page, true, $pageData);
            ?>
        </div>
    </div>
    <?php if (isset($_SESSION['flash_success'])): ?>
        <script>
            alert('<?php echo addslashes($_SESSION['flash_success']); ?>');
        </script>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <script>
            alert('<?php echo addslashes($_SESSION['flash_error']); ?>');
        </script>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>
</body>
</html>
<script>
    const defaultPlaceholderImg = '../../assets/admin/images/post_img.png';
    let currentPostData = null;
    let newUploadedFiles = {
        main: null,
        sub_1: null,
        sub_2: null,
        sub_3: null
    };
    let currentActiveSlot = null;
    const apiConfigs = {
        'account': { 
            endpoint: 'accounts', 
            query: '?include=roles'
        },
        'post': { 
            endpoint: 'posts'
        },
        'comment': {
            endpoint: 'comments'
        },
        'permission':{
            endpoint: 'roles'
        },
        'price': {
            get endpoint() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTable = urlParams.get('table') || '1';
                return currentTable === '2' ? 'rechargeRules' : 'payRules';
            },
        query: ''
    }
    };
    function applyFilter(filterKey, filterValue) {
        const url = new URL(window.location.href);
        const paramName = `filter[${filterKey}]`;
        if (filterValue === 'all' || filterValue === '' || filterValue === null) {
            url.searchParams.delete(paramName);
        } else {
            url.searchParams.set(paramName, filterValue);
        }
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }
    document.addEventListener("DOMContentLoaded", function() {
        const scrollAction = sessionStorage.getItem('scrollAction');
    
        if (scrollAction === 'exact') {
            const savedPosition = sessionStorage.getItem('scrollPosition');
            if (savedPosition) {
                window.scrollTo({
                    top: parseInt(savedPosition), 
                    behavior: 'instant' 
                });
            }
        } else if (scrollAction === 'bottom') {
            window.scrollTo({ 
                top: document.body.scrollHeight, 
                behavior: 'instant' 
            });
        }
        sessionStorage.removeItem('scrollAction');
        sessionStorage.removeItem('scrollPosition');
        document.addEventListener('click', function(event) {
            const isDropdownLink = event.target.closest('.dropdown-menu a');
            const isPaginationLink = event.target.closest('.pagination-component .main-content a');

            if (isDropdownLink) {
                // Lệnh 1: Bấm Lọc -> Báo hệ thống giữ nguyên vị trí cũ
                sessionStorage.setItem('scrollAction', 'exact');
                sessionStorage.setItem('scrollPosition', Math.round(window.scrollY));
            } else if (isPaginationLink) {
                // Lệnh 2: Bấm Phân trang -> Báo hệ thống nhảy xuống cuối
                sessionStorage.setItem('scrollAction', 'bottom');
            }
        });
        
        // Vẽ biểu đồ
        renderAllCharts();
        renderMonthlyPostChart()
        renderRoomChart();
        renderWardChart();
        renderRevenueChart();

        // Nút bấm ở table
        const dropdownBtns = document.querySelectorAll('.dropdown-container .top-btn');
        dropdownBtns.forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.stopPropagation();
                const currentContainer = this.closest('.dropdown-container');
                document.querySelectorAll('.dropdown-container.active').forEach(container => {
                    if (container !== currentContainer) {
                        container.classList.remove('active');
                    }
                });
                currentContainer.classList.toggle('active');
            });
        });
        document.addEventListener('click', function(event) {
            if (event.target.closest('.dropdown-menu')) return;
            document.querySelectorAll('.dropdown-container.active').forEach(container => {
                container.classList.remove('active');
            });
        });

        //Dropdown ngày
        const startDateInput = document.getElementById('filter-start-date');
        const endDateInput = document.getElementById('filter-end-date');
        
        if(startDateInput){
            startDateInput.addEventListener('change', function() {
                const selectedStartDate = this.value; 
                endDateInput.min = selectedStartDate; 
            });
        }
        
        if(endDateInput){
            endDateInput.addEventListener('change', function() {
                const selectedEndDate = this.value;
                startDateInput.max = selectedEndDate;
            });
        }

        //Valid tai khoan
        const formSua = document.getElementById('form-modal-sua-tai-khoan');
        if (formSua) {
            formSua.addEventListener('submit', function(event) {
                const passwordInput = formSua.querySelector('input[name="password"]');
                const passwordConfirmInput = formSua.querySelector('input[name="password_confirmation"]');
                
                const password = passwordInput ? passwordInput.value : '';
                const passwordConfirm = passwordConfirmInput ? passwordConfirmInput.value : '';

                if (password.trim() !== '') {
                    
                    if (passwordConfirm.trim() === '') {
                        event.preventDefault();
                        alert('Vui lòng nhập lại mật khẩu xác nhận!');
                        if (passwordConfirmInput) passwordConfirmInput.focus();
                        return;
                    }
                    
                    if (password !== passwordConfirm) {
                        event.preventDefault();
                        alert('Mật khẩu xác nhận không khớp với mật khẩu mới!');
                        if (passwordConfirmInput) passwordConfirmInput.focus();
                        return;
                    }
                }
            });
        }

        //Tat chi tiet
        const modal = document.getElementById('post-detail-modal');
        if(modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closePostDetail();
                }
            });
        }

        //Chon File
        // 1. Lắng nghe sự kiện click vào các ô ảnh
        // 1. BẮT SỰ KIỆN CLICK CHO ẢNH BÀI ĐĂNG
        document.querySelectorAll('.image-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                const modal = document.getElementById('post-detail-modal');
                
                // BẢO VỆ: Nếu trang không có modal này, hoặc modal không ở chế độ edit -> Bỏ qua
                if (!modal || !modal.classList.contains('edit-mode')) {
                    return;
                }

                currentActiveSlot = this.getAttribute('data-slot');
                const hiddenInput = document.getElementById('hidden-file-input');
                if (hiddenInput) {
                    hiddenInput.click();
                }
            });
        });

        // 2. XỬ LÝ KHI CHỌN ẢNH BÀI ĐĂNG
        const hiddenFileInput = document.getElementById('hidden-file-input');

        if (hiddenFileInput) {
            hiddenFileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                // SỬA CHÍNH XÁC DÒNG NÀY: Bỏ dấu ! thừa trước chữ typeof
                if (!file || typeof currentActiveSlot === 'undefined' || !currentActiveSlot) return;

                // A. Đổi ảnh hiển thị trên giao diện (Preview)
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Tìm đúng thẻ img của ô đang active để thay đổi src
                    const imgElement = document.getElementById(`img-${currentActiveSlot}`);
                    if (imgElement) {
                        imgElement.src = event.target.result;
                    }
                }
                reader.readAsDataURL(file);

                // B. Lưu file thật vào Quyển sổ
                if (typeof newUploadedFiles !== 'undefined') {
                    newUploadedFiles[currentActiveSlot] = file;
                }

                // C. XÓA thẻ input hidden của ảnh cũ đi (nếu có)
                const currentSlotWrapper = document.querySelector(`.image-slot[data-slot="${currentActiveSlot}"]`);
                if (currentSlotWrapper) {
                    const oldHiddenInput = currentSlotWrapper.querySelector('input[type="hidden"]');
                    if (oldHiddenInput) {
                        oldHiddenInput.remove(); 
                    }
                }

                // Reset input file để có thể chọn lại file cùng tên
                this.value = '';
            });
        }

        //Loc theo ngay
        const btnFilterDate = document.querySelector('.btn-filter-date');
        if (btnFilterDate) {
            btnFilterDate.addEventListener('click', function() {
                const startDate = document.getElementById('filter-start-date').value;
                const endDate = document.getElementById('filter-end-date').value;

                const url = new URL(window.location.href);

                if (startDate && endDate) {
                    const dateRange = `${startDate},${endDate}`;
                    url.searchParams.set('filter[createdAt]', dateRange);
                } 
                else if (startDate) {
                    url.searchParams.set('filter[createdAt]', startDate);
                } 
                else if (endDate) {
                    url.searchParams.set('filter[createdAt]', endDate);
                } 
                else {
                    url.searchParams.delete('filter[createdAt]');
                }
                
                url.searchParams.delete('p');
                window.location.href = url.toString();
            });
        }

        //Xoa anh (preview)
        document.querySelectorAll('.btn-delete-img').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();

                // 2. Tìm cái ô chứa nút Xóa này đang mang tên gì (main, sub_1...)
                const slotWrapper = this.closest('.image-slot');
                const slotName = slotWrapper.getAttribute('data-slot');

                // 3. Trả hình ảnh hiển thị về mặc định
                const imgEl = slotWrapper.querySelector('img');
                if (imgEl) {
                    imgEl.src = defaultPlaceholderImg;
                }

                // 4. Xóa URL cũ trong thẻ input ẩn (Báo cho Laravel biết là ảnh này đã bay màu)
                const hiddenInput = slotWrapper.querySelector('input[type="hidden"]');
                if (hiddenInput) {
                    hiddenInput.value = ""; 
                }

                // 5. Xóa file mới trong "Quyển sổ" (Nếu user vừa tải ảnh mới lên rồi lại đổi ý muốn xóa)
                if (typeof newUploadedFiles !== 'undefined' && newUploadedFiles[slotName]) {
                    newUploadedFiles[slotName] = null;
                }
            });
        });
    });
    function removeNewImage(filename, buttonElement) {
        // 1. Lọc bỏ file đó khỏi mảng
        newUploadedFiles = newUploadedFiles.filter(file => file.name !== filename);
        // 2. Xóa cục HTML hiển thị ảnh
        buttonElement.closest('.image-wrapper').remove();
    }
    function openModal(idModal) {
        document.getElementById(idModal).style.display = 'flex';
    }
    function closeModal(idModal) {
        document.getElementById(idModal).style.display = 'none';
        const currentUrl = new URL(window.location.href);
        if (currentUrl.searchParams.has('action')) {
            currentUrl.searchParams.delete('action');
            currentUrl.searchParams.delete('id');
            window.history.replaceState({}, '', currentUrl.toString());
        }
    }
    function selectRow(trElement) {
        const radio = trElement.querySelector('input[type="radio"]');
        
        if (radio) {
            radio.checked = true;
        }
        const allRows = document.querySelectorAll('.table-component tbody tr');
        allRows.forEach(row => {
            row.classList.remove('row-active');
        });
        trElement.classList.add('row-active');
    }
    document.addEventListener('click', function(event) {
        const isClickInsideTable = event.target.closest('.table-component');
        const isClickOnActionButtons = event.target.closest('.btn_edit') || 
                                    event.target.closest('.btn_delete') ||
                                    event.target.closest('.btn_insert');

        if (!isClickInsideTable && !isClickOnActionButtons) {
            const allRows = document.querySelectorAll('.table-component tbody tr');
            allRows.forEach(row => {
                row.classList.remove('row-active');
            });
            const checkedRadio = document.querySelector('input[name="selectedRow"]:checked');
            if (checkedRadio) {
                checkedRadio.checked = false;
            }
        }
    });
    function handleEdit(targetModel1) {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            alert("Vui lòng chọn dòng dữ liệu để sửa!");
            return;
        }

        const id = selectedRadio.value;
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        const queryString = config.query ? config.query : ''; 
        const targetEndpoint = `${config.endpoint}/${id}${queryString}`;
        const proxyUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;
        fetch(proxyUrl, {
            method: 'GET',
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(result => {
            const data = result.data;
            const form = document.getElementById(targetModel1);
            
            const idInput = form.querySelector('input[name="id"]');
            if (idInput) idInput.value = data.id;
            const usernameInput = form.querySelector('input[name="username"]');
            if (usernameInput) usernameInput.value = data.username;
            const roleInput = form.querySelector('select[name="role"]');
            if (roleInput) roleInput.value = data.role;
            const statusSelect = form.querySelector('select[name="status"]');
            if (statusSelect) {
                if (data.deletedAt === null) {
                    statusSelect.value = 'active';
                } else {
                    statusSelect.value = 'inactive';
                }
            }
            const rolesSelect = form.querySelector('select[name="roles[]"]');
            if (rolesSelect) {
                Array.from(rolesSelect.options).forEach(option => {
                    option.selected = false;
                });

                if (data.roles && Array.isArray(data.roles)) {
                    Array.from(rolesSelect.options).forEach(option => {
                        if (data.roles.includes(option.value)) {
                            option.selected = true;
                        }
                    });
                }
            }
            openModal(targetModel1);
        })
        .catch(error => {
            alert("Có lỗi xảy ra khi lấy dữ liệu!");
            console.error(error);
        });
    }
    function handleDelete() {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            alert("Vui lòng chọn dòng dữ liệu để xóa!"); 
            return;
        }

        const id = selectedRadio.value;
        if (!confirm("Bạn có chắc chắn muốn xóa dữ liệu này không? Hành động này không thể hoàn tác!")) {
            return;
        }

        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        let targetEndpoint = `${config.endpoint}/${id}`;
        const proxyUrl = `../admin/core/api_proxy.php?target_endpoint=${targetEndpoint}`;
        fetch(proxyUrl, {
            method: 'DELETE', 
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(result => {
            let msg = result.message || 
              (result.data && result.data.message) || 
              (result.original && result.original.message);
            if (msg) {
                alert("Xóa thành công");
                window.location.reload();
            } else {
                throw new Error(result.error || "Không tìm thấy thông báo thành công từ server.");
            }
        })
        .catch(error => {
            console.error("Lỗi xóa:", error);
            alert(error.message || "Có lỗi xảy ra! Không thể xóa dữ liệu này.");
        });
    }
    function handleSave(event, formElement) {
        event.preventDefault();
        let formData = new FormData(formElement);

        const slotOrders = { 'main': 1, 'sub_1': 2, 'sub_2': 3, 'sub_3': 4 };
        const slotIndex = { 'main': 0, 'sub_1': 1, 'sub_2': 2, 'sub_3': 3 };

        // BÍ QUYẾT 1: KHOANH VÙNG TÌM KIẾM
        const parentContainer = formElement.closest('.modal-content') || document;

        // Lặp qua danh sách 4 ô ảnh
        ['main', 'sub_1', 'sub_2', 'sub_3'].forEach(slotName => {
            
            // 1. TÌM DỮ LIỆU ẢNH CŨ
            const hiddenInput = parentContainer.querySelector(`.image-slot[data-slot="${slotName}"] input[type="hidden"]`);
            
            if (hiddenInput) {
                // NẾU GIÁ TRỊ RỖNG -> USER ĐÃ BẤM NÚT XÓA ẢNH NÀY
                if (hiddenInput.value === "") {
                    // Đẩy vào mảng deleted_orders theo đúng yêu cầu của Backend
                    // Ví dụ: deleted_orders[0] = 1 (Xóa ảnh main)
                    formData.append(`deleted_orders[${slotIndex[slotName]}]`, slotOrders[slotName]);
                } else {
                    // Nếu không xóa, ném trả lại ảnh cũ (để Backend biết đường mà giữ nguyên)
                    formData.set(`existing_images[${slotName}]`, hiddenInput.value);
                }
            }

            // 2. TÌM VÀ GOM DỮ LIỆU ẢNH MỚI (Nếu có tải lên file mới)
            if (typeof newUploadedFiles !== 'undefined' && newUploadedFiles[slotName]) {
                const file = newUploadedFiles[slotName];
                formData.append(`images[${slotIndex[slotName]}]`, file);
                formData.append(`orders[${slotIndex[slotName]}]`, slotOrders[slotName]);
            }
        });

        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        let recordId = formData.get('id');
        let isEdit = (recordId !== null && recordId !== "");
        let targetEndpoint = config.endpoint;
        if (isEdit) {
            targetEndpoint = `${targetEndpoint}/${recordId}`;
            formData.append('_method', 'PUT');
        }
        formData.append('target_endpoint', targetEndpoint);

        if(currentPage === 'permission'){
            formData.append('guard_name', 'api');
        }

        fetch('../admin/core/api_proxy.php', {
            method: 'POST',
            headers: {
                "Accept": "application/json"
            },
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
            alert(isEdit ? "Cập nhật thành công!" : "Thêm mới thành công!");
            if (typeof newUploadedFiles !== 'undefined') {
                newUploadedFiles = { main: null, sub_1: null, sub_2: null, sub_3: null };
            }
            let parentModal = formElement.closest('.post-detail-component-overlay');

            if (parentModal) {
                closeModal(parentModal.id);
                if (parentModal.classList.contains('post-detail-component-overlay')) {
                    parentModal.classList.remove('edit-mode');
                    parentModal.classList.add('view-mode');
                }
            } else {
                let formId = formElement.getAttribute('id');
                if (formId) {
                    let fallbackModalId = formId.replace('form-', '');
                    if (typeof closeModal === 'function') {
                        closeModal(fallbackModalId);
                    }
                }
            }   
            // window.location.reload();
        })
        .catch(error => {
            console.error("Lỗi lưu dữ liệu:", error);
            alert(error.message);
        });
    }
    function handleUpdateStatus(event, id, newStatus) {
        event.stopPropagation(); // Ngăn sự kiện click lan ra hàng (tránh mở nhầm Modal Chi tiết)

        // Xác nhận trước khi làm
        let actionName = newStatus === 'completed' ? 'Duyệt bài' : 
                        newStatus === 'rejected' ? 'Từ chối bài' : 'Gỡ bài';
                        
        if (!confirm(`Bạn có chắc chắn muốn ${actionName} này không?`)) return;

        // Tạo FormData ảo (không cần thẻ <form> thật)
        let formData = new FormData();
        formData.append('status', newStatus); // Gửi trạng thái mới lên Backend
        formData.append('_method', 'PUT');    // Lệnh UPDATE thì thường dùng PUT

        // Xử lý Endpoint
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        
        // Tạo Endpoint ví dụ: posts/123
        let targetEndpoint = `${config.endpoint}/${id}`;
        formData.append('target_endpoint', targetEndpoint);

        // Gửi API qua Proxy
        fetch('../admin/core/api_proxy.php', {
            method: 'POST', // Chỗ này luôn là POST do gửi qua file PHP trung gian
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
        .then(async response => {
            const result = await response.json();
            if (!response.ok || result.status === 'error') {
                throw new Error(result.message || "Có lỗi xảy ra khi cập nhật!");
            }
            return result;
        })
        .then(result => {
            alert("Cập nhật trạng thái thành công!");
            window.location.reload();
        })
        .catch(error => {
            console.error("Lỗi cập nhật trạng thái:", error);
            alert(error.message);
        });
    }
    function handleRestore() {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            alert("Vui lòng chọn dòng dữ liệu để khôi phục!");
            return;
        }

        const id = selectedRadio.value;
        if (!confirm("Bạn có chắc chắn muốn khôi phục dữ liệu này không?")) {
            return;
        }

        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        let targetEndpoint = `${config.endpoint}/${id}/restore`;
        let formData = new FormData();
        formData.append('target_endpoint', targetEndpoint);
        fetch('../admin/core/api_proxy.php', {
            method: 'POST', 
            headers: {
                "Accept": "application/json"
            },
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            let successMessage = (result.original && result.original.message) 
                                 ? result.original.message 
                                 : result.message;
            if (successMessage) {
                alert("Khôi phục thành công!");
                window.location.reload();
            } else {
                throw new Error("Không nhận được phản hồi hợp lệ từ server.");
            }
        })
        .catch(error => {
            console.error("Lỗi khôi phục:", error);
            alert(error.message || "Có lỗi xảy ra! Không thể khôi phục dữ liệu này.");
        });
    }
    function handleView(targetModel) {
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        
        // 1. CHỈ GỌI VÀO PROXY. Truyền đích đến vào biến target_endpoint
        // Nhớ sửa lại đường dẫn tới file api_proxy.php cho đúng với thư mục dự án của bạn
        const targetEndpoint = `${config.endpoint}/7${config.query}`;
        const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;

        // 2. Fetch bây giờ cực kỳ gọn nhẹ, KHÔNG CẦN TRUYỀN TOKEN NỮA
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(result => {
            // Kiểm tra xem Proxy/Laravel có trả về lỗi không
            if (result.status === 'error' || !result.data) {
                alert("Lỗi: " + (result.message || "Không thể lấy dữ liệu"));
                return;
            }

            const data = result.data;
            
            // --- CÁC ĐOẠN CODE ĐỔ DỮ LIỆU CỦA BẠN GIỮ NGUYÊN BÊN DƯỚI ---
            document.getElementById('view-username').textContent = data.username || 'Không xác định';
            document.getElementById('view-avatar-text').textContent = (data.username || 'A').charAt(0);
            document.getElementById('view-role').textContent = data.role === 'employee' ? 'Nhân viên' : 'Khách hàng';
            
            document.getElementById('view-id').textContent = data.id;
            
            const statusEl = document.getElementById('view-status');
            if (data.deletedAt === null) {
                statusEl.innerHTML = '<span class="badge-detail badge-active">Đang hoạt động</span>';
            } else {
                statusEl.innerHTML = '<span class="badge-detail badge-inactive">Đã khóa / Xóa</span>';
            }

            const profileInfo = data.employee || data.user;
            document.getElementById('view-phone').textContent = profileInfo?.personalInfo?.phoneNumber || 'Chưa cập nhật';
            document.getElementById('view-email').textContent = profileInfo?.personalInfo?.email || 'Chưa cập nhật';

            const rolesContainer = document.getElementById('view-roles-container');
            rolesContainer.innerHTML = ''; 
            
            if (data.roles && data.roles.length > 0) {
                data.roles.forEach(role => {
                    const badge = document.createElement('span');
                    badge.className = 'badge-detail badge-permission';
                    badge.textContent = role.name || role; // Đảm bảo lấy đúng name nếu role là object
                    rolesContainer.appendChild(badge);
                });
            } else {
                rolesContainer.innerHTML = '<span class="info-value" style="font-style: italic; color: #999;">Không có quyền đặc biệt</span>';
            }

            openModal(targetModel);
        })
        .catch(error => {
            alert("Lỗi tải chi tiết!");
            console.error("Fetch error:", error);
        });
    }
    function handleSearch() {
        const keyword = document.getElementById('searchInput').value.trim();
        const url = new URL(window.location.href);
        if (keyword) {
            url.searchParams.set('filter[search]', keyword); 
        } else {
            url.searchParams.delete('filter[search]');
        }
        url.searchParams.delete('p');
        window.location.href = url.toString();
    }
    function showDetail(postId) {
        const modal = document.getElementById('post-detail-modal');
        if (modal) {
            document.body.style.cursor = 'wait';
            const targetEndpoint = `posts/${postId}?include=postImages,user,employee`;
            const proxyUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;
            fetch(proxyUrl, {
                method: 'GET',
                headers: {
                    "Accept": "application/json"
                }
            })
            .then(response => response.json())
            .then(result => {
                const data = result.data;
                currentPostData = data;
                document.getElementById('detail-id').textContent = "ID bài đăng: " + data.id;
                document.getElementById('detail-title').textContent = data.title;
                const locationParts = [data.ward, data.province];
                const locationString = locationParts.filter(Boolean).join(", ");
                document.getElementById('detail-location').textContent = locationString;
                document.getElementById('detail-price').textContent = data.price + " VNĐ/ tháng";
                document.getElementById('detail-area').textContent = data.area + " m²";
                document.getElementById('detail-deposit').textContent = "Số tiền cọc: " + data.deposit;
                document.getElementById('room-type').textContent = "Kiểu phòng trọ: " + data.roomType;
                document.getElementById('occupants-data').textContent = "Số lượng người tối đa: " + data.maxOccupants;
                document.getElementById('detail-description').textContent = data.description;
                
                // Cấu hình đường dẫn mặc định
                const baseUrl = "http://backend.test";
                const defaultImg = "../../assets/admin/images/post_img.png";

                // ==========================================
                // BƯỚC 1: RESET LẠI TOÀN BỘ 4 Ô ẢNH VỀ MẶC ĐỊNH
                // (Phòng trường hợp bạn vừa xem 1 bài có ảnh, rồi lại mở 1 bài không có ảnh)
                // ==========================================
                const slots = ['main', 'sub_1', 'sub_2', 'sub_3'];
                slots.forEach(slot => {
                    // 1. Reset ảnh hiển thị
                    const imgEl = document.getElementById(`img-${slot}`);
                    if (imgEl) imgEl.src = defaultImg;
                    
                    // 2. Reset input ẩn (Xóa value cũ đi)
                    const wrapper = document.querySelector(`.image-slot[data-slot="${slot}"]`);
                    if (wrapper) {
                        let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                        if (hiddenInput) {
                            hiddenInput.value = ""; 
                        } else {
                            // Nếu input lỡ bị xóa mất (do user click thay ảnh trước đó), tạo lại nó
                            wrapper.insertAdjacentHTML('beforeend', `<input type="hidden" name="existing_images[${slot}]" value="">`);
                        }
                    }
                });

                // ==========================================
                // BƯỚC 2: ĐỔ DỮ LIỆU TỪ API VÀO 4 Ô TƯƠNG ỨNG
                // ==========================================
                if (data.postImages && data.postImages.length > 0) {
                    data.postImages.forEach((imgObj, index) => {
                        // Xác định vị trí ô dựa vào index của mảng (0 là main, 1,2,3 là sub)
                        let slotName = '';
                        if (index === 0) slotName = 'main';
                        else if (index === 1) slotName = 'sub_1';
                        else if (index === 2) slotName = 'sub_2';
                        else if (index === 3) slotName = 'sub_3';

                        if (slotName) {
                            const imgEl = document.getElementById(`img-${slotName}`);
                            const wrapper = document.querySelector(`.image-slot[data-slot="${slotName}"]`);
                            
                            // Nối chuỗi tạo link ảnh đầy đủ
                            const fullUrl = baseUrl + imgObj.imagePostUrl;

                            // 1. Gán ảnh lên giao diện cho user xem
                            if (imgEl) imgEl.src = fullUrl;

                            // 2. Gán URL vào thẻ input ẩn để submit lên Backend
                            if (wrapper) {
                                let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                                if (hiddenInput) {
                                    // Bạn có thể lưu url (imgObj.imagePostUrl) hoặc ID của ảnh tùy logic Laravel
                                    hiddenInput.value = imgObj.imagePostUrl; 
                                }
                            }
                        }
                    });
                }

                document.getElementById('detail-user-id').textContent = "ID người đăng bài: " + (data.user.id || 'Trống');
                document.getElementById('detail-employee-id').textContent = "ID nhân viên duyệt: " + (data.employee?.id || 'Chưa có');
                modal.style.display = 'flex';
            })
            .catch(error => {
                console.error("Lỗi lấy chi tiết bài viết:", error);
                alert("Không thể tải chi tiết bài viết lúc này!");
            })
            .finally(() => {
                document.body.style.cursor = 'default';
            });
        }
    }
    function switchToEdit() {
        const modal = document.getElementById('post-detail-modal');
        modal.classList.remove('view-mode');
        modal.classList.add('edit-mode');

        if (currentPostData) {
            fillFormEditData(currentPostData);
        } else {
            alert("Không tìm thấy dữ liệu bài viết để chỉnh sửa!");
        }
    }
    function closePostDetail() {
        const modal = document.getElementById('post-detail-modal');
        if (modal) {
            modal.style.display = 'none';
            switchToView();
        }
    }
    function fillFormEditData(data) {
        const form = document.getElementById('form-edit-post');
        if (!form) return;

        const textFields = ['id', 'title', 'price', 'deposit', 'area', 'max_occupants', 'description'];
        textFields.forEach(field => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.value = data[field] !== null && data[field] !== undefined ? data[field] : ''; 
            }
        });
        const roomTypeSelect = form.querySelector('select[name="room_type"]');
        if (roomTypeSelect && data.room_type) {
            roomTypeSelect.value = data.room_type;
        }
        const citySelect = document.getElementById('city-select');
        const wardSelect = document.getElementById('ward-select');
        if (citySelect && data.city_id) {
            if (!citySelect.querySelector(`option[value="${data.city_id}"]`)) {
                citySelect.innerHTML += `<option value="${data.city_id}" selected>${data.city_name || 'Tỉnh ID ' + data.city_id}</option>`;
            }
            citySelect.value = data.city_id;
        }

        if (wardSelect && data.ward_id) {
            if (!wardSelect.querySelector(`option[value="${data.ward_id}"]`)) {
                wardSelect.innerHTML += `<option value="${data.ward_id}" selected>${data.ward_name || 'Phường ID ' + data.ward_id}</option>`;
            }
            wardSelect.value = data.ward_id;
        }
    }
    function switchToView() {
        const modal = document.getElementById('post-detail-modal');
        modal.classList.remove('edit-mode');
        modal.classList.add('view-mode');
        fillFormEditData(currentPostData);
        restoreImages(currentPostData.postImages);
        if (typeof newUploadedFiles !== 'undefined') {
            newUploadedFiles = {
                main: null,
                sub_1: null,
                sub_2: null,
                sub_3: null
            };
        }
    }
    function restoreImages(postImages) {
        const baseUrl = "http://backend.test";
        const defaultImg = "../../assets/admin/images/post_img.png";
        const slots = ['main', 'sub_1', 'sub_2', 'sub_3'];

        // Bước A: Reset toàn bộ về ảnh mặc định trước
        slots.forEach(slot => {
            const imgEl = document.getElementById(`img-${slot}`);
            if (imgEl) imgEl.src = defaultImg;
            
            const wrapper = document.querySelector(`.image-slot[data-slot="${slot}"]`);
            if (wrapper) {
                let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                if (hiddenInput) hiddenInput.value = ""; 
            }
        });

        // Bước B: Rải lại ảnh từ data gốc vào
        if (postImages && postImages.length > 0) {
            postImages.forEach((imgObj, index) => {
                let slotName = ['main', 'sub_1', 'sub_2', 'sub_3'][index];
                if (slotName) {
                    const imgEl = document.getElementById(`img-${slotName}`);
                    const wrapper = document.querySelector(`.image-slot[data-slot="${slotName}"]`);
                    
                    if (imgEl) imgEl.src = baseUrl + imgObj.imagePostUrl;
                    if (wrapper) {
                        let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                        if (hiddenInput) hiddenInput.value = imgObj.imagePostUrl; 
                    }
                }
            });
        }
    }
    function toggleAccordion(element) {
        // Tìm thẻ bọc ngoài cùng (.accordion-item) của cái header vừa bấm
        const item = element.closest('.accordion-item');
        
        // Đảo ngược class 'active' (nếu có thì xóa, chưa có thì thêm)
        item.classList.toggle('active');
    }
    function openAccountListModal(event, targetModel, roleName, roleId) {
        if (event) {
            event.stopPropagation();
        }

        const tbody = document.getElementById('role-account-list-body');
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" style="text-align:center; padding: 20px; color: #64748b; font-style: italic;">
                        Đang tải danh sách tài khoản...
                    </td>
                </tr>
            `;
        }

        if (typeof openModal === 'function') {
            openModal(targetModel);
        }

        const targetEndpoint = `accounts?filter[roles.name]=${encodeURIComponent(roleName)}`;
        const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;

        fetch(apiUrl, {
            method: 'GET',
            headers: { "Accept": "application/json" }
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'error') {
                const errorMsg = result.message || "Không thể lấy dữ liệu";
                tbody.innerHTML = `<tr><td colspan="4" style="text-align:center; color:red; padding: 20px;">Lỗi: ${errorMsg}</td></tr>`;
                return;
            }

            let accounts = [];
            if (result.data && Array.isArray(result.data)) {
                accounts = result.data;
            }

            if (accounts.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" style="text-align:center; padding: 20px; color: #64748B;">
                            Chưa có tài khoản nào được gán quyền <strong>${roleName}</strong>!
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = accounts.map(account => {
                // Lấy trực tiếp mảng roles (nếu API không trả về thì gán mảng rỗng)
                let currentRoles = account.roles || [];

                // Mã hóa mảng để truyền an toàn qua tham số onclick
                let encodedRoles = encodeURIComponent(JSON.stringify(currentRoles));

                return `
                    <tr>
                        <td>${account.id}</td>
                        <td style="font-weight: 500;">${account.username || account.name || 'N/A'}</td>
                        
                        <td>${currentRoles.length > 0 ? currentRoles.join(', ') : 'N/A'}</td>
                        
                        <td class="text-center">
                            <button class="table-btn red" type="button" 
                                onclick="revokeRoleFromAccount(event, ${account.id}, '${roleName}', '${encodedRoles}', '${targetModel}', ${roleId})">
                                Tước quyền
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        })
        .catch(error => {
            console.error("Fetch error:", error);
            if (tbody) {
                tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; color:red; padding: 20px;">Lỗi kết nối máy chủ</td></tr>';
            }
        });
    }
    function revokeRoleFromAccount(event, accountId, roleNameToRemove, encodedRoles, targetModel, roleId) {
        event.stopPropagation();
        
        let currentRoles = [];
        try {
            currentRoles = JSON.parse(decodeURIComponent(encodedRoles));
        } catch (e) {
            currentRoles = [];
        }

        if (!confirm(`Xác nhận tước quyền [${roleNameToRemove}]?`)) return;

        // 1. Lọc mảng (Nếu tước hết, remainingRoles sẽ là [])
        let remainingRoles = currentRoles.filter(role => role !== roleNameToRemove);

        // 2. Tạo Object thuần túy (KHÔNG dùng new FormData)
        const payload = {
            _method: 'PUT',
            roles: remainingRoles, // Gửi nguyên mảng JS []
            target_endpoint: `accounts/${accountId}`
        };

        const apiUrl = `../admin/core/api_proxy.php`;

        // 3. Gửi Fetch với Content-Type: application/json
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json", // QUAN TRỌNG: Để Proxy và Laravel nhận diện JSON
                "Accept": "application/json"
            },
            body: JSON.stringify(payload) // Chuyển Object thành chuỗi JSON
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'error' || result.errors) {
                alert("Lỗi: " + (result.message || "Không thể thu hồi"));
                return;
            }
            alert("Thu hồi quyền thành công!");
            openAccountListModal(null, targetModel, roleNameToRemove, roleId);
        })
        .catch(error => {
            console.error("Fetch error:", error);
            alert("Lỗi kết nối hệ thống!");
        });
    }
    // Hàm vẽ toàn bộ biểu đồ
    function renderAllCharts() {
        // Cài đặt chung cho mọi biểu đồ để font chữ đẹp hơn
        Chart.defaults.font.family = "'Roboto', sans-serif";
        Chart.defaults.color = '#64748B'; // Màu chữ xám nhạt hiện đại

        // ==========================================
        // 1. BIỂU ĐỒ BÀI ĐĂNG THEO THÁNG (LINE CHART)
        // ==========================================
        // const ctx1 = document.getElementById('chart1');
        // if (ctx1) {
        //     new Chart(ctx1, {
        //         type: 'line',
        //         data: {
        //             labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        //             datasets: [{
        //                 label: 'Số lượng bài đăng mới',
        //                 data: [120, 190, 150, 220, 300, 250, 400, 350, 450, 410, 500, 580],
        //                 borderColor: '#3B82F6', // Xanh dương
        //                 backgroundColor: '#3B82F6',
        //                 tension: 0.4, // Đường cong mềm mại
        //                 borderWidth: 3,
        //                 pointRadius: 0, // Ẩn các chấm tròn cho mượt
        //                 pointHoverRadius: 6
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             plugins: { legend: { display: false } }, // Ẩn ghi chú vì chỉ có 1 đường
        //             scales: {
        //                 y: { beginAtZero: true, grid: { borderDash: [5, 5] } }, // Lưới kẻ đứt nét
        //                 x: { grid: { display: false } }
        //             }
        //         }
        //     });
        // }

        // ==========================================
        // 2. BIỂU ĐỒ TỶ LỆ KIỂU PHÒNG (DOUGHNUT CHART)
        // ==========================================
        // const ctx2 = document.getElementById('chart2');
        // if (ctx2) {
        //     new Chart(ctx2, {
        //         type: 'doughnut',
        //         data: {
        //             labels: ['Trọ khép kín', 'Chung cư mini', 'Nhà nguyên căn', 'Ở ghép'],
        //             datasets: [{
        //                 data: [45, 25, 20, 10], // Tỷ lệ %
        //                 backgroundColor: [
        //                     '#3B82F6', // Xanh dương
        //                     '#10B981', // Xanh lá
        //                     '#F59E0B', // Vàng cam
        //                     '#8B5CF6'  // Tím
        //                 ],
        //                 borderWidth: 0, // Bỏ viền trắng chia cắt
        //                 hoverOffset: 4
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             cutout: '70%', // Làm cho vành khuyên mỏng lại cho tinh tế
        //             plugins: {
        //                 legend: {
        //                     position: 'right', // Đẩy chú thích sang phải
        //                     labels: { boxWidth: 12, usePointStyle: true } // Chú thích hình tròn
        //                 }
        //             }
        //         }
        //     });
        // }

        // ==========================================
        // 3. TOP 10 KHU VỰC NHIỀU BÀI ĐĂNG (HORIZONTAL BAR)
        // ==========================================
        // const ctx3 = document.getElementById('chart3');
        // if (ctx3) {
        //     new Chart(ctx3, {
        //         type: 'bar',
        //         data: {
        //             labels: ['Cầu Giấy', 'Đống Đa', 'Thanh Xuân', 'Nam Từ Liêm', 'Hai Bà Trưng', 'Hà Đông', 'Hoàng Mai', 'Bắc Từ Liêm', 'Ba Đình', 'Tây Hồ'],
        //             datasets: [{
        //                 label: 'Số bài đăng',
        //                 data: [1250, 980, 850, 720, 650, 540, 480, 420, 350, 210],
        //                 backgroundColor: '#8B5CF6', // Màu tím cho bảng xếp hạng
        //                 borderRadius: 4 // Bo góc cột biểu đồ
        //             }]
        //         },
        //         options: {
        //             indexAxis: 'y', // QUAN TRỌNG: Lật ngang biểu đồ
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             plugins: { legend: { display: false } },
        //             scales: {
        //                 x: { beginAtZero: true, grid: { borderDash: [5, 5] } },
        //                 y: { grid: { display: false } }
        //             }
        //         }
        //     });
        // }

        // ==========================================
        // 4. THỐNG KÊ DOANH THU (AREA CHART)
        // ==========================================
        // const ctx4 = document.getElementById('chart4');
        // if (ctx4) {
        //     new Chart(ctx4, {
        //         type: 'line',
        //         data: {
        //             labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        //             datasets: [{
        //                 label: 'Doanh thu (VNĐ)',
        //                 data: [15, 18, 12, 20, 25, 30, 28, 35, 40, 38, 45, 50], // Đơn vị: Triệu VNĐ
        //                 borderColor: '#10B981', // Màu xanh lá tượng trưng cho tiền bạc
        //                 backgroundColor: 'rgba(16, 185, 129, 0.15)', // Màu xanh lá nhạt tô nền
        //                 borderWidth: 3,
        //                 fill: true, // QUAN TRỌNG: Bật đổ màu nền dưới biểu đồ
        //                 tension: 0.4,
        //                 pointRadius: 3,
        //                 pointBackgroundColor: '#FFFFFF',
        //                 pointBorderColor: '#10B981',
        //                 pointBorderWidth: 2
        //             }]
        //         },
        //         options: {
        //             responsive: true,
        //             maintainAspectRatio: false,
        //             plugins: {
        //                 legend: { display: false },
        //                 tooltip: {
        //                     callbacks: {
        //                         // Định dạng thêm chữ "Triệu VNĐ" vào tooltip khi hover chuột
        //                         label: function(context) {
        //                             return context.parsed.y + ' Triệu VNĐ';
        //                         }
        //                     }
        //                 }
        //             },
        //             scales: {
        //                 y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
        //                 x: { grid: { display: false } }
        //             }
        //         }
        //     });
        // }
    }

    async function renderMonthlyPostChart() {
        try {
            // 1. GỌI API LẤY DỮ LIỆU BÀI ĐĂNG THEO THÁNG
            const response = await fetch('../admin/core/api_proxy.php?target_endpoint=statistic/posts/month_data&year=2025', {
                method: 'GET',
                headers: {
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            // 2. Khởi tạo mảng 12 tháng mặc định = 0
            const postsByMonth = new Array(12).fill(0);

            // 3. Trích xuất dữ liệu từ JSON trả về
            if (result && result.monthlyDetails) {
                result.monthlyDetails.forEach(item => {
                    const monthIndex = item.month - 1; // Tháng 1 => index 0
                    postsByMonth[monthIndex] = item.total;
                });
            }

            // 4. Vẽ biểu đồ với dữ liệu động
            const ctx1 = document.getElementById('chart1');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [{
                            label: 'Số lượng bài đăng mới',
                            data: postsByMonth,
                            borderColor: '#3B82F6',
                            backgroundColor: '#3B82F6',
                            tension: 0.4,
                            borderWidth: 3,
                            pointRadius: 0,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ` ${context.parsed.y} bài đăng`;
                                    },
                                    // Hiển thị thêm tổng năm ở footer tooltip
                                    footer: function() {
                                        return `Tổng năm ${result.year}: ${result.yearlyTotal} bài`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { borderDash: [5, 5] },
                                ticks: { stepSize: 1 } // Trục Y hiển thị số nguyên
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

        } catch (error) {
            console.error("Lỗi khi tải dữ liệu biểu đồ bài đăng theo tháng:", error);
        }
    }

    async function renderRoomChart() {
        try {
            // 1. GỌI QUA PROXY ĐỂ TỰ ĐỘNG GẮN TOKEN
            const response = await fetch('../admin/core/api_proxy.php?target_endpoint=statistic/posts/room_data', {
                method: 'GET',
                headers: {
                    "Accept": "application/json"
                }
            });
            
            const result = await response.json();

            // 2. Từ điển dịch tên loại phòng từ Backend sang Frontend
            const roomTypeMap = {
                'room': 'Trọ khép kín',
                'apartment': 'Chung cư mini',
                'house': 'Nhà nguyên căn',
                'dorm': 'Ở ghép'
            };

            let chartLabels = [];
            let chartData = [];

            // 3. Trích xuất dữ liệu từ JSON trả về
            if (result && result.roomTypeDetails) {
                result.roomTypeDetails.forEach(item => {
                    const translatedName = roomTypeMap[item.roomType] || item.roomType; 
                    chartLabels.push(translatedName);
                    chartData.push(item.total);
                });
            }

            // 4. Vẽ biểu đồ với dữ liệu động
            const ctx2 = document.getElementById('chart2');
            if (ctx2) {
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabels, // Gắn mảng nhãn động vào đây
                        datasets: [{
                            data: chartData, // Gắn mảng số liệu động vào đây
                            backgroundColor: [
                                '#3B82F6', // Xanh dương
                                '#10B981', // Xanh lá
                                '#F59E0B', // Vàng cam
                                '#8B5CF6', // Tím
                                '#EF4444'  // Đỏ (Dự phòng)
                            ],
                            borderWidth: 0, 
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%', 
                        plugins: {
                            legend: {
                                position: 'right', 
                                labels: { 
                                    boxWidth: 12, 
                                    usePointStyle: true 
                                } 
                            },
                            // Bổ sung thêm tooltip hiển thị số lượng khi rê chuột
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ` ${context.label}: ${context.raw} phòng`;
                                    }
                                }
                            }
                        }
                    }
                });
            }
        } catch (error) {
            console.error("Lỗi khi tải dữ liệu biểu đồ phòng:", error);
        }

        
    }
    
    async function renderWardChart() {
        try {
            // 1. Gọi API lấy dữ liệu phường/xã
            const response = await fetch('../admin/core/api_proxy.php?target_endpoint=statistic/posts/ward_data&province=38', {
                method: 'GET',
                headers: {
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            let chartLabels = [];
            let chartData = [];

            // 2. Trích xuất dữ liệu từ JSON trả về, lọc bỏ các phường có total = 0
            if (result && result.wardDetails) {
                result.wardDetails
                    .filter(item => item.total > 0) // Chỉ hiển thị phường có bài đăng
                    .sort((a, b) => b.total - a.total) // Sắp xếp giảm dần
                    .forEach(item => {
                        chartLabels.push(item.ward);
                        chartData.push(item.total);
                    });
            }

            // 3. Vẽ biểu đồ bar ngang với dữ liệu động
            const ctx3 = document.getElementById('chart3');
            if (ctx3) {
                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Số bài đăng',
                            data: chartData,
                            backgroundColor: '#8B5CF6',
                            borderRadius: 4
                        }]
                    },
                    options: {
                        indexAxis: 'y', // Lật ngang biểu đồ
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ` ${context.label}: ${context.raw} bài đăng`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: { precision: 0 }, // Chỉ hiển thị số nguyên
                                grid: { borderDash: [5, 5] }
                            },
                            y: { grid: { display: false } }
                        }
                    }
                });
            }
        } catch (error) {
            console.error("Lỗi khi tải dữ liệu biểu đồ phường:", error);
        }
    }

    async function renderRevenueChart() {
        try {
            // 1. GỌI API LẤY DỮ LIỆU DOANH THU
            const response = await fetch('../admin/core/api_proxy.php?target_endpoint=statistic/revenue&year=2025&with_taxes=true&compare_year=2024', {
                method: 'GET',
                headers: {
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            // 2. Khởi tạo mảng 12 tháng mặc định = 0
            const revenueByMonth = new Array(12).fill(0);
            const compareRevenueByMonth = new Array(12).fill(0);

            // 3. Trích xuất dữ liệu năm hiện tại
            if (result && result.monthlyRevenueDetails) {
                result.monthlyRevenueDetails.forEach(item => {
                    const monthIndex = item.month - 1; // Tháng 1 => index 0
                    revenueByMonth[monthIndex] = Math.round(Number(item.totalRevenue) / 1000000 * 100) / 100; // Quy đổi sang Triệu VNĐ, làm tròn 2 chữ số
                });
            }

            // 4. Trích xuất dữ liệu năm so sánh (nếu có)
            if (result && result.compareMonthlyRevenueDetails) {
                result.compareMonthlyRevenueDetails.forEach(item => {
                    const monthIndex = item.month - 1;
                    compareRevenueByMonth[monthIndex] = Math.round(Number(item.totalRevenue) / 1000000 * 100) / 100;
                });
            }

            const currentYear = result.year || '2025';
            const compareYear = result.compareYear || '2024';

            // 5. Vẽ biểu đồ với dữ liệu động
            const ctx4 = document.getElementById('chart4');
            if (ctx4) {
                new Chart(ctx4, {
                    type: 'line',
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [
                            {
                                label: `Doanh thu ${currentYear}`,
                                data: revenueByMonth,
                                borderColor: '#10B981',
                                backgroundColor: 'rgba(16, 185, 129, 0.15)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 3,
                                pointBackgroundColor: '#FFFFFF',
                                pointBorderColor: '#10B981',
                                pointBorderWidth: 2
                            },
                            // Dataset năm so sánh — chỉ hiển thị nếu API trả về dữ liệu
                            ...(result.compareMonthlyRevenueDetails ? [{
                                label: `Doanh thu ${compareYear}`,
                                data: compareRevenueByMonth,
                                borderColor: '#F59E0B',
                                backgroundColor: 'rgba(245, 158, 11, 0.10)',
                                borderWidth: 2,
                                fill: false,
                                tension: 0.4,
                                pointRadius: 3,
                                pointBackgroundColor: '#FFFFFF',
                                pointBorderColor: '#F59E0B',
                                pointBorderWidth: 2,
                                borderDash: [5, 5] // Đường nét đứt để phân biệt năm cũ
                            }] : [])
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: { boxWidth: 12, usePointStyle: true }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.parsed.y;
                                        if (value >= 1) {
                                            return ` ${context.dataset.label}: ${value.toLocaleString('vi-VN')} Triệu VNĐ`;
                                        }
                                        // Hiển thị dạng nghìn VNĐ nếu giá trị nhỏ hơn 1 triệu
                                        return ` ${context.dataset.label}: ${(value * 1000).toLocaleString('vi-VN')} Nghìn VNĐ`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { borderDash: [5, 5] },
                                ticks: {
                                    callback: function(value) {
                                        return value + ' Tr';  // Rút gọn trục Y
                                    }
                                }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

        } catch (error) {
            console.error("Lỗi khi tải dữ liệu biểu đồ doanh thu:", error);
        }
    }
</script>
</html>