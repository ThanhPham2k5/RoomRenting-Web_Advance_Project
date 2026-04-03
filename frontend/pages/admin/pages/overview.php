<?php 
    $titleData = ['titleContent' => "Tổng quan", 'group' => true, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => false];
?>

<div class="overview-page">
    <?php include __DIR__ . "/../components/header.php" ?>

    <?php renderComponent("title",false,$titleData) ?> 

    <div class="dashboard-grid">
        
        <div class="thongke">
            <div class="data">
                <div class="title">
                    <p class="content">Thống kê bài đăng theo tháng</p>
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
                </div>
                <div class="chart">
                    <canvas id="chart3"></canvas> 
                </div>
            </div>
        </div>

        <div class="thongke">
            <div class="data">
                <div class="title">
                    <p class="content">Thống kê doanh thu</p>
                </div>
                <div class="chart">
                    <canvas id="chart4"></canvas> 
                </div>
            </div>
        </div>
    </div>
</div>