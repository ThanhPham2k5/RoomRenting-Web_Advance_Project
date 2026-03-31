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
        <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/manage-post.css" ?>'/>

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
        <title>Manage Post Page | RoomRenting</title>
    </head>
    <body>
        <?php include(__DIR__ . "/components/header.php"); ?>

        <div class="filter-background">
        <div class="filter">
            <div class="filter-return-block">
            <div class="filter-return">
                <img src='<?php echo BASE_URL . "/assets/img/return-ico.png"?>' alt="return-ico.png" class="filter-return-ico">

                Quay lại
            </div>
            </div>

            <!-- <div class="filter-line"></div> -->

            <div class="filter-area">Khu vực</div>

            <div class="filter-province">
            <input type="checkbox" name="filter-province-cb" id="filter-province-cb" class="filter-province-cb">

            <label for="filter-province-cb" class="filter-province-lb">
                Chọn tỉnh thành

                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
            </label>

            <ul class="filter-province-list">
                <!-- an example item -->
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                <li class="filter-province-item">Thành phố Hồ Chí Minh</li>
                <?php } ?>
            </ul>
            </div>

            <div class="filter-district">
            <input type="checkbox" name="filter-district-cb" id="filter-district-cb" class="filter-district-cb">

            <label for="filter-district-cb" class="filter-district-lb">
                Chọn phường xã

                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
            </label>

            <ul class="filter-district-list">
                <!-- an example item -->
                <li class="filter-district-item">Phường Sài Gòn</li>
            </ul>
            </div>

            <!-- <div class="filter-line"></div> -->

            <div class="filter-room">Loại phòng</div>

            <div class="filter-rooms">
            <input type="checkbox" name="filter-room-cb" id="filter-room-cb" class="filter-room-cb">

            <label for="filter-room-cb" class="filter-room-lb">
                Chọn loại phòng

                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
            </label>

            <ul class="filter-room-list">
                <!-- an example item -->
                <li class="filter-room-item">Phòng đơn</li>
            </ul>
            </div>

            <!-- <div class="filter-line"></div> -->

            <div class="filter-price">Giá cả</div>

            <input type="number" name="filter-min-price" id="filter-min-price" 
            placeholder="Giá nhỏ nhất" 
            min="0" class="filter-min-price">

            <input type="number" name="filter-max-price" id="filter-max-price" 
            placeholder="Giá lớn nhất" 
            min="0" class="filter-max-price">

            <!-- <div class="filter-line"></div> -->

            <div class="filter-square">Diện tích</div>

            <input type="number" name="filter-square-number" id="filter-square-number" 
            placeholder="Nhập diện tích" 
            min="0" class="filter-square-number">

            <!-- <div class="filter-line"></div> -->

            <button type="button" class="filter-apply">Áp dụng</button>
        </div>
        </div>

        <div class="manage-block">
            <div class="manage">
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

                <div class="content-search">
                    <div class="search-tool">
                        <img
                        src='<?php echo BASE_URL . "/assets/img/Find.png" ?>'
                        alt="find.png"
                        class="search-ico"
                        />

                        <input
                        type="text"
                        name=""
                        id=""
                        placeholder="Tìm kiếm"
                        class="search-bar"
                        />
                    </div>

                    <div class="search-seperate"></div>

                    <div class="other-tools">
                        <div class="filter-tool">
                        <img
                            src='<?php echo BASE_URL . "/assets/img/Vector.png" ?>'
                            alt="filter.png"
                            class="filter-ico"
                        />

                        <div class="filter-text">Bộ lọc</div>
                        </div>

                        <button class="search-submit">Tìm phòng</button>
                    </div>
                </div>

                <div class="manage-panel">
                    <div class="manage-tab">
                        <button type="button" class="manage-active manage-selected">ĐANG HIỂN THỊ (0)</button>

                        <button type="button" class="manage-ignore">BỊ TỪ CHỐI (0)</button>

                        <button type="button" class="manage-paid">CẦN THANH TOÁN (0)</button>

                        <button type="button" class="manage-accept">CHỜ KIỂM DUYỆT (0)</button>
                    </div>

                    <div class="newpost-postlist">
                        <!-- a post sample -->
                        <?php for ($i = 1; $i <= 4; $i++) { ?>
                        <div class="post">
                            <div class="post-body">
                                <a href="./detail-post.php" class="post-link-img">
                                <img
                                    src='<?php echo BASE_URL . "/assets/img/post.png" ?>'
                                    alt="post.png"
                                    class="post-img"
                                />
                                </a>

                                <div class="post-profile-info">
                                    <a href="./detail-post.php" class="post-link">
                                    <div class="post-title">
                                        Phòng giá 5 tỷ/ tháng, đường Trương Phước Phan, phường Bình Trị
                                        Đông, quận Bình Tân
                                    </div>
                                    </a>

                                    <a href="./detail-post.php" class="post-link">
                                    <div class="post-address">
                                        <img
                                        src='<?php echo BASE_URL . "/assets/img/address.png" ?>'
                                        alt="address.png"
                                        class="address-ico"
                                        />

                                        <div class="address-info">Phường Bình Trị Đông, Tp Hồ Chí Minh</div>
                                    </div>
                                    </a>

                                    <a href="./detail-post.php" class="post-link">
                                    <div class="post-info">
                                        <h3 class="post-price">5 tỷ/tháng</h3>

                                        <div class="post-square">57.5 m2</div>
                                    </div>
                                    </a>

                                    <!-- list of button -->
                                    <div class="post-btn-list">
                                        <a href='<?php echo BASE_URL . "/pages/client/modify-post.php"?>' type="button" class="post-btn-modify">
                                            <img src='<?php echo BASE_URL . "/assets/img/modify-img.png"?>' alt="modify-img.png" class="post-btn-modify-img">

                                            Sửa bài
                                        </a>
                                        
                                        <button type="button" class="post-btn-del">
                                            <img src='<?php echo BASE_URL . "/assets/img/del-img.png"?>' alt="del-img.png" class="post-btn-del-img">

                                            Xóa bài
                                        </button>
                                        
                                        <button type="button" class="post-btn-reason">
                                            Xem lí do
                                        </button>
                                        
                                        <button type="button" class="post-btn-resend">
                                            Gửi duyệt lại
                                        </button>
                                        
                                        <button type="button" class="post-btn-paid">
                                            <img src='<?php echo BASE_URL . "/assets/img/paid-img.png"?>' alt="paid-img.png" class="post-btn-paid-img">

                                            Cần thanh toán
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <!-- using when there is no post -->
                    <div class="no-post">
                        <h2 class="no-post-main">Bạn chưa có bài đăng nào</h2>

                        <a href="" class="no-post-btn">Đăng bài ngay</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include(__DIR__ . "/components/footer.php") ?>
    </body>
    <script>
        // filter script
        const filter_button = document.querySelector(".filter-tool");
        const filter = document.querySelector(".filter-background");
        const filter_return = document.querySelector(".filter-return");

        filter_button.addEventListener("click", (e) => {
        if(filter.style.display == "flex") {
            filter.style.display = "none"
        } else {
            filter.style.display = "flex"
        }
        });

        filter_return.addEventListener("click", (e) => {
        if(filter.style.display == "flex") {
            filter.style.display = "none"
        } else {
            filter.style.display = "flex"
        }
        });
    </script>
</html>