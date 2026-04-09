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
if (isset($accountData['message']) && $accountData['message'] === "Unauthenticated.") {
    header('Location: logout.php');
    exit;
}
$userPermissions = [];
if (isset($accountData['data']['roles'][0]['permissions'])) {
    $userPermissions = $accountData['data']['roles'][0]['permissions'];
}
$_SESSION['user_permissions'] = $userPermissions;
$_SESSION['user_avatar'] = $accountData['data']['employee']['personalInfo']['profileUrl'] ?? "";
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
        $apiResult = call_api("http://backend.test/api/accounts?per_page=4&page={$pageNum}&filter[role]={$apiRole}&sort=-updateAt" . $filterQuery);
        $pageData['accounts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=account&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
        ];
        break;
    case 'comment':
        $apiResult = call_api("http://backend.test/api/comments?per_page=4&page={$pageNum}&include=account&sort=-updateAt" . $filterQuery);
        $pageData['comments'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=comment&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
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
        $apiResult = call_api("http://backend.test/api/posts?per_page=8&page={$pageNum}&include=postImages&filter[status]={$apiSt}&sort=-updateAt" . $filterQuery);
        $pageData['posts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=post&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
        ];
        break;
    case 'price':
        $apiType = match($currentTable) {
            '1' => 'payRules',
            '2' => 'rechargeRules',
            default => 'payRules'
        };
        $apiResult = call_api("http://backend.test/api/{$apiType}?per_page=4&page={$pageNum}&sort=-updateAt" . $filterQuery);
        $pageData['rules'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=price&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
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
        $apiResult = call_api("http://backend.test/api/{$apiType}?per_page=4&page={$pageNum}&include={$apiInclude}&sort=-updateAt" . $filterQuery);
        $pageData['bills'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=bill&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
        ];
        break;
    case 'permission':
        $apiResult = call_api("http://backend.test/api/roles?per_page=4&page={$pageNum}&sort=-updateAt" . $filterQuery);
        $pageData['permissions'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=permission&table={$currentTable}" . $filterQuery,
            'query'        =>  $filterQuery
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
                sessionStorage.setItem('scrollAction', 'exact');
                sessionStorage.setItem('scrollPosition', Math.round(window.scrollY));
            } else if (isPaginationLink) {
                sessionStorage.setItem('scrollAction', 'bottom');
            }
        });

        
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
        document.querySelectorAll('.image-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                const modal = document.getElementById('post-detail-modal');
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

        //Chon anh bai dang
        const hiddenFileInput = document.getElementById('hidden-file-input');

        if (hiddenFileInput) {
            hiddenFileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (!file || typeof currentActiveSlot === 'undefined' || !currentActiveSlot) return;
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imgElement = document.getElementById(`img-${currentActiveSlot}`);
                    if (imgElement) {
                        imgElement.src = event.target.result;
                    }
                }
                reader.readAsDataURL(file);

                //Luu anh
                if (typeof newUploadedFiles !== 'undefined') {
                    newUploadedFiles[currentActiveSlot] = file;
                }

                //Xoa anh cu
                const currentSlotWrapper = document.querySelector(`.image-slot[data-slot="${currentActiveSlot}"]`);
                if (currentSlotWrapper) {
                    const oldHiddenInput = currentSlotWrapper.querySelector('input[type="hidden"]');
                    if (oldHiddenInput) {
                        oldHiddenInput.remove(); 
                    }
                }
                //Reset input file de co the chon lai file cung ten
                this.value = '';
            });
        }

        

        //Xoa anh (preview)
        document.querySelectorAll('.btn-delete-img').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const slotWrapper = this.closest('.image-slot');
                const slotName = slotWrapper.getAttribute('data-slot');
                const imgEl = slotWrapper.querySelector('img');
                if (imgEl) {
                    imgEl.src = defaultPlaceholderImg;
                }
                const hiddenInput = slotWrapper.querySelector('input[type="hidden"]');
                if (hiddenInput) {
                    hiddenInput.value = ""; 
                }
                if (typeof newUploadedFiles !== 'undefined' && newUploadedFiles[slotName]) {
                    newUploadedFiles[slotName] = null;
                }
            });
        });

        //Loc cua post
        const btnToggle = document.getElementById('btnFilterToggle');
        const filterPanel = document.getElementById('filterDropdownPanel');
        if (!btnToggle || !filterPanel) return;
        btnToggle.addEventListener('click', function(event) {
            event.stopPropagation();
            filterPanel.classList.toggle('show');
        });
        filterPanel.addEventListener('click', function(event) {
            event.stopPropagation();
        });
        document.addEventListener('click', function() {
            if (filterPanel.classList.contains('show')) {
                filterPanel.classList.remove('show');
            }
        });

        //Luu du lieu cua filter
        const filterForm = document.getElementById('filterForm');
        if (!filterForm) return; 

        const urlParams = new URLSearchParams(window.location.search);
        const setFilterValue = (inputName, value) => {
            const field = filterForm.querySelector(`[name="${inputName}"]`);
            if (field && value !== null && value !== '') {
                field.value = value;
            }
        };
        //Du lieu co ban
        setFilterValue('province', urlParams.get('filter[province]'));
        setFilterValue('area', urlParams.get('filter[area]'));
        setFilterValue('room_type', urlParams.get('filter[roomType]')); 
        //Gia tien
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
        //Quan/Huyen
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

        //Fill checkbox
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
    async function handleDelete() {
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
        const isConfirmed = await showConfirm(
            "Cảnh báo xóa", 
            "Bạn có chắc chắn muốn xóa dữ liệu này không? Hành động này không thể hoàn tác!", 
            true 
        );
        if (!isConfirmed) {
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
            if (msg == "Cannot delete this account") {
                showToast({
                    title: "Cảnh báo!",
                    message: "Không thể xóa tài khoản của admin.",
                    type: "warning",
                    duration: 2000
                });
            }else{
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

        const form = event.target;
        const actionInput = form.querySelector('input[name="action"]');
        const action = actionInput ? actionInput.value : null;
        let isValid = true;

        // Valid theo action
        if (action === 'addAccount' || action === 'editAccount') {
            isValid = validateAccountMaster(form);
        } else if(action === 'addPermission' || action === 'editPermission'){
            isValid = validatePermissionMaster(form);
        } else if(action === 'addPricePost' || action === 'addPriceExchange'){
            isValid = validatePricingMaster(form);
        } else if(action === 'editPost'){
            isValid = validatePostForm(form);
        }
        
        if (!isValid) {
            return; 
        }

        //Xu ly anh
        let formData = new FormData(formElement);
        const slotOrders = { 'main': 1, 'sub_1': 2, 'sub_2': 3, 'sub_3': 4 };
        const slotIndex = { 'main': 0, 'sub_1': 1, 'sub_2': 2, 'sub_3': 3 };
        const parentContainer = formElement.closest('.modal-content') || document;

        //Lap qua danh sach 4 o anh
        ['main', 'sub_1', 'sub_2', 'sub_3'].forEach(slotName => {
            const hiddenInput = parentContainer.querySelector(`.image-slot[data-slot="${slotName}"] input[type="hidden"]`);
            const hasNewFile = typeof newUploadedFiles !== 'undefined' && newUploadedFiles[slotName];

            //Co anh moi tai len
            if (hasNewFile) {
                const file = newUploadedFiles[slotName];
                formData.append(`images[${slotIndex[slotName]}]`, file);
                formData.append(`orders[${slotIndex[slotName]}]`, slotOrders[slotName]);
            } 
            //Khong co anh moi
            else if (hiddenInput) {
                if (hiddenInput.value === "") {
                    //User da xoa anh
                    formData.append(`deleted_orders[${slotIndex[slotName]}]`, slotOrders[slotName]);
                } else {
                    //Giu anh cu
                    formData.append(`existing_images[${slotName}]`, hiddenInput.value);
                }
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
            if (error.message && error.message.includes("The points has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Số điểm này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            if (error.message && error.message.includes("The name has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Tên này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            if (error.message && error.message.includes("The email has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Email này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            if (error.message && error.message.includes("The username has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Tên tài khoản này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            if (error.message && error.message.includes("The phone number has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Số điện thoại này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    async function handleUpdateStatus(event, id, newStatus, title) {
        event.stopPropagation();
        let actionName = newStatus === 'completed' ? 'Duyệt bài' : 
                        newStatus === 'rejected' ? 'Từ chối bài' : 'Gỡ bài';

        const isConfirmed = await showConfirm(
            "Xác nhận hành động", 
            `Bạn có chắc chắn muốn ${actionName} này không?`, 
            false 
        );
        if (!isConfirmed) {
            return;
        }

        let reasonText = "";
        if (newStatus === 'rejected' || newStatus === 'failed') {
            let customReason = await showPrompt(
                "Xác nhận hành động", 
                `Vui lòng nhập lý do ${actionName} (Tùy chọn):`, 
                "Nhập lý do của bạn vào đây..."
            );
            
            if (customReason === null) return; 
            if (customReason.trim() !== '') {
                reasonText += `${customReason.trim()}`;
            }
        }

        let formData = new FormData();
        formData.append('employee_id', '<?php echo $adminId ?>');
        formData.append('status', newStatus);
        formData.append('_method', 'PUT');
        formData.append('reason', reasonText);
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        let targetEndpoint = `${config.endpoint}/${id}`;
        formData.append('target_endpoint', targetEndpoint);
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
                message: actionName + " thành công.",
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
    async function handleRestore() {
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
        const isConfirmed = await showConfirm(
            "Xác nhận hành động", 
            "Bạn có chắc chắn muốn khôi phục dữ liệu này không?", 
            false 
        );
        if (!isConfirmed) {
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
    function handleView(id, targetModal) {
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        if(currentPage === "account"){
            resetProfileInfoForm();
        }
        const currentTable = urlParams.get('table');
        const config = apiConfigs[currentPage];
        
        let query = config.query ? config.query : '';
        const targetEndpoint = `${config.endpoint}/${id}${query}`;
        const apiUrl = `../admin/core/api_proxy.php?target_endpoint=${encodeURIComponent(targetEndpoint)}`;
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(result => {
            const data = result.data;
            
            //account
            if (currentPage === 'account') {
                document.getElementById('view-username').textContent = data.username || 'Không xác định';
                document.getElementById('view-avatar-text').textContent = (data.username || 'A').charAt(0);
                document.getElementById('view-role').textContent = data.role === 'employee' ? 'Nhân viên' : 'Khách hàng';
                document.getElementById('view-id').textContent = data.id;

                const avatarContainer = document.getElementById('view-avatar-text');
                let avatarUrl = null;

                const urlParams = new URLSearchParams(window.location.search);
                const table = urlParams.get('table');

                if (table === '2') {
                    avatarUrl = data.employee?.personalInfo?.profileUrl;
                } else if (table === '1') {
                    avatarUrl = data.user?.personalInfo?.profileUrl;
                }

                if (avatarUrl) {
                    avatarContainer.innerHTML = `<img src="${avatarUrl}" alt="avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">`;
                } else {
                    avatarContainer.innerHTML = '';
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
                //Form chi tiet
                const formPersonalInfo = document.getElementById('panel-info');
                const allFields = formPersonalInfo.querySelectorAll('input, select');
                allFields.forEach(field => {
                    Validator.clearError(field);
                });
                if (formPersonalInfo) {
                    const saveBtn = document.getElementById('btn-save-profile');
                    if (saveBtn) {
                        saveBtn.setAttribute('onclick', `handleSaveSettings(event, ${data.id})`);
                    }
                    const accid = document.getElementById('account-id-to-edit');
                    if (accid) {
                        accid.value = data.id;
                        if (data.deletedAt !== null) {
                            accid.dataset.locked = "true";
                        } else {
                            accid.dataset.locked = "false";
                        }
                    }

                    const pInfo = profileInfo?.personalInfo || {};
                    
                    //Fill input
                    formPersonalInfo.querySelector('input[name="name"]').value = pInfo.name || '';
                    formPersonalInfo.querySelector('input[name="phone_number"]').value = pInfo.phoneNumber || '';
                    formPersonalInfo.querySelector('input[name="email"]').value = pInfo.email || '';
                    formPersonalInfo.querySelector('input[name="house_number"]').value = pInfo.houseNumber || '';
                    formPersonalInfo.querySelector('input[name="pid"]').value = pInfo.pid || '';
                    
                    //Fill ngay sinh
                    const dobInput = formPersonalInfo.querySelector('input[name="date_of_birth"]');
                    if (pInfo.dateOfBirth) {
                        dobInput.value = pInfo.dateOfBirth.split('T')[0];
                    } else {
                        dobInput.value = '';
                    }

                    //Fill select
                    const genderSelect = formPersonalInfo.querySelector('select[name="gender"]');
                    if (genderSelect) genderSelect.value = pInfo.gender || '';
                    const provinceSelect = formPersonalInfo.querySelector('select[name="province"]');
                    const wardSelect = formPersonalInfo.querySelector('select[name="ward"]');   
                    if (provinceSelect && wardSelect) {
                        const userProvince = pInfo.province ?? "";
                        const userWard = pInfo.ward ?? "";
                        if (userProvince) {
                            provinceSelect.value = userProvince; 
                            if (provinceSelect.value) {
                                if (typeof loadWards === 'function') {
                                    loadWards(userProvince, wardSelect, userWard); 
                                }
                            }
                        }
                        provinceSelect.addEventListener('change', function() {
                            const selectedProvince = this.value; 
                            if (selectedProvince && typeof loadWards === 'function') {
                                loadWards(selectedProvince, wardSelect, null); 
                            } else {
                                wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                            }
                        });
                    }

                    //Avatar
                    const avatarPreview = document.getElementById('avatarPreview');
                    if (avatarPreview) {
                        avatarPreview.src = avatarUrl ? avatarUrl : '../../assets/admin/images/avatar.png'; 
                    }
                }
            }
            //permission
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

                //Xu ly danh sach quyen
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
            //comment
            else if (currentPage === 'comment') {
                const account = data.account || {};
                const username = account.username || 'Khách ẩn danh';
                document.getElementById('view-comment-username').textContent = username;
                document.getElementById('view-comment-avatar-text').textContent = username.charAt(0).toUpperCase();
                document.getElementById('view-comment-role').textContent = account.role === 'employee' ? 'Nhân viên' : 'Khách hàng';
                
                const avatarContainer = document.getElementById('view-comment-avatar-text');
                let avatarUrl = null;
                const urlParams = new URLSearchParams(window.location.search);
                avatarUrl = data.account?.user?.personalInfo?.profileUrl;
                if (avatarUrl) {
                    avatarContainer.innerHTML = `<img src="${avatarUrl}" alt="avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">`;
                } else {
                    avatarContainer.innerHTML = '';
                    avatarContainer.textContent = (data.username || 'A').charAt(0).toUpperCase();
                }
                document.getElementById('view-comment-id').textContent = data.id;
                document.getElementById('view-comment-account-id').textContent = account.id ? `${account.id}` : 'Không có';
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                document.getElementById('view-comment-date').textContent = formatDate(data.createdAt || data.created_at);
                const statusEl = document.getElementById('view-comment-status');
                if (data.deletedAt === null) {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Hiển thị</span>';
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Đã bị ẩn</span>';
                }
                document.getElementById('view-comment-content').textContent = data.content || 'Không có nội dung.';
            }
            //bill
            else if (currentPage === 'bill' && currentTable === '1') {
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                const formatCurrency = (amount) => {
                    if (!amount) return '0 VND';
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                };

                //Thong tin chung
                document.getElementById('view-invoice-id').textContent = data.id;
                document.getElementById('view-invoice-date').textContent = formatDate(data.createdAt);
                document.getElementById('view-invoice-points').textContent = `-${data.points || 0} Điểm`;

                //Status
                const statusEl = document.getElementById('view-invoice-status');
                if (data.status === 'completed') {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Thành công</span>';
                } else if (data.status === 'pending') {
                    statusEl.innerHTML = '<span class="badge-detail badge-warning" style="background-color: #FEF3C7; color: #D97706;">Đang xử lý</span>';
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Thất bại / Hủy</span>';
                }

                //Thong tin tai khoan
                const acc = data.account || {};
                document.getElementById('view-invoice-username').textContent = acc.username ? `${acc.username} (ID: ${acc.id})` : 'Khách vãng lai';
                document.getElementById('view-invoice-role').textContent = acc.role === 'employee' ? 'Nhân viên' : 'Khách hàng';

                //Thong tin bai dang
                const post = data.post || {};
                document.getElementById('view-invoice-post-id').textContent = post.id ? `${post.id}` : '---';
                document.getElementById('view-invoice-post-title').textContent = post.title || 'Bài đăng không tồn tại hoặc đã bị xóa';
                document.getElementById('view-invoice-post-price').textContent = formatCurrency(post.price);

                //Dia chi
                const addressParts = [post.houseNumber, post.ward, post.province].filter(Boolean);
                document.getElementById('view-invoice-post-address').textContent = addressParts.length > 0 ? addressParts.join(', ') : 'Chưa cập nhật địa chỉ';
            }
            //bill
            else if (currentPage === 'bill' && currentTable === '2') { 
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                const formatCurrency = (amount) => {
                    if (!amount) return '0 VND';
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                };

                //Thong tin chung
                document.getElementById('view-recharge-id').textContent = data.id;
                document.getElementById('view-recharge-date').textContent = formatDate(data.createdAt);

                //Xu ly trang thai
                const statusEl = document.getElementById('view-recharge-status');
                if (data.status === 'completed') {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Thành công</span>';
                } else if (data.status === 'pending') {
                    statusEl.innerHTML = '<span class="badge-detail badge-warning" style="background-color: #FEF3C7; color: #D97706;">Đang xử lý</span>';
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Thất bại</span>';
                }

                //Chi tiet thanh toan
                document.getElementById('view-recharge-money').textContent = formatCurrency(parseFloat(data.money));
                document.getElementById('view-recharge-vat').textContent = formatCurrency(parseFloat(data.vat));
                document.getElementById('view-recharge-total').textContent = formatCurrency(parseFloat(data.totalMoney));
                document.getElementById('view-recharge-points').textContent = `+${new Intl.NumberFormat('vi-VN').format(data.points)} Điểm`;

                //Thong tin nguoi nap
                const acc = data.account || {};
                document.getElementById('view-recharge-username').textContent = acc.username ? `${acc.username} (ID: ${acc.id})` : 'Không xác định';
                document.getElementById('view-recharge-role').textContent = acc.role === 'employee' ? 'Nhân viên' : 'Khách hàng';

                //Thong tin goi nap
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
            //price
            else if (currentPage === 'price' && currentTable === '1') {
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };

                //Thong tin co ban
                document.getElementById('view-pricing-id').textContent = data.id;
                document.getElementById('view-pricing-created').textContent = formatDate(data.createdAt);
                document.getElementById('view-pricing-points').textContent = `${data.points} Điểm`;

                //Xu ly trang thai
                const statusEl = document.getElementById('view-pricing-status');
                const deletedGroup = document.getElementById('view-pricing-deleted-group');

                if (data.deletedAt) {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Ngừng áp dụng (Đã xóa)</span>';
                    deletedGroup.style.display = 'block';
                    document.getElementById('view-pricing-deleted').textContent = formatDate(data.deletedAt);
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Đang áp dụng</span>';
                    deletedGroup.style.display = 'none';
                }
            }
            //price
            else if (currentPage === 'price' && currentTable === '2') {
                const formatDate = (dateString) => {
                    if (!dateString) return '--/--/----';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('vi-VN');
                };
                const formatCurrency = (amount) => {
                    if (!amount) return '0 đ';
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                };

                //Thong tin chung
                document.getElementById('view-exchange-id').textContent = data.id;
                document.getElementById('view-exchange-created').textContent = formatDate(data.createdAt);
                
                //Fill ti le quy doi
                document.getElementById('view-exchange-money').textContent = formatCurrency(parseFloat(data.money));
                document.getElementById('view-exchange-points').textContent = `+${new Intl.NumberFormat('vi-VN').format(data.points)} Điểm`;

                //Xu ly trang thai
                const statusEl = document.getElementById('view-exchange-status');
                const deletedGroup = document.getElementById('view-exchange-deleted-group');

                if (data.deletedAt) {
                    statusEl.innerHTML = '<span class="badge-detail badge-inactive" style="background-color: #FEE2E2; color: #DC2626;">Ngừng áp dụng (Cũ)</span>';
                    deletedGroup.style.display = 'block';
                    document.getElementById('view-exchange-deleted').textContent = formatDate(data.deletedAt);
                } else {
                    statusEl.innerHTML = '<span class="badge-detail badge-active" style="background-color: #D1FAE5; color: #059669;">Đang áp dụng</span>';
                    deletedGroup.style.display = 'none';
                }
            }
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
            const targetEndpoint = `posts/${postId}?include=postImages,user.account,payBills,employee.account`;
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
                const locationParts = [data.houseNumber, data.ward, data.province];
                const locationString = locationParts.filter(Boolean).join(", ");
                document.getElementById('detail-location').textContent = locationString;
                document.getElementById('detail-price').textContent = data.price + " VNĐ/ tháng";
                document.getElementById('detail-area').textContent = data.area + " m²";
                document.getElementById('detail-deposit').textContent = "Số tiền cọc: " + data.deposit;
                document.getElementById('room-type').textContent = "Kiểu phòng trọ: " + data.roomType;
                document.getElementById('occupants-data').textContent = "Số lượng người tối đa: " + data.maxOccupants;
                document.getElementById('occupants-data').textContent = "Số lượng người tối đa: " + data.maxOccupants;
                document.getElementById('detail-description').textContent = data.description;
                if (data.payBills) {
                    renderPaymentHistory(data.payBills);
                }
                if(data.reason){
                    document.getElementById('reason').textContent = "Lý do vi phạm: " + data.reason;
                }
                const baseUrl = "http://backend.test";
                const defaultImg = "../../assets/admin/images/post_img.png";

                //Lam moi 4 anh cho post sau
                const slots = ['main', 'sub_1', 'sub_2', 'sub_3'];
                slots.forEach(slot => {
                    const imgEl = document.getElementById(`img-${slot}`);
                    if (imgEl) imgEl.src = defaultImg;
                    
                    //Khoi phuc input an
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

                //Do du lieu anh
                if (data.postImages && data.postImages.length > 0) {
                    data.postImages.forEach((imgObj) => {
                        let order = parseInt(imgObj.order); 
                        let slotName = '';

                        if (order === 1) slotName = 'main';
                        else if (order === 2) slotName = 'sub_1';
                        else if (order === 3) slotName = 'sub_2';
                        else if (order === 4) slotName = 'sub_3';

                        if (slotName) {
                            const imgEl = document.getElementById(`img-${slotName}`);
                            const wrapper = document.querySelector(`.image-slot[data-slot="${slotName}"]`);
                            const fullUrl = baseUrl + imgObj.imagePostUrl;

                            //Hien thi anh tren giao dien
                            if (imgEl) imgEl.src = fullUrl;

                            //Gan URL vao input de submit len backend
                            if (wrapper) {
                                let hiddenInput = wrapper.querySelector('input[type="hidden"]');
                                if (hiddenInput) {
                                    hiddenInput.value = imgObj.imagePostUrl; 
                                }
                            }
                        }
                    });
                }

                document.getElementById('detail-user-id').textContent = "Tài khoản đăng bài: " + (data.user?.account?.username || 'Trống');
                document.getElementById('detail-employee-id').textContent = "Tài khoản nhân viên duyệt: " + (data.employee?.account?.username || 'Trống');
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

        const textFields = ['id', 'title', 'price', 'deposit', 'area', 'maxOccupants', 'description', 'roomType', 'houseNumber'];
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
            const elements = form.querySelectorAll('input, select, textarea');
            elements.forEach(el => {
                if (typeof Validator !== 'undefined') {
                    Validator.clearError(el);
                }
            });
        }
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
        if (postImages && postImages.length > 0) {
            postImages.forEach(imgObj => {
                let order = parseInt(imgObj.order);
                let slotName = '';

                if (order === 1) slotName = 'main';
                else if (order === 2) slotName = 'sub_1';
                else if (order === 3) slotName = 'sub_2';
                else if (order === 4) slotName = 'sub_3';

                if (slotName) {
                    const imgEl = document.getElementById(`img-${slotName}`);
                    const wrapper = document.querySelector(`.image-slot[data-slot="${slotName}"]`);
                    const fullUrl = baseUrl + imgObj.imagePostUrl; 
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
        const item = element.closest('.accordion-item');
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
    async function revokeRoleFromAccount(event, accountId, roleNameToRemove, encodedRoles, targetModel, roleId) {
        event.stopPropagation();
        
        let currentRoles = [];
        try {
            currentRoles = JSON.parse(decodeURIComponent(encodedRoles));
        } catch (e) {
            currentRoles = [];
        }

        const isConfirmed = await showConfirm(
            "Cảnh báo xóa", 
            `Xác nhận tước quyền [${roleNameToRemove}]?`, 
            true 
        );
        if (!isConfirmed) {
            return;
        }

        // 1. Lọc mảng (Nếu tước hết, remainingRoles sẽ là [])
        let remainingRoles = currentRoles.filter(role => role !== roleNameToRemove);

        // 2. Tạo Object thuần túy (KHÔNG dùng new FormData)
        const payload = {
            _method: 'PUT',
            roles: remainingRoles,
            target_endpoint: `accounts/${accountId}`
        };

        const apiUrl = `../admin/core/api_proxy.php`;

        // 3. Gửi Fetch với Content-Type: application/json
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(payload)
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
    async function renderMonthlyPostChart(year) {
        try {
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
            const currentFilterWard = "<?php echo htmlspecialchars($_GET['ward'] ?? ''); ?>";

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
    function handleApplyFilter(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const url = new URL(window.location.href);

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
        setOrDeleteParam('filter[roomType]', formData.get('room_type'));

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
    function handleViewReason(event, fullReasonString, postId) {
        event.stopPropagation();
        const reasonDisplayEl = document.getElementById('reason-display-' + postId);
        
        if (reasonDisplayEl) {
            if (reasonDisplayEl.tagName === 'INPUT' || reasonDisplayEl.tagName === 'TEXTAREA') {
                reasonDisplayEl.value = fullReasonString;
            } else {
                reasonDisplayEl.innerText = fullReasonString;
            }
        }
        openModal('modal-xem-ly-do-' + postId);
    }
    function handleSaveSettings(event, id) {
        event.preventDefault();
        const formElement = event.target.closest('#panel-info');

        if (!formElement) {
            return;
        }

        //Valid
        const avatarInput = formElement.querySelector('input[type="file"].upload-avatar-input');
        const nameInput = formElement.querySelector('input[name="name"]');
        const phoneInput = formElement.querySelector('input[name="phone_number"]');
        const addressInput = formElement.querySelector('input[name="house_number"]');
        const provinceSelect = formElement.querySelector('select[name="province"]');
        const wardSelect = formElement.querySelector('select[name="ward"]');
        const pidInput = formElement.querySelector('input[name="pid"]');
        const genderSelect = formElement.querySelector('select[name="gender"]');
        const dobInput = formElement.querySelector('input[name="date_of_birth"]');

        //Xoa loi
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

        if (!isValid) return; 

        let formData = new FormData(); 
        const inputElements = formElement.querySelectorAll('input[name], select[name]');
        
        // 3. Lắp dữ liệu vào hộp
        inputElements.forEach(input => {
            formData.append(input.name, input.value);
        });

        if (avatarInput && avatarInput.files.length > 0) {
            formData.append('profile_url', avatarInput.files[0]); 
        }

        formData.append('_method', 'PUT'); 
        formData.append('target_endpoint', `personalInfos/${id}`);

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
            showToast({
                title: "Thành công!",
                message: "Cập nhật thông tin thành công.",
                type: "success",
                duration: 2000
            });
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        })
        .catch(error => {
            console.error("Lỗi cập nhật:", error);
            if (error.message && error.message.includes("The email has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Email này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            if (error.message && error.message.includes("The phone number has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Số điện thoại này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            if (error.message && error.message.includes("The pid has already been taken.")) {
                showToast({
                    title: "Cảnh báo!",
                    message: "Số căn cước này đã được sử dụng.",
                    type: "warning",
                    duration: 4000
                });
                return;
            }
            showToast({
                title: "Lỗi hệ thống",
                message: "Không thể kết nối đến máy chủ.",
                type: "error",
                duration: 4000
            });
        });
    }
    //Avatar
    document.addEventListener('change', function(event) {
        if (event.target && event.target.classList.contains('upload-avatar-input')) {
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = event.target.closest('.avatar-edit-section');
                    if (wrapper) {
                        const previewImg = wrapper.querySelector('.avatar-preview');
                        if (previewImg) previewImg.src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    });
</script>
</html>