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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/detail-post.css" ?>'/>

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
    <title>Detail Post Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="content">
        <div class="content-left">
            <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img">

            <div class="left-img-list">
                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img-1">

                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img-2">

                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img-3">
            </div>

            <div class="left-title">
                <h2 class="left-main-text">Phòng giá 5 tỷ/ tháng, đường Trương Phước Phan, phường Bình Trị Đông, quận Bình Tân</h2>

                <img src='<?php echo BASE_URL . "/assets/img/favour.png" ?>' alt="favourite.png" class="left-favourite">
            </div>

            <div class="left-address">
                <img src='<?php echo BASE_URL . "/assets/img/address.png"?>' alt="left-address-ico.png" class="left-address-ico">

                <div class="left-address-text">Phường Bình Trị Đông, Tp Hồ Chí Minh</div>
            </div>

            <div class="left-info">
                <h3 class="left-info-money">5 tỷ/tháng</h3>

                <div class="left-info-square">57,5m2</div>
            </div>

            <h3 class="left-deposit">Số tiến cọc: 3 tỷ</h3>

            <div class="left-desc">
                <h3>Mô tả chi tiết</h3>

                <div class="left-desc-info">Địa chỉ: Đường Tân Nhất 13 , Phường Tân Thới Nhất , Quận 12. Phòng ngay trục đường Trường Chinh QUẬN 12 , thuận tiện di chuyển qua Tân Bình , Gv, ...Cách trường HUFLIT Hốc Môn 4km. Cổng vân tay, camera an ninh. Giờ giấc tự do, không chung chủ. Có Thang máy và Sân Thượng.</div>
            </div>

            <div class="left-map">
                <h3>Xem trên bản đồ</h3>

                <div class="left-map-api">
                    <!-- place map api here -->
                     <img src='<?php echo BASE_URL . "/assets/img/map-api.png"?>' alt="map.png" class="left-map-img">
                </div>
            </div>
        </div>

        <div class="content-right">
            <div class="right-owner">
                <div class="owner-info">
                    <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="owner-avatar.png" class="owner-avatar">

                    <div class="owner-name">Popici</div>
                </div>

                <button type="button" class="owner-phone">
                    <img src='<?php echo BASE_URL . "/assets/img/phone-ico.png"?>' alt="phone-ico.png" class="phone-ico">

                    <div class="phone-info">Liên hệ tôi: 1234567890</div>
                </button>
            </div>

            <div class="right-comment">
                <h3>Bình luận</h3>

                <!-- using when no comments found -->
                <div class="comment-box-false">
                    <img src='<?php echo BASE_URL . "/assets/img/comment-img.png"?>' alt="comment-img.png" class="comment-img">

                    <p>Chưa có bình luận nào. </br>Hãy để lại bình luận cho người bán.</p>
                </div>

                <!-- using when exsits comments -->
                 <div class="comment-box-true">
                    <!-- a comment example -->
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                    <div class="user-comment">
                        <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="other-avatar.png" class="other-avatar">

                     <div class="other-comment">
                        <div class="other-name">Popici</div>

                        <div class="other-comment-text">Nà ná na na</div>

                        <div class="other-comment-time">03:36 AM - 01/01/2026</div>
                     </div>
                    </div>
                    <?php } ?>
                 </div>

                 <div class="comment-line"></div>

                 <div class="comment-input">
                    <div class="comment-input-box">
                        <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="user-avatar.png" class="user-avatar">

                        <textarea type="text" name="user-input" id="user-input" class="user-input" placeholder="Bình luận..."></textarea>
                    </div>

                    <button type="button" class="user-submit">
                        <img src='<?php echo BASE_URL ."/assets/img/user-submit-ico.png"?>' alt="user-submit-ico.png" class="user-submit-ico">
                    </button>
                 </div>
            </div>
        </div>
    </div>
    
    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
</html>
