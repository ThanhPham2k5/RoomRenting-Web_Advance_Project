<?php 
    $apiRole = call_api("http://backend.test/api/address/provinces");
    $provinces= $apiRole['data'] ?? [];
    $titleData = ['titleContent' => "", 'group' => true, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => false];
?>

<div class="overview-page">
    <?php include __DIR__ . "/../components/header.php" ?>

    <?php renderComponent("title",false,$titleData) ?> 

    <div class="dashboard-grid">
        
        <div class="thongke">
            <div class="data">
                <div class="title">
                    <p class="content">Thống kê bài đăng theo tháng</p>
                    <input type="number" id="yearInput" placeholder="Nhập năm..." value="<?php echo date('Y'); ?>" min="2000" max="2100">
                </div>
                <div class="chart">
                    <canvas id="chart1"></canvas> 
                </div>
            </div>
        </div>

        <div class="thongke">
            <div class="data">
                <div class="title">
                    <p class="content">Thống kê bài đăng theo kiểu phòng</p>
                </div>
                <div class="chart">
                    <canvas id="chart2"></canvas> 
                </div>
            </div>
        </div>

        <div class="thongke">
            <div class="data">
                <div class="title">
                    <p class="content">Thống kê top 10 bài đăng khu vực</p>
                    <select id="provinceChartSelect">
                        <option value="">Tất cả tỉnh thành</option>
                        <?php 
                        if (!empty($provinces)) {
                            foreach ($provinces as $province) {
                                $provName = htmlspecialchars($province['name'] ?? '');
                                echo '<option value="' . $province['provinceCode'] . '">' . $provName . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="chart">
                    <canvas id="chart3"></canvas> 
                </div>
            </div>
        </div>

        <div class="thongke">
            <div class="data revenue-card">
                <div class="title">
                    <p class="content">Thống kê doanh thu</p>
                    <div class="revenue-filters">
                        <input class="chart4input" type="number" id="revYearSelect" value="<?php echo date('Y'); ?>" placeholder="Năm..." min="2000" max="2100">
                        <span style="color: #94A3B8; font-weight: 500;">so với</span>
                        <input class="chart4input" type="number" id="revCompareSelect" value="<?php echo date('Y') - 1; ?>" placeholder="Năm (Tùy chọn)" min="2000" max="2100">
                    </div>
                </div>
                
                <div class="revenue-kpi">
                    <div class="kpi-amount" id="kpiTotalRevenue">0 đ</div>
                    <div class="kpi-badge" id="kpiTrendBadge" style="display: none;"></div>
                </div>

                <div class="chart">
                    <canvas id="chart4"></canvas> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Vẽ biểu đồ và load dữ liệu
    loadDashboardSummary();
    const yearInput = document.getElementById('yearInput');
    if (yearInput) {
        // 1. Vẽ biểu đồ lần đầu tiên lúc vừa vào trang (Lấy năm mặc định trong input)
        renderMonthlyPostChart(yearInput.value);

        // 2. Lắng nghe sự kiện khi người dùng thay đổi số năm
        yearInput.addEventListener('change', function() {
            const selectedYear = this.value;
            // Chỉ vẽ lại nếu năm hợp lệ (có 4 chữ số)
            if (selectedYear && selectedYear.length === 4) {
                renderMonthlyPostChart(selectedYear);
            }
        });
    }
    renderRoomChart();
    const provinceSelect = document.getElementById('provinceChartSelect');
    if (provinceSelect) {
        
        // 1. Load lần đầu (Tham số sẽ là '' -> Render ra Tỉnh/Thành)
        renderRegionChart(provinceSelect.value);

        // 2. Bắt sự kiện chuyển đổi
        provinceSelect.addEventListener('change', function() {
            renderRegionChart(this.value); // Rẽ nhánh Tỉnh hoặc Phường tùy value
        });
        
    }
    const revYearSelect = document.getElementById('revYearSelect');
    const revCompareSelect = document.getElementById('revCompareSelect');

    if (revYearSelect && revCompareSelect) {
        
        const updateRevenueChart = () => {
            const year = revYearSelect.value.trim();
            const compareYear = revCompareSelect.value.trim();
            
            // 1. Chặn gọi API nếu đang gõ dở (có nhập nhưng chưa đủ 4 số)
            if (year.length > 0 && year.length !== 4) return;
            if (compareYear.length > 0 && compareYear.length !== 4) return;

            // 2. Chặn lỗi logic: Năm so sánh trùng với năm hiện tại
            if (year !== '' && year === compareYear) {
                alert("Năm so sánh không được trùng với năm hiện tại!");
                revCompareSelect.value = ""; // Reset ô so sánh
                renderRevenueChart(year, "");
                return;
            }

            // 3. Nếu gõ đúng 4 số thì mới vẽ biểu đồ
            if (year.length === 4) {
                renderRevenueChart(year, compareYear);
            }
        };

        // Vẽ lần đầu tiên
        updateRevenueChart();

        // Dùng sự kiện 'input' để bắt theo thời gian thực (vừa gõ xong số thứ 4 là chạy ngay)
        revYearSelect.addEventListener('input', updateRevenueChart);
        revCompareSelect.addEventListener('input', updateRevenueChart);
    }
});
async function loadDashboardSummary() {
    try {
        const response = await fetch('../admin/core/api_proxy.php?target_endpoint=statistic/summary');
        const data = await response.json();

        // 1. Đổ dữ liệu User
        document.getElementById('kpi-users-total').textContent = data.users.total.toLocaleString();
        updateTrendElement('kpi-users-trend', data.users.trend);

        // 2. Đổ dữ liệu Post
        document.getElementById('kpi-posts-total').textContent = data.active_posts.total.toLocaleString();
        updateTrendElement('kpi-posts-trend', data.active_posts.trend);

        // 3. Đổ dữ liệu Doanh thu (Dùng lại hàm formatVND ở trên)
        document.getElementById('kpi-revenue-total').textContent = formatVND(data.revenue.total);
        updateTrendElement('kpi-revenue-trend', data.revenue.trend);

        // 4. Đổ dữ liệu Tin chờ duyệt
        document.getElementById('kpi-pending-total').textContent = data.pending_posts.total;
        
    } catch (error) {
        console.error("Lỗi load summary:", error);
    }
}

// Hàm phụ trợ để đổi màu text và đổi Icon (lên/xuống) dựa vào số %
function updateTrendElement(elementId, trendValue) {
    const el = document.getElementById(elementId);
    if (!el) return;

    if (trendValue > 0) {
        el.className = 'trend positive';
        el.innerHTML = `<span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg> +${trendValue}%</span> so với tháng trước`;
    } else if (trendValue < 0) {
        el.className = 'trend negative';
        el.innerHTML = `<span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                        -1.5% ${trendValue}%</span> so với tháng trước`;
    } else {
        el.className = 'trend';
        el.innerHTML = `<span style="color:#64748B;">Không đổi</span> so với tháng trước`;
    }
}
</script>