<?php 
    $titleData = ['titleContent' => "Tổng quan", 'group' => true]
?>

<div class="overview-page">
    <?php include __DIR__ . "/../components/header.php" ?>

    <?php renderComponent("title",false,$titleData) ?> 

    <div class="thongke">
        <div class="data">
            <div class="title">
                <p class="content">Thống kê bài đăng trong tháng</p>
                <input type="number" placeholder="Nhập vào năm (VD:2005)">
            </div>

            <div class="chart">

            </div>
        </div>
    </div>

    <?php renderComponent("table",false) ?>
</div>