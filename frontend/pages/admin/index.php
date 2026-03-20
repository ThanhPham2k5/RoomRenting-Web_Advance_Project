<?php
require_once __DIR__ . '/core/function.php';
$pageData = [];
$page = $_GET['page'] ?? 'overview';
$validPage = ['overview', 'account', 'bill', 'comment', 'permission', 'post', 'price', 'sale'];
$currentTable = $_GET['table'] ?? "1";

if(!in_array($page, $validPage)){
    $page = "overview";
}
switch ($page) {
    case 'account':
        $pageNum = $_GET['p'] ?? 1;
        $apiResult = call_api("http://127.0.0.1:8000/api/accounts?per_page=1&page={$pageNum}");
        $pageData['accounts'] = $apiResult['data'] ?? [];
        $pageData['paginationMeta'] = [
            'current_page' => $apiResult['meta']['current_page'] ?? 1,
            'last_page'    => $apiResult['meta']['last_page'] ?? 1,
            'base_url'     => "index.php?page=account&table={$currentTable}" 
        ];
        break;
}

if ($page === 'account' && isset($_GET['action']) && $_GET['action'] === 'edit') {
    $editId = $_GET['id'];
    $accountEditData = call_api("http://127.0.0.1:8000/api/accounts/{$editId}");
    $pageData['accountEditData'] = $accountEditData['data'];
    $pageData['autoOpenEditForm'] = true; 
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
<script>
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
    async function loadAccountsIntoTable() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/accounts?per_page=all');
            const result = await response.json();

            if (result.success === true) {
                const accounts = result.data;
            }
        } catch (error) {
            console.error("Lỗi khi tải danh sách:", error);
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        const tableAccounts = document.getElementById('table-<?php echo $page ?>');
        if (tableAccounts) {
            loadAccountsIntoTable();
        }
        const canvasElement = document.getElementById('postsLineChart');
        if (canvasElement) {
            drawHardcodedLineChart();
        }
    });
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
    function handleEdit() {
        const selectedRadio = document.querySelector('input[name="selectedRow"]:checked');
        if (!selectedRadio) {
            alert("Vui lòng chọn dòng dữ liệu để sửa!"); return;
        }
        window.location.href = `index.php?page=<?php echo $page ?>&table=<?php echo $currentTable ?>&action=edit&id=${selectedRadio.value}`;
    }
    function handleSearch() {
        const keyword = document.getElementById('searchInput').value.toLowerCase().trim();
        const allRows = document.querySelectorAll('.admin-table tbody tr');
        allRows.forEach(row => {
            const textInRow = row.textContent.toLowerCase();
            if (textInRow.includes(keyword)) {
                row.style.display = ''; 
            } 
            else {
                row.style.display = 'none'; 
                
                if (row.classList.contains('row-active')) {
                    row.classList.remove('row-active');
                    const radio = row.querySelector('input[type="radio"]');
                    if (radio) radio.checked = false;
                }
            }
        });
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