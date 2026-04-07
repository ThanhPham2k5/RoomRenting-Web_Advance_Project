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
$accountData = call_api("http://backend.test/api/accounts/$adminId?include=roles.permissions,employee.personalInfo");
$userPermissions = [];
if (isset($accountData['data']['roles'][0]['permissions'])) {
    $userPermissions = $accountData['data']['roles'][0]['permissions'];
}
$_SESSION['user_permissions'] = $userPermissions;
$_SESSION['user_avatar'] = $accountData['data']['employee']['personalInfo']['profileUrl'];
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
            'base_url'     => "index.php?page=account&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
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
</body>
<div id="toast-container"></div>
</html>
<script src="./core/main.js"></script>
<script>
    const formatVND = (amount) => {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
    };
    let regionChartInstance = null;
    let monthlyChartInstance = null;
    let revenueChartInstance = null;
    const baseUrl = 'http://backend.test';
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
            get query() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTable = urlParams.get('table') || '1';
                const relation = currentTable === '2' ? 'employee.personalInfo' : 'user.personalInfo';
                return `?include=roles,${relation}`;
            }
        },
        'post': { 
            endpoint: 'posts',
            query: ''
        },
        'comment': {
            endpoint: 'comments',
            query: '?include=account,account.user.personalInfo'
        },
        'permission':{
            endpoint: 'roles',
            query: '?include=permissions'
        },
        'price': {
            get endpoint() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTable = urlParams.get('table') || '1';
                return currentTable === '2' ? 'rechargeRules' : 'payRules';
            },
            query: ''
        },
        'bill': {
            get endpoint() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTable = urlParams.get('table') || '1';
                return currentTable === '2' ? 'rechargeBills' : 'payBills';
            },
            get query() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTable = urlParams.get('table') || '1';
                const relation = currentTable === '2' ? 'include=account,rechargeRule' : 'include=account,post';
                return `?${relation}`;
            }
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

        //Loc cua post
        const btnToggle = document.getElementById('btnFilterToggle');
        const filterPanel = document.getElementById('filterDropdownPanel');

        // Nếu không có nút hoặc panel thì không làm gì (Tránh lỗi console ở trang không có bộ lọc)
        if (!btnToggle || !filterPanel) return;

        // Bấm nút thì mở/đóng panel
        btnToggle.addEventListener('click', function(event) {
            event.stopPropagation(); // Ngăn click lan ra ngoài body
            filterPanel.classList.toggle('show');
        });

        // Bấm vào bên trong panel (đang gõ form) thì không được đóng
        filterPanel.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        // Bấm ra ngoài khoảng không (body) thì tự động ẩn panel đi
        document.addEventListener('click', function() {
            if (filterPanel.classList.contains('show')) {
                filterPanel.classList.remove('show');
            }
        });

        //Save data for filter post
        const filterForm = document.getElementById('filterForm');
        
        // Nếu không có form này (VD: đang ở trang chủ, trang quản lý user...) thì DỪNG LUÔN
        if (!filterForm) return; 

        const urlParams = new URLSearchParams(window.location.search);

        // 1. Hàm rút gọn để điền dữ liệu an toàn 100%
        const setFilterValue = (inputName, value) => {
            // Chỉ tìm thẻ input nằm TRONG form bộ lọc
            const field = filterForm.querySelector(`[name="${inputName}"]`);
            
            // RÀO CHẮN SỐ 2: Đảm bảo thẻ tồn tại VÀ dữ liệu trên URL không bị rỗng/null
            if (field && value !== null && value !== '') {
                field.value = value;
            }
        };

        // 2. Điền các ô dữ liệu cơ bản
        setFilterValue('province', urlParams.get('filter[province]'));
        setFilterValue('area', urlParams.get('filter[area]'));
        setFilterValue('room_type', urlParams.get('filter[roomType]')); 

        // 3. Xử lý Giá tiền
        const priceParam = urlParams.get('filter[price]');
        if (priceParam) {
            const priceParts = priceParam.split(','); 
            
            priceParts.forEach(part => {
                if (part.startsWith('>=')) {
                    setFilterValue('min_price', part.replace('>=', ''));
                } else if (part.startsWith('<=')) {
                    setFilterValue('max_price', part.replace('<=', ''));
                }
            });
        }

        // 4. Xử lý phục hồi Phường/Xã
        const savedProvince = urlParams.get('filter[province]');
        const savedWard = urlParams.get('filter[ward]');
        const filterWardSelect = document.querySelector('select[name="ward"]');
        
        if (savedProvince) {
            if (typeof loadWards === 'function' && filterWardSelect) {
                loadWards(savedProvince, filterWardSelect, savedWard); 
            } else {
                setFilterValue('ward', savedWard);
            }
        }
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
    function handleEdit(modalId) {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            showToast({
                title: "Cảnh báo!",
                message: "Vui lòng chọn dòng dữ liệu để sửa.",
                type: "warning",
                duration: 4000
            });
            return;
        }

        const id = selectedRadio.value;
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        
        // 1. Lấy query từ config (để lấy được permissions, roles, v.v.)
        let queryString = config.query ? (typeof config.query === 'function' ? config.query : config.query) : '';
        const targetEndpoint = `${config.endpoint}/${id}${queryString}`;
        const proxyUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;

        fetch(proxyUrl, {
            method: 'GET',
            headers: { "Accept": "application/json" }
        })
        .then(response => response.json())
        .then(result => {
            const data = result.data || result;
            const form = document.getElementById(modalId);
            if (!form) return;

            const idInput = form.querySelector('input[name="id"]');
            if (idInput) idInput.value = data.id;
            if (currentPage === 'account') {
                fillAccountData(form, data);
            } 
            else if (currentPage === 'permission') {
                fillPermissionData(form, data);
            }

            openModal(modalId);
        })
        .catch(error => {
            console.error(error);
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    function fillAccountData(form, data) {
        const usernameInput = form.querySelector('input[name="username"]');
        if (usernameInput) usernameInput.value = data.username;
        
        const roleInput = form.querySelector('select[name="role"]');
        if (roleInput) roleInput.value = data.role;

        const rolesSelect = form.querySelector('select[name="roles[]"]');
        if (rolesSelect) {
            Array.from(rolesSelect.options).forEach(option => {
                option.selected = false;
            });

            if (data.roles && Array.isArray(data.roles)) {
                const selectedRoleNames = data.roles.map(r => r.name);

                Array.from(rolesSelect.options).forEach(option => {
                    if (selectedRoleNames.includes(option.value)) {
                        option.selected = true;
                    }
                });
            }
        }
    }
    function fillPermissionData(form, data) {
        if (form.querySelector('input[name="name"]')) 
            form.querySelector('input[name="name"]').value = data.name;
        
        if (form.querySelector('input[name="description"]')) 
            form.querySelector('input[name="description"]').value = data.description;

        // Logic đổ checkbox vào Accordion
        const checkboxes = form.querySelectorAll('input[name="permissions[]"]');
        checkboxes.forEach(cb => cb.checked = false); // Reset

        if (data.permissions && Array.isArray(data.permissions)) {
            data.permissions.forEach(p => {
                const permName = typeof p === 'object' ? p.name : p;
                const checkbox = form.querySelector(`input[value="${permName}"]`);
                if (checkbox){
                    checkbox.checked = true;
                    checkbox.dispatchEvent(new Event('change'));
                }
            });
        }
    }
    function handleDelete() {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            showToast({
                title: "Cảnh báo!",
                message: "Vui lòng chọn dòng dữ liệu để xóa.",
                type: "warning",
                duration: 4000
            });
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
                showToast({
                    title: "Thành công!",
                    message: "Xóa thành công.",
                    type: "success",
                    duration: 2000
                });
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
        .catch(error => {
            console.error("Lỗi xóa:", error);
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    function handleSave(event, formElement) {
        event.preventDefault();

        // 1. --- CHÈN BƯỚC KIỂM TRA (VALIDATION) VÀO ĐÂY ---
        const form = event.target;
        const actionInput = form.querySelector('input[name="action"]');
        const action = actionInput ? actionInput.value : null;
        let isValid = true;

        // Gọi hàm kiểm tra tương ứng với action
        if (action === 'addAccount' || action === 'editAccount') {
            isValid = validateAccountMaster(form);
        } else if(action === 'addPermission' || action === 'editPermission'){
            isValid = validatePermissionMaster(form);
        } else if(action === 'addPricePost' || action === 'addPriceExchange'){
            isValid = validatePricingMaster(form);
        } else if(action === 'editPost'){
            isValid = validatePostForm(form);
        }
        
        // 2. --- NẾU LỖI THÌ DỪNG LẠI NGAY ---
        if (!isValid) {
            // Form có lỗi, viền đỏ đã hiện, ta return để ngăn không cho gọi API
            return; 
        }

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
            const message = isEdit ? "Cập nhật thành công." : "Thêm mới thành công.";
            showToast({
                title: "Thành công!",
                message: message,
                type: "success",
                duration: 2000
            });
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
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        })
        .catch(error => {
            console.error("Lỗi lưu dữ liệu:", error);
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    function handleUpdateStatus(event, id, newStatus, title) {
        event.stopPropagation();

        // Xác nhận trước khi làm
        let actionName = newStatus === 'completed' ? 'Duyệt bài' : 
                        newStatus === 'rejected' ? 'Từ chối bài' : 'Gỡ bài';
                        
        if (!confirm(`Bạn có chắc chắn muốn ${actionName} này không?`)) return;
        const reasonMap = {
            'completed': `Bài đăng "${title}" đã được duyệt.`,
            'rejected': `Bài đăng "${title}" đã bị từ chối.`,
            'pending': `Bài đăng "${title}" đang được xét duyệt.`,
            'failed': `Bài đăng "${title}" đã bị gỡ/xóa.`
        };
        let reasonText = reasonMap[newStatus];

        // 2. TÍNH NĂNG NÂNG CAO: Cho phép nhập lý do nếu Từ chối/Gỡ bài
        if (newStatus === 'rejected' || newStatus === 'failed') {
            let customReason = prompt(`Vui lòng nhập lý do ${actionName} (Tùy chọn):`);
            
            // Nếu người dùng bấm "Cancel" ở ô nhập lý do -> Hủy hành động
            if (customReason === null) return; 
            
            // Nếu có nhập chữ, nối thêm vào câu thông báo
            if (customReason.trim() !== '') {
                reasonText += ` Lý do chi tiết: ${customReason.trim()}`;
            }
        }

        // Tạo FormData ảo (không cần thẻ <form> thật)
        let formData = new FormData();
        formData.append('status', newStatus);
        formData.append('_method', 'PUT');
        formData.append('reason', reasonText);

        // Xử lý Endpoint
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        
        // Tạo Endpoint ví dụ: posts/123
        let targetEndpoint = `${config.endpoint}/${id}`;
        formData.append('target_endpoint', targetEndpoint);

        // Gửi API qua Proxy
        fetch('../admin/core/api_proxy.php', {
            method: 'POST',
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
            showToast({
                title: "Thành công!",
                message: "Cập nhật trạng thái thành công.",
                type: "success",
                duration: 2000
            });
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        })
        .catch(error => {
            console.error("Lỗi cập nhật trạng thái:", error);
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    function handleRestore() {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            showToast({
                title: "Lỗi hệ thống",
                message: "Vui lòng chọn dòng dữ liệu để khôi phục.",
                type: "warning",
                duration: 4000
            });
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
                showToast({
                    title: "Thành công!",
                    message: "Khôi phục thành công.",
                    type: "success",
                    duration: 2000
                });
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                throw new Error("Không nhận được phản hồi hợp lệ từ server.");
            }
        })
        .catch(error => {
            console.error("Lỗi khôi phục:", error);
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    // Thêm tham số id vào hàm
    function handleView(id, targetModal) {
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const currentTable = urlParams.get('table');
        const config = apiConfigs[currentPage];
        
        let query = config.query ? config.query : '';
        const targetEndpoint = `${config.endpoint}/${id}${query}`;
        const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;

        // 2. Fetch dữ liệu
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(result => {
            const data = result.data;
            
            // ========================================================
            // 3. TÁCH LOGIC ĐỔ DỮ LIỆU TÙY THEO TỪNG TRANG
            // ========================================================
            
            // ---> NẾU LÀ TRANG ACCOUNT
            if (currentPage === 'account') {
                document.getElementById('view-username').textContent = data.username || 'Không xác định';
                document.getElementById('view-avatar-text').textContent = (data.username || 'A').charAt(0);
                document.getElementById('view-role').textContent = data.role === 'employee' ? 'Nhân viên' : 'Khách hàng';
                document.getElementById('view-id').textContent = data.id;

                const avatarContainer = document.getElementById('view-avatar-text');
                let avatarUrl = null;

                // Tùy chọn 1: Nếu bạn có biến table trên URL (Ví dụ: ?page=account&table=employee)
                const urlParams = new URLSearchParams(window.location.search);
                const table = urlParams.get('table');

                if (table === '2') {
                    // Nếu đang ở bảng nhân viên
                    avatarUrl = data.employee?.personalInfo?.profileUrl;
                } else if (table === '1') {
                    // Nếu đang ở bảng khách hàng
                    avatarUrl = data.user?.personalInfo?.profileUrl;
                }

                // Sau khi IF-ELSE xong, tiến hành in ra giao diện
                if (avatarUrl) {
                    // 1. Trường hợp có ảnh: Ghi đè bằng thẻ img
                    avatarContainer.innerHTML = `<img src="${avatarUrl}" alt="avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">`;
                } else {
                    // 2. Trường hợp không có ảnh: Hiển thị chữ cái đầu tiên (viết hoa)
                    avatarContainer.innerHTML = ''; // Xóa sạch thẻ img rỗng mặc định
                    avatarContainer.textContent = (data.username || 'A').charAt(0).toUpperCase();
                }
                
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
                        badge.textContent = role.name || role;
                        rolesContainer.appendChild(badge);
                    });
                } else {
                    rolesContainer.innerHTML = '<span class="info-value" style="font-style: italic; color: #999;">Không có quyền đặc biệt</span>';
                }
            }
            // ---> NẾU LÀ TRANG PERMISSION (Quyền hạn)
            else if (currentPage === 'permission') {
                document.getElementById('view-permission-name').textContent = data.name || 'Không xác định';
                document.getElementById('view-guard-name').textContent = `Guard: ${data.guard_name || 'api'}`;
                document.getElementById('view-permission-id').textContent = data.id;
                document.getElementById('view-permission-key').textContent = data.name || '';
                
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };

                document.getElementById('view-created-at').textContent = formatDate(data.createdAt);
                
                const descEl = document.getElementById('view-description');
                if (descEl) {
                    descEl.textContent = data.description || 'Chưa có mô tả chi tiết cho quyền hạn này.';
                }

                // XỬ LÝ DANH SÁCH QUYỀN CON (PERMISSIONS)
                const subPermContainer = document.getElementById('view-sub-permissions-container');
                if (subPermContainer) {
                    subPermContainer.innerHTML = '';

                    if (data.permissions && data.permissions.length > 0) {
                        data.permissions.forEach(perm => {
                            const badge = document.createElement('span');
                            badge.className = 'badge-detail badge-sub-permission';
                            badge.textContent = perm.name;
                            badge.title = `ID: ${perm.id} | Ngày tạo: ${formatDate(perm.createdAt)}`;
                            subPermContainer.appendChild(badge);
                        });
                    } else {
                        subPermContainer.innerHTML = '<span class="info-value" style="font-style: italic; color: #999;">Role này chưa được gán quyền hạn nào.</span>';
                    }
                }
            } 
            else if (currentPage === 'comment') {
                const account = data.account || {};
                const username = account.username || 'Khách ẩn danh';

                // Cập nhật Header
                document.getElementById('view-comment-username').textContent = username;
                document.getElementById('view-comment-avatar-text').textContent = username.charAt(0).toUpperCase();
                document.getElementById('view-comment-role').textContent = account.role === 'employee' ? 'Nhân viên' : 'Khách hàng';
                
                const avatarContainer = document.getElementById('view-comment-avatar-text');
                let avatarUrl = null;

                // Tùy chọn 1: Nếu bạn có biến table trên URL (Ví dụ: ?page=account&table=employee)
                const urlParams = new URLSearchParams(window.location.search);
                avatarUrl = data.account?.user?.personalInfo?.profileUrl;

                // Sau khi IF-ELSE xong, tiến hành in ra giao diện
                if (avatarUrl) {
                    // 1. Trường hợp có ảnh: Ghi đè bằng thẻ img
                    avatarContainer.innerHTML = `<img src="${avatarUrl}" alt="avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">`;
                } else {
                    // 2. Trường hợp không có ảnh: Hiển thị chữ cái đầu tiên (viết hoa)
                    avatarContainer.innerHTML = ''; // Xóa sạch thẻ img rỗng mặc định
                    avatarContainer.textContent = (data.username || 'A').charAt(0).toUpperCase();
                }

                // Cập nhật Grid
                document.getElementById('view-comment-id').textContent = data.id;
                document.getElementById('view-comment-account-id').textContent = account.id ? `${account.id}` : 'Không có';

                // Xử lý Ngày tháng
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                document.getElementById('view-comment-date').textContent = formatDate(data.createdAt || data.created_at);

                // Xử lý Trạng thái (Bị xóa/ẩn hay Đang hiển thị)
                const statusEl = document.getElementById('view-comment-status');
                if (data.deletedAt === null) {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Hiển thị</span>';
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Đã bị ẩn</span>';
                }

                // Xử lý Nội dung bình luận
                document.getElementById('view-comment-content').textContent = data.content || 'Không có nội dung.';
            }
            // ---> NẾU LÀ TRANG HÓA ĐƠN (Invoice / Payment)
            else if (currentPage === 'bill' && currentTable === '1') {
                
                // Hàm tiện ích: Format ngày
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };

                // Hàm tiện ích: Format tiền VNĐ
                const formatCurrency = (amount) => {
                    if (!amount) return '0 VND';
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                };

                // 1. Thông tin chung
                document.getElementById('view-invoice-id').textContent = data.id;
                document.getElementById('view-invoice-date').textContent = formatDate(data.createdAt);
                document.getElementById('view-invoice-points').textContent = `+${data.points || 0} Điểm`;

                // Xử lý Trạng thái (Status)
                const statusEl = document.getElementById('view-invoice-status');
                if (data.status === 'completed') {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Thành công</span>';
                } else if (data.status === 'pending') {
                    statusEl.innerHTML = '<span class="badge-detail badge-warning" style="background-color: #FEF3C7; color: #D97706;">Đang xử lý</span>';
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Thất bại / Hủy</span>';
                }

                // 2. Thông tin Tài khoản
                const acc = data.account || {};
                document.getElementById('view-invoice-username').textContent = acc.username ? `${acc.username} (ID: ${acc.id})` : 'Khách vãng lai';
                document.getElementById('view-invoice-role').textContent = acc.role === 'employee' ? 'Nhân viên' : 'Khách hàng';

                // 3. Thông tin Bài đăng
                const post = data.post || {};
                document.getElementById('view-invoice-post-id').textContent = post.id ? `${post.id}` : '---';
                document.getElementById('view-invoice-post-title').textContent = post.title || 'Bài đăng không tồn tại hoặc đã bị xóa';
                document.getElementById('view-invoice-post-price').textContent = formatCurrency(post.price);

                // Nối chuỗi địa chỉ
                const addressParts = [post.houseNumber, post.ward, post.province].filter(Boolean);
                document.getElementById('view-invoice-post-address').textContent = addressParts.length > 0 ? addressParts.join(', ') : 'Chưa cập nhật địa chỉ';
            }
            // ---> NẾU LÀ TRANG HÓA ĐƠN NẠP TIÊN (Recharge)
            else if (currentPage === 'bill' && currentTable === '2') { 
                
                // Hàm tiện ích format
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                const formatCurrency = (amount) => {
                    if (!amount) return '0 VND';
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                };

                // 1. Thông tin chung
                document.getElementById('view-recharge-id').textContent = data.id;
                document.getElementById('view-recharge-date').textContent = formatDate(data.createdAt);

                // Xử lý Trạng thái
                const statusEl = document.getElementById('view-recharge-status');
                if (data.status === 'completed') {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Thành công</span>';
                } else if (data.status === 'pending') {
                    statusEl.innerHTML = '<span class="badge-detail badge-warning" style="background-color: #FEF3C7; color: #D97706;">Đang xử lý</span>';
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Thất bại</span>';
                }

                // 2. Chi tiết thanh toán tiền & điểm
                // API trả về kiểu string ("469877"), ép kiểu sang số để format
                document.getElementById('view-recharge-money').textContent = formatCurrency(parseFloat(data.money));
                document.getElementById('view-recharge-vat').textContent = formatCurrency(parseFloat(data.vat));
                document.getElementById('view-recharge-total').textContent = formatCurrency(parseFloat(data.totalMoney));
                document.getElementById('view-recharge-points').textContent = `+${new Intl.NumberFormat('vi-VN').format(data.points)} Điểm`;

                // 3. Thông tin người nạp
                const acc = data.account || {};
                document.getElementById('view-recharge-username').textContent = acc.username ? `${acc.username} (ID: ${acc.id})` : 'Không xác định';
                document.getElementById('view-recharge-role').textContent = acc.role === 'employee' ? 'Nhân viên' : 'Khách hàng';

                // 4. Thông tin gói nạp (Recharge Rule)
                const rule = data.rechargeRule;
                const ruleContainer = document.getElementById('view-recharge-rule');
                if (rule) {
                    ruleContainer.innerHTML = `
                        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                            <span>Mã gói: <strong>#${rule.id}</strong></span>
                            <span style="color: #059669;">+${new Intl.NumberFormat('vi-VN').format(rule.points)} Điểm</span>
                        </div>
                        <div style="font-size: 1.3rem; color: #64748B;">
                            Giá gốc gói: ${formatCurrency(parseFloat(rule.money))}
                        </div>
                    `;
                } else {
                    ruleContainer.innerHTML = '<span style="font-style: italic; color: #94A3B8;">Nạp tự do (Không áp dụng gói)</span>';
                }
            }
            // ---> NẾU LÀ TRANG CẤU HÌNH GIÁ ĐĂNG BÀI
            else if (currentPage === 'price' && currentTable === '1') {
                // Hàm tiện ích format ngày
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };

                // 1. Fill thông tin cơ bản
                document.getElementById('view-pricing-id').textContent = data.id;
                document.getElementById('view-pricing-created').textContent = formatDate(data.createdAt);
                document.getElementById('view-pricing-points').textContent = `${data.points} Điểm`;

                // 2. Xử lý Trạng thái & Hiển thị khung "Đã xóa"
                const statusEl = document.getElementById('view-pricing-status');
                const deletedGroup = document.getElementById('view-pricing-deleted-group');

                if (data.deletedAt) {
                    // Nếu có deletedAt -> Cấu hình này đã bị ngừng áp dụng
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Ngừng áp dụng (Đã xóa)</span>';
                    deletedGroup.style.display = 'block';
                    document.getElementById('view-pricing-deleted').textContent = formatDate(data.deletedAt);
                } else {
                    // Nếu không có deletedAt -> Đang là cấu hình hiện tại
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Đang áp dụng</span>';
                    deletedGroup.style.display = 'none';
                }
            }
            // ---> NẾU LÀ TRANG GÓI QUY ĐỔI NẠP TIỀN
            else if (currentPage === 'price' && currentTable === '2') { // Sửa lại 'exchange' cho khớp với ?page= của bạn
                
                // Hàm tiện ích format
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                const formatCurrency = (amount) => {
                    if (!amount) return '0 đ';
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                };

                // 1. Thông tin chung
                document.getElementById('view-exchange-id').textContent = data.id;
                document.getElementById('view-exchange-created').textContent = formatDate(data.createdAt);
                
                // 2. Fill Tỷ lệ quy đổi (Tiền và Điểm)
                document.getElementById('view-exchange-money').textContent = formatCurrency(parseFloat(data.money));
                document.getElementById('view-exchange-points').textContent = `+${new Intl.NumberFormat('vi-VN').format(data.points)} Điểm`;

                // 3. Xử lý Trạng thái & Khung hiển thị "Đã xóa"
                const statusEl = document.getElementById('view-exchange-status');
                const deletedGroup = document.getElementById('view-exchange-deleted-group');

                if (data.deletedAt) {
                    // Đã bị ngừng áp dụng
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Ngừng áp dụng (Cũ)</span>';
                    deletedGroup.style.display = 'block';
                    document.getElementById('view-exchange-deleted').textContent = formatDate(data.deletedAt);
                } else {
                    // Đang hoạt động
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Đang áp dụng</span>';
                    deletedGroup.style.display = 'none';
                }
            }

            // Mở modal sau khi đã đổ dữ liệu xong
            openModal(targetModal);
        })
        .catch(error => {
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
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
                document.getElementById('reason').textContent = data.reason ?? "Lý do: Không có"
                
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
                    data.postImages.forEach((imgObj) => {
                        // Dùng thuộc tính 'order' từ Database thay vì 'index' của mảng
                        // Ép kiểu về số (parseInt) cho chắc chắn
                        let order = parseInt(imgObj.order); 
                        let slotName = '';

                        if (order === 1) slotName = 'main';
                        else if (order === 2) slotName = 'sub_1';
                        else if (order === 3) slotName = 'sub_2';
                        else if (order === 4) slotName = 'sub_3';

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
                showToast({
                    title: "Lỗi hệ thống",
                    message: "Không thể kết nối đến máy chủ.",
                    type: "error",
                    duration: 4000
                });
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
        fillFormEditData(currentPostData);
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

        const textFields = ['id', 'title', 'price', 'deposit', 'area', 'maxOccupants', 'description', "roomType"];
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

        if (citySelect && data.province) {
            citySelect.value = data.province; 
            
            if (citySelect.value && wardSelect) {
                loadWards(data.province, wardSelect, data.ward);
            }
        } else {
            if (wardSelect) {
                wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
            }
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
        const form = document.getElementById('form-edit-post');
        if (form) {
            // 1. Quét tất cả các ô input, select, textarea trong form và xóa viền đỏ/chữ đỏ
            const elements = form.querySelectorAll('input, select, textarea');
            elements.forEach(el => {
                if (typeof Validator !== 'undefined') {
                    Validator.clearError(el);
                }
            });
        }

        // 2. Dọn luôn lỗi báo thiếu ảnh (Vì khung ảnh nằm ngoài form)
        const imgWrapper = document.querySelector('.main-image-wrapper');
        const fileInput = document.getElementById('hidden-file-input');
        
        if (typeof Validator !== 'undefined') {
            if (imgWrapper) Validator.clearError(imgWrapper);
            if (fileInput) Validator.clearError(fileInput);
        }
    }
    function restoreImages(postImages) {
        const baseUrl = "http://backend.test";
        const defaultImg = "../../assets/admin/images/post_img.png";
        const slots = ['main', 'sub_1', 'sub_2', 'sub_3'];

        // 1. DỌN SẠCH ẢNH TẠM (Phòng khi user lỡ đổi ảnh mới nhưng lại bấm Hủy)
        slots.forEach(slot => {
            const imgEl = document.getElementById(`img-${slot}`);
            if (imgEl) imgEl.src = defaultImg;
            
            const wrapper = document.querySelector(`.image-slot[data-slot="${slot}"]`);
            if (wrapper) {
                let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                if (hiddenInput) {
                    hiddenInput.value = ""; 
                } else {
                    wrapper.insertAdjacentHTML('beforeend', `<input type="hidden" name="existing_images[${slot}]" value="">`);
                }
            }
        });
        
        // 2. ĐỔ LẠI DỮ LIỆU GỐC THEO ĐÚNG ORDER
        if (postImages && postImages.length > 0) {
            postImages.forEach(imgObj => {
                let order = parseInt(imgObj.order); // Dùng order, tuyệt đối không dùng index
                let slotName = '';

                if (order === 1) slotName = 'main';
                else if (order === 2) slotName = 'sub_1';
                else if (order === 3) slotName = 'sub_2';
                else if (order === 4) slotName = 'sub_3';

                if (slotName) {
                    const imgEl = document.getElementById(`img-${slotName}`);
                    const wrapper = document.querySelector(`.image-slot[data-slot="${slotName}"]`);
                    
                    // Đảm bảo biến baseUrl đã được khai báo ở file của bạn
                    const fullUrl = baseUrl + imgObj.imagePostUrl; 

                    // Gán ảnh và input ẩn
                    if (imgEl) imgEl.src = fullUrl;
                    if (wrapper) {
                        let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                        if (hiddenInput) {
                            hiddenInput.value = imgObj.imagePostUrl; 
                        }
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
                let currentRole = account.role ?? 'N/A'

                const currentRoles = [];
                if (account.roles && Array.isArray(data.roles)) {
                    currentRoles = data.roles.map(r => r.name);
                }

                // Mã hóa mảng để truyền an toàn qua tham số onclick
                let encodedRoles = encodeURIComponent(JSON.stringify(currentRoles));

                return `
                    <tr>
                        <td>${account.id}</td>
                        <td style="font-weight: 500;">${account.username || account.name || 'N/A'}</td>
                        
                        <td>${currentRole}</td>
                        
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
                showToast({
                    title: "Lỗi hệ thống",
                    message: "Lỗi: " + (result.message || "Không thể thu hồi"),
                    type: "error",
                    duration: 4000
                });
                return;
            }
            showToast({
                title: "Thành công!",
                message: "Thu hồi quyền thành công.",
                type: "success",
                duration: 2000
            });
            openAccountListModal(null, targetModel, roleNameToRemove, roleId);
        })
        .catch(error => {
            console.error("Fetch error:", error);
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    // Hàm vẽ toàn bộ biểu đồ
    async function renderMonthlyPostChart(year) {
        try {
            // Mẹo nhỏ: Nên dùng encodeURIComponent để cái link an toàn tuyệt đối khi qua Proxy
            const endpoint = `statistic/posts/month_data?year=${year}`;
            const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(endpoint)}`;
            
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: { "Accept": "application/json" }
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
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
                
                // ==========================================
                // QUAN TRỌNG: Hủy biểu đồ cũ đi trước khi vẽ mới
                // ==========================================
                if (monthlyChartInstance) {
                    monthlyChartInstance.destroy();
                }

                // Gán cái biểu đồ mới vào biến
                monthlyChartInstance = new Chart(ctx1, {
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
                                        return `Tổng năm ${result.year || year}: ${result.yearlyTotal || 0} bài`;
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
            const apiUrl = `../admin/core/api_proxy.php?target_endpoint=statistic/posts/room_data`;
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: { "Accept": "application/json" }
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
    async function renderRegionChart(provinceId = '') {
        try {
            let endpoint = '';
            let isProvinceLevel = false;

            // 1. NGÃ RẼ LOGIC: Chọn API dựa trên lựa chọn của người dùng
            if (provinceId === '') {
                // Chọn "Toàn quốc" -> Gọi API Tỉnh/Thành
                endpoint = 'statistic/posts/province_data';
                isProvinceLevel = true;
            } else {
                // Chọn Tỉnh cụ thể -> Gọi API Phường/Xã
                endpoint = `statistic/posts/ward_data?province=${provinceId}`;
                isProvinceLevel = false;
            }

            const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(endpoint)}`;
            
            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: { "Accept": "application/json" }
            });

            const result = await response.json();

            let chartLabels = [];
            let chartData = [];

            // 2. LẤY DỮ LIỆU (Vì 2 API trả về tên key khác nhau nên cần check)
            if (isProvinceLevel && result && result.provinceDetails) {
                // Dữ liệu Top 10 Tỉnh
                result.provinceDetails.forEach(item => {
                    chartLabels.push(item.province);
                    chartData.push(item.total);
                });
            } else if (!isProvinceLevel && result && result.wardDetails) {
                // Dữ liệu Top 10 Phường (Lấy trực tiếp mảng đã sắp xếp sẵn từ Backend)
                result.wardDetails.forEach(item => {
                    const labelName = item.ward || item.name || 'Khu vực';
                    chartLabels.push(labelName);
                    chartData.push(item.total);
                });
            }

            // 3. VẼ BIỂU ĐỒ
            const ctx3 = document.getElementById('chart3');
            if (ctx3) {
                if (regionChartInstance) {
                    regionChartInstance.destroy();
                }

                regionChartInstance = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Số bài đăng',
                            data: chartData,
                            // UX trick: Đổi màu bar để Admin dễ nhận biết đang xem cấp độ nào
                            backgroundColor: isProvinceLevel ? '#F59E0B' : '#8B5CF6', // Vàng (Tỉnh) - Tím (Phường)
                            borderRadius: 4
                        }]
                    },
                    options: {
                        indexAxis: 'y', 
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
                                ticks: { precision: 0 }, 
                                grid: { borderDash: [5, 5] }
                            },
                            y: { grid: { display: false } }
                        }
                    }
                });
            }
        } catch (error) {
            console.error("Lỗi khi tải dữ liệu biểu đồ khu vực:", error);
        }
    }
    async function renderRevenueChart(year, compareYear = '') {
        try {
            let endpoint = `statistic/revenue?year=${year}&with_taxes=true`;
            if (compareYear) {
                endpoint += `&compare_year=${compareYear}`;
            }

            const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(endpoint)}`;
            const response = await fetch(apiUrl, { method: 'GET', headers: { "Accept": "application/json" } });
            const result = await response.json();

            // 1. CẬP NHẬT GIAO DIỆN KPI
            document.getElementById('kpiTotalRevenue').textContent = formatVND(result.yearlyRevenue || 0);
            
            const badge = document.getElementById('kpiTrendBadge');
            if (result.revenueDifference !== null && result.revenueDifference !== undefined) {
                badge.style.display = 'flex';
                const diff = parseFloat(result.revenueDifference);
                
                if (diff >= 0) {
                    badge.className = 'kpi-badge positive';
                    badge.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg> +${diff}%`;
                } else {
                    badge.className = 'kpi-badge negative';
                    badge.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg> ${diff}%`;
                }
            } else {
                badge.style.display = 'none';
            }

            // 2. CHUẨN BỊ DỮ LIỆU BIỂU ĐỒ
            const monthlyData = new Array(12).fill(0);
            if (result.monthlyRevenueDetails) {
                result.monthlyRevenueDetails.forEach(item => {
                    monthlyData[item.month - 1] = item.totalRevenue;
                });
            }

            // 3. VẼ BIỂU ĐỒ AREA
            const ctx4 = document.getElementById('chart4');
            if (ctx4) {
                if (revenueChartInstance) revenueChartInstance.destroy();

                // Tạo gradient màu cho biểu đồ vùng
                const gradient = ctx4.getContext('2d').createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Xanh lá mờ ở trên
                gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)'); // Trong suốt ở dưới

                revenueChartInstance = new Chart(ctx4, {
                    type: 'line',
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: monthlyData,
                            borderColor: '#10B981', // Đổi sang màu xanh lá của tiền bạc
                            backgroundColor: gradient,
                            fill: true, // Kích hoạt Area Chart
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
                                    label: function(context) { return ` ${formatVND(context.parsed.y)}`; }
                                }
                            }
                        },
                        scales: {
                            y: { 
                                beginAtZero: true, 
                                grid: { borderDash: [5, 5] },
                                ticks: {
                                    // Rút gọn số trên trục Y (Ví dụ: 1000000 -> 1M)
                                    callback: function(value) {
                                        if (value >= 1000000) return (value / 1000000) + ' Tr';
                                        if (value >= 1000) return (value / 1000) + ' K';
                                        return value;
                                    }
                                }
                            },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        } catch (error) {
            console.error("Lỗi vẽ biểu đồ doanh thu:", error);
        }
    }
    async function loadWards(cityName, wardSelectElement, selectedWardName = null) {
        if (!wardSelectElement) return;
        
        wardSelectElement.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
        if (!cityName) return;

        try {
            const endpoint = `address/provinces/name/${encodeURIComponent(cityName)}/wards`;
            const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(endpoint)}`;

            const response = await fetch(apiUrl, {
                method: 'GET',
                headers: { "Accept": "application/json" }
            });

            const result = await response.json();
            const wards = result.data || result; 
            
            if (wards && wards.length > 0) {
                wards.forEach(ward => {
                    const option = document.createElement('option');
                    option.value = ward.name;
                    option.textContent = ward.name;
                    wardSelectElement.appendChild(option);
                });
                
                if (selectedWardName) {
                    wardSelectElement.value = selectedWardName;
                }
            }
        } catch (error) {
            console.error("Lỗi khi lấy danh sách Phường/Xã:", error);
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const filterProvinceSelect = document.querySelector('select[name="province"]');
        const filterWardSelect = document.querySelector('select[name="ward"]');

        if (filterProvinceSelect && filterWardSelect) {
            
            // Load lại dữ liệu cũ nếu có (Giả sử bạn đang giữ state qua URL hoặc Session)
            const currentFilterProvince = filterProvinceSelect.value;
            const currentFilterWard = "<?php echo htmlspecialchars($_GET['ward'] ?? ''); ?>"; // VD lấy từ URL

            if (currentFilterProvince) {
                const selectedOption = filterProvinceSelect.options[filterProvinceSelect.selectedIndex];
                const cityName = selectedOption ? (selectedOption.getAttribute('data-name') || currentFilterProvince) : currentFilterProvince;
                // Truyền thẻ filterWardSelect vào hàm
                loadWards(cityName, filterWardSelect, currentFilterWard);
            }

            // Bắt sự kiện đổi tỉnh thành
            filterProvinceSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                // Lấy data-name nếu có, không thì lấy value
                const cityName = selectedOption ? (selectedOption.getAttribute('data-name') || this.value) : this.value;
                
                if (cityName) {
                    // Truyền thẻ filterWardSelect vào hàm
                    loadWards(cityName, filterWardSelect, null); 
                } else {
                    filterWardSelect.innerHTML = '<option value="">Vui lòng chọn thành phố trước</option>';
                }
            });
        }

        const formCitySelect = document.getElementById('city-select');
        const formWardSelect = document.getElementById('ward-select');

        if (formCitySelect && formWardSelect) {
            // Lắng nghe sự kiện khi Admin đổi Tỉnh ở Form Thêm/Sửa
            formCitySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                // Lấy value hoặc data-name
                const cityName = selectedOption ? (selectedOption.getAttribute('data-name') || this.value) : this.value;
                
                if (cityName) {
                    // Đổ dữ liệu vào đúng cái ô Phường của Form
                    loadWards(cityName, formWardSelect, null); 
                } else {
                    formWardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                }
            });
        }
    });
    // Hàm xử lý áp dụng lọc
    function handleApplyFilter(event) {
        event.preventDefault(); // Ngăn form tự động load lại trang

        const form = event.target;
        const formData = new FormData(form);
        const url = new URL(window.location.href);

        // Thêm tham số per_page=all
        url.searchParams.set('per_page', 'all');

        // 1. XỬ LÝ KHOẢNG GIÁ
        let minPrice = formData.get('min_price');
        let maxPrice = formData.get('max_price');
        let priceFilter = '';

        if (minPrice && maxPrice) {
            priceFilter = `>=${minPrice},<=${maxPrice}`;
        } else if (minPrice) {
            priceFilter = `>=${minPrice}`;
        } else if (maxPrice) {
            priceFilter = `<=${maxPrice}`;
        }

        if (priceFilter) {
            url.searchParams.set('filter[price]', priceFilter);
        } else {
            url.searchParams.delete('filter[price]');
        }

        // 2. XỬ LÝ CÁC TRƯỜNG CÒN LẠI 
        // (Dùng một hàm ngắn để kiểm tra: có data thì set, trống thì delete cho sạch URL)
        const setOrDeleteParam = (paramName, value) => {
            if (value && value.trim() !== "") {
                url.searchParams.set(paramName, value);
            } else {
                url.searchParams.delete(paramName);
            }
        };

        setOrDeleteParam('filter[province]', formData.get('province'));
        setOrDeleteParam('filter[ward]', formData.get('ward'));
        setOrDeleteParam('filter[area]', formData.get('area'));
        setOrDeleteParam('filter[roomType]', formData.get('room_type')); // Đổi key thành roomType

        // Lưu ý: Cố tình bỏ qua formData.get('max_people') theo yêu cầu

        // 3. XÓA TRANG HIỆN TẠI (Đưa về trang 1 khi có bộ lọc mới)
        url.searchParams.delete('p');

        // 4. ẨN PANEL VÀ CHUYỂN HƯỚNG
        const filterPanel = document.getElementById('filterDropdownPanel');
        if (filterPanel) {
            filterPanel.classList.remove('show');
        }

        window.location.href = url.toString();
    }
    // Hàm tách lý do chi tiết từ chuỗi của Backend trả về
    function extractReasonDetail(fullReason) {
        if (!fullReason) return "Không có thông tin lý do.";

        const keyword = "Lý do chi tiết: ";
        
        // Kiểm tra xem trong chuỗi có chứa từ khóa này không
        if (fullReason.includes(keyword)) {
            // Cắt chuỗi thành mảng gồm 2 phần, lấy phần thứ 2 (index 1)
            const parts = fullReason.split(keyword);
            return parts[1].trim(); // Trả về chữ "aaaa"
        }
        
        // Nếu không có chữ "Lý do chi tiết", trả về toàn bộ câu gốc (đề phòng)
        return fullReason; 
    }
    // Thêm tham số postId vào cuối cùng
    function handleViewReason(event, fullReasonString, postId) {
        // 1. Chặn click lan ra ngoài
        event.stopPropagation();

        // 2. Cắt lấy lý do thực sự
        const exactReason = extractReasonDetail(fullReasonString);

        // 3. Tìm ĐÚNG thẻ textarea của bài đăng này (Nối thêm postId vào ID)
        const reasonDisplayEl = document.getElementById('reason-display-' + postId);
        
        if (reasonDisplayEl) {
            if (reasonDisplayEl.tagName === 'INPUT' || reasonDisplayEl.tagName === 'TEXTAREA') {
                reasonDisplayEl.value = exactReason;
            } else {
                reasonDisplayEl.innerText = exactReason;
            }
        }

        // 4. Mở ĐÚNG cái Modal của bài đăng này
        openModal('modal-xem-ly-do-' + postId);
    }
</script>
</html>