<?php
  include(__DIR__ . "/core/config.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/reset.css" ?>'/>
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/main.css" ?>'/>
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/history.css" ?>'/>

    <link
      rel="icon"
      type="image/png"
      href='<?php echo BASE_URL . "/assets/favicon/favicon-96x96.png"?>'
      sizes="96x96"
    />
    <link
      rel="icon"
      type="image/svg+xml"
      href='<?php echo BASE_URL . "/assets/favicon/favicon.svg"?>'
    />
    <link rel="shortcut icon" href='<?php echo BASE_URL . "/assets/favicon/favicon.ico"?>' />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href='<?php echo BASE_URL . "/assets/favicon/apple-touch-icon.png"?>'
    />
    <link rel="manifest" href='<?php echo BASE_URL . "/assets/favicon/site.webmanifest" ?>'/>
    <title>History Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
    
    <div class="history-block">
        <div class="history">
            <div class="user-profile">
                <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

                <div class="user-profile-info">
                    <div class="user-name">Po Pici</div>

                    <div class="user-point-section">
                        <div class="user-point-info">
                        Điểm

                        <div class="user-point-value">
                            100.000

                            <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point.png" class="user-point-img">
                        </div>
                        </div>

                        <a href='<?php echo BASE_URL . "/pages/client/recharge.php"?>'" class="user-point-btn">Nạp ngay</a>
                    </div>
                </div>
            </div>

            <h3 class="history-title">Lịch sử giao dịch</h3>

            <div class="history-line"></div>

            <div class="history-tab">
                <div class="history-recharge history-selected">
                    <img src='<?php echo BASE_URL . "/assets/img/recharge-ico.png"?>' alt="recharge-ico.png" class="history-recharge-ico">

                    Lịch sử nạp
                </div>

                <div class="history-pay">
                    <img src='<?php echo BASE_URL . "/assets/img/pay-ico.png"?>' alt="pay-ico.png" class="history-pay-ico">

                    Lịch sử trừ
                </div>
            </div>

            <div class="history-board">
                <h3 class="history-board-title">Lịch sử nạp</h3>

                <div class="notify-list">
                    <!-- an example item -->
                    <a href="" class="notify-item notify-item-unread">
                        <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                        <div class="notify-content">
                        <div class="notify-info">Căn nhà giá 5 tỷ, đường Trương Phước Phan, phường Bình Trị Đông, quận Bình Tân</div>

                        <!-- using for transaction -->
                        <div class="notify-value"></div>

                        <div class="notify-time">01/01/2026</div>
                        </div>
                    </a>

                    <a href="" class="notify-item">
                        <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                        <div class="notify-content">
                        <div class="notify-info">Thêm điểm vào tài khoản thành công</div>

                        <!-- using for transaction -->
                        <div class="notify-value value-add">+999 Điểm ( Nạp thêm điểm thành công )</div>

                        <div class="notify-time">01/01/2026</div>
                        </div>
                    </a>

                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <a href="" class="notify-item">
                        <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                        <div class="notify-content">
                        <div class="notify-info">Thêm điểm vào tài khoản thành công</div>

                        <!-- using for transaction -->
                        <div class="notify-value value-subtract">-100 Điểm ( Phí sử dụng dịch vụ )</div>

                        <div class="notify-time">01/01/2026</div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
</html>