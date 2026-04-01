<?php 
    $bills = $bills ?? [];
    $paginationMeta = $paginationMeta ?? [];
    $currentTable = $_GET['table'] ?? "1";
    $titleData = ['titleContent' => "Hóa đơn", 'group' => false, 'insert' => false, 'edit' => false, 'delete' => false, 'handle' => true];
    $tableHeader = ['ID', 'ID tài khoản', 'ID bài đăng', 'Điểm', 'Thời gian', 'Tình trạng', 'Chi tiết'];
    $tableHeader1 = ['ID', 'ID tài khoản', 'Số tiền', 'Thời gian', 'Tình trạng', 'Chi tiết'];
    $type = ['type' => "1"];
    ob_start(); 
    if(empty($bills)){
        echo '<tr><td colspan="5" style="text-align:center;">Không có dữ liệu hoặc lỗi kết nối máy chủ</td></tr>';
    }else{
        foreach ($bills as $bill){
    ?>
        <tr onclick="selectRow(this)" style="cursor: pointer;">
            <td style="display: none;">
                <input type="radio" name="selectedRow" value="<?php echo $bill['id']; ?>">
            </td>
            <td><?php echo ($bill['id']); ?></td>
            <td><?php echo ($bill['account']['id']); ?></td>
            <?php if(isset($bill['totalMoney'])) echo "<td>" . ($bill['totalMoney']) . "</td>"; ?>
            <?php if(isset($bill['post'])) echo "<td>" . ($bill['post']['id']) . "</td>"; ?>
            <?php if(isset($bill['points'])) echo "<td>" . ($bill['points']) . "</td>"; ?>
            <td><?php echo date('d/m/Y', strtotime($bill['createdAt'])); ?></td>
            <td>
                <?php if ($bill['status'] === 'completed'): ?>
                    <span class="badge badge-success">Đang hoạt động</span>
                <?php elseif ($bill['status'] === 'failed'): ?>
                    <span class="badge badge-danger">Dừng hoạt động</span>
                <?php else: ?>
                    <span class="badge badge-warning">Đang chờ</span>
                <?php endif; ?>
            </td>
            <td>
                <button class="table-btn" title="Xem chi tiết">
                    <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 1C0 0.734784 0.105357 0.48043 0.292893 0.292893C0.48043 0.105357 0.734784 0 1 0H19C19.2652 0 19.5196 0.105357 19.7071 0.292893C19.8946 0.48043 20 0.734784 20 1C20 1.26522 19.8946 1.51957 19.7071 1.70711C19.5196 1.89464 19.2652 2 19 2H1C0.734784 2 0.48043 1.89464 0.292893 1.70711C0.105357 1.51957 0 1.26522 0 1ZM0 5C0 4.73478 0.105357 4.48043 0.292893 4.29289C0.48043 4.10536 0.734784 4 1 4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8946 4.48043 20 4.73478 20 5C20 5.26522 19.8946 5.51957 19.7071 5.70711C19.5196 5.89464 19.2652 6 19 6H1C0.734784 6 0.48043 5.89464 0.292893 5.70711C0.105357 5.51957 0 5.26522 0 5ZM1 8C0.734784 8 0.48043 8.10536 0.292893 8.29289C0.105357 8.48043 0 8.73478 0 9C0 9.26522 0.105357 9.51957 0.292893 9.70711C0.48043 9.89464 0.734784 10 1 10H13C13.2652 10 13.5196 9.89464 13.7071 9.70711C13.8946 9.51957 14 9.26522 14 9C14 8.73478 13.8946 8.48043 13.7071 8.29289C13.5196 8.10536 13.2652 8 13 8H1Z" fill="currentColor"/>
                    </svg>
                </button>
            </td>
        </tr>
    <?php 
        }
    } 
    $tbodyHtml = ob_get_clean();

    $tableData = ['tableTitle' =>"Thông tin hóa đơn thanh toán", 'tableHeader' => $tableHeader, 'time' => true, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
    $tableData1 = ['tableTitle' =>"Thông tin hóa đơn nạp tiền", 'tableHeader' => $tableHeader1, 'time' => true, 'status' => true, 'tbodyHtml' => $tbodyHtml, 'paginationMeta' => $paginationMeta];
?>

<div class="bill-page">
    <?php include __DIR__ . "/../components/header.php" ?>
    <?php renderComponent("title",false,$titleData) ?> 
    <div class="sb">
        <?php renderComponent("searchbar",false,$type) ?>
        <div class="line"></div>
        <div class="tab-pane">
            <a href="index.php?page=bill&table=1" class="item <?php echo ($currentTable === '1') ? 'active' : ''; ?>">HÓA ĐƠN THANH TOÁN</a>
            <a href="index.php?page=bill&table=2" class="item <?php echo ($currentTable === '2') ? 'active' : ''; ?>">HÓA ĐƠN NẠP TIỀN</a>
        </div>
    </div>
    <?php if($currentTable === '1'){
        renderComponent("table",false,$tableData);
    }else if($currentTable === '2'){
        renderComponent("table",false,$tableData1);
    } ?>
    <?php renderComponent("pagination",false,['paginationMeta' => $paginationMeta]) ?>
</div>