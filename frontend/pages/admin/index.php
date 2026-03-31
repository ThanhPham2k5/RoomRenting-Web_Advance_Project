<?php
require_once __DIR__ . '/core/function.php';
$filterQuery = '';
if (isset($_GET['filter'])) {
    $filterQuery = '&' . http_build_query(['filter' => $_GET['filter']]);
}
$pageData = [];
$page = $_GET['page'] ?? 'overview';
$validPage = ['overview', 'account', 'bill', 'comment', 'permission', 'post', 'price', 'setting'];
$currentTable = $_GET['table'] ?? '1';
$pageNum = $_GET['p'] ?? 1;

if(!in_array($page, $validPage)){
    $page = "overview";
}
switch ($page) {
    case 'account':
        $apiRole = ($currentTable === '1') ? 'user' : 'employee';
        $apiResult = call_api("http://127.0.0.1:8000/api/accounts?per_page=4&page={$pageNum}&filter[role]={$apiRole}" . $filterQuery);
        $pageData['accounts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=account&table={$currentTable}"
        ];
        break;
    case 'comment':
        $apiResult = call_api("http://127.0.0.1:8000/api/comments?per_page=4&page={$pageNum}&include=account" . $filterQuery);
        $pageData['comments'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=comment&table={$currentTable}" 
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
        $apiResult = call_api("http://127.0.0.1:8000/api/posts?per_page=8&page={$pageNum}&include=postImages&filter[status]={$apiSt}");
        $pageData['posts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=post&table={$currentTable}" 
        ];
        break;
    case 'price':
        $apiType = match($currentTable) {
            '1' => 'payRules',
            '2' => 'rechargeRules',
            default => 'payRules'
        };
        $apiResult = call_api("http://127.0.0.1:8000/api/{$apiType}?per_page=4&page={$pageNum}");
        $pageData['rules'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=price&table={$currentTable}" 
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
        $apiResult = call_api("http://127.0.0.1:8000/api/{$apiType}?per_page=4&page={$pageNum}&include={$apiInclude}");
        $pageData['bills'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=bill&table={$currentTable}" 
        ];
        break;
    case 'permission':
        $apiResult = call_api("http://127.0.0.1:8000/api/roles?per_page=4&page={$pageNum}");
        $pageData['permissions'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=permission&table={$currentTable}" 
        ];
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
        <?php renderComponent("postdetail",false) ?>
        <div class="main-page">
            <?php
            renderComponent($page, true, $pageData);
            ?>
        </div>
    </div>
</body>
<script>
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
        const canvasElement = document.getElementById('postsLineChart');
        if (canvasElement) {
            drawHardcodedLineChart();
        }

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
    const apiConfigs = {
        'account': { 
            endpoint: 'accounts', 
            query: '?include=roles'
        },
        'post': { 
            endpoint: 'posts'
        }
    };
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
        const apiUrl = `http://127.0.0.1:8000/api/${config.endpoint}/${id}${config.query}`;
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer 1|doBptP22fIl2zcgGI4I92REMuVhYXRJlyOt2Aa987a263743"
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
        const apiUrl = `http://127.0.0.1:8000/api/${config.endpoint}/${id}`; 
        fetch(apiUrl, {
            method: 'DELETE',
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer 1|doBptP22fIl2zcgGI4I92REMuVhYXRJlyOt2Aa987a263743"
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.message) {
                alert("Xóa thành công!");
                window.location.reload();
            } else {
                return result.json().then(err => { throw err; });
            }
        })
        .catch(error => {
            console.error("Lỗi xóa:", error);
            alert(error.message || "Có lỗi xảy ra! Không thể xóa dữ liệu này.");
        });
    }
    function handleView(targetModel) {
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page');
        const config = apiConfigs[currentPage];
        const apiUrl = `http://127.0.0.1:8000/api/${config.endpoint}/7${config.query}`;

        fetch(apiUrl, {
            method: 'GET',
            headers: {
                "Accept": "application/json",
                "Authorization": "Bearer 1|doBptP22fIl2zcgGI4I92REMuVhYXRJlyOt2Aa987a263743"
            }
        })
        .then(response => response.json())
        .then(result => {
            const data = result.data;
            document.getElementById('view-username').textContent = data.username || 'Không xác định';
            document.getElementById('view-avatar-text').textContent = (data.username || 'A').charAt(0);
            document.getElementById('view-role').textContent = data.role === 'employee' ? 'Nhân viên' : 'Khách hàng';
            
            // Cập nhật Grid Thông tin
            document.getElementById('view-id').textContent = data.id;
            
            // Trạng thái (Phân loại màu nhãn)
            const statusEl = document.getElementById('view-status');
            if (data.deletedAt === null) {
                statusEl.innerHTML = '<span class="badge-detail badge-active">Đang hoạt động</span>';
            } else {
                statusEl.innerHTML = '<span class="badge-detail badge-inactive">Đã khóa / Xóa</span>';
            }

            // Lấy thông tin cá nhân (An toàn với Optional Chaining)
            const profileInfo = data.employee || data.user;
            document.getElementById('view-phone').textContent = profileInfo?.personalInfo?.phoneNumber || 'Chưa cập nhật';
            document.getElementById('view-email').textContent = profileInfo?.personalInfo?.email || 'Chưa cập nhật';

            // Cập nhật danh sách quyền (Roles)
            const rolesContainer = document.getElementById('view-roles-container');
            rolesContainer.innerHTML = ''; // Xóa dữ liệu cũ
            
            if (data.roles && data.roles.length > 0) {
                data.roles.forEach(role => {
                    const badge = document.createElement('span');
                    badge.className = 'badge-detail badge-permission';
                    badge.textContent = role; // Hoặc role.name tùy cấu trúc API trả về
                    rolesContainer.appendChild(badge);
                });
            } else {
                rolesContainer.innerHTML = '<span class="info-value" style="font-style: italic; color: #999;">Không có quyền đặc biệt</span>';
            }

            // Mở Modal
            openModal(targetModel);
        })
        .catch(error => {
            alert("Lỗi tải chi tiết!");
            console.error(error);
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
            fetch(`http://127.0.0.1:8000/api/posts/${postId}?include=postImages,user,employee`, {
                method: 'GET',
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer 1|doBptP22fIl2zcgGI4I92REMuVhYXRJlyOt2Aa987a263743"
                }
            })
            .then(response => response.json())
            .then(result => {
                const data = result.data;
                document.getElementById('detail-id').textContent = "ID bài đăng: " + data.id;
                document.getElementById('detail-title').textContent = data.title;
                const locationParts = [data.ward, data.province];
                const locationString = locationParts.filter(Boolean).join(", ");
                document.getElementById('detail-location').textContent = locationString;
                document.getElementById('detail-price').textContent = data.price + " VNĐ/ tháng";
                document.getElementById('detail-area').textContent = data.area + " m²";
                document.getElementById('detail-deposit').textContent = "Số tiền cọc: " + data.deposit;
                document.getElementById('detail-description').textContent = data.description;
                if (data.postImages) {
                    document.getElementById('detail-main-img').src = "http://127.0.0.1:8000" + data.postImages[0].imagePostUrl;
                }

                document.getElementById('detail-user-id').textContent = "ID người đăng bài: " + (data.user.id || 'Trống');
                document.getElementById('detail-employee-id').textContent = "ID nhân viên duyệt: " + (data.employee.id || 'Chưa có');
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
    }
    function switchToView() {
        const modal = document.getElementById('post-detail-modal');
        modal.classList.remove('edit-mode');
        modal.classList.add('view-mode');
    }
    function closePostDetail() {
        const modal = document.getElementById('post-detail-modal');
        if (modal) {
            modal.style.display = 'none';
            switchToView();
        }
    }
    function drawHardcodedLineChart() {
        // Mảng Trục X: 12 tháng trong năm
        const labels = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 
            'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 
            'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];
        
        // Mảng Trục Y: Số bài đăng trong tháng đó (bạn có thể đổi số tùy ý)
        const postCountData = [12,19,5,2,30,45,25,10,22,15,28];

        // 3. Khởi tạo và vẽ biểu đồ đường
        const ctx = document.getElementById('postsLineChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // Chọn loại biểu đồ là ĐƯỜNG
            data: {
                labels: labels, // Trục X
                datasets: [{
                    label: 'Số bài đăng', // Tiêu đề của đường
                    data: postCountData,  // Dữ liệu thô (Trục Y)
                    
                    // Cấu hình làm đẹp cho đường
                    fill: false,                // Không tô màu phần phía dưới đường (để làm Line Chart chuẩn)
                    borderColor: '#4BC0C0',     // Màu xanh ngọc cho đường
                    backgroundColor: '#4BC0C0', // Màu xanh ngọc cho các điểm nút
                    tension: 0.3,               // Độ cong của đường (0 là đường thẳng, >0 là đường cong mượt)
                    borderWidth: 2,             // Độ dày của đường
                    pointRadius: 4,             // Kích thước của các điểm nút
                    pointHoverRadius: 7         // Kích thước của các điểm nút khi rê chuột vào
                }]
            },
            options: {
                responsive: true, // Tự động co dãn theo màn hình
                plugins: {
                    title: {
                        display: true,
                        text: 'Thống kê bài đăng năm 2024 (Dữ liệu mẫu)', // Tiêu đề biểu đồ
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        enabled: true // Hiện tooltip khi rê chuột vào
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Tháng' // Tiêu đề cho trục X
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Số bài đăng' // Tiêu đề cho trục Y
                        },
                        beginAtZero: true // Luôn bắt đầu trục Y từ số 0
                    }
                }
            }
        });
    }
</script>
</html>