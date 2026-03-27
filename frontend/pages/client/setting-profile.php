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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/setting-profile.css" ?>'/>

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
    <title>Setting Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
        
    <div class="profile-block">
        <div class="profile">
            <h2 class="profile-title">Cài đặt</h2>

            <div class="profile-content">
                <div class="profile-tab">
                    <div class="profile-info">
                        <img src='<?php echo BASE_URL . "/assets/img/info-ico.png"?>' alt="info-ico.png" class="profile-info-ico">

                        <div class="profile-info-text">Thông tin cá nhân</div>

                        <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="profile-info-arrow">
                    </div>
                    
                    <div class="profile-setting">
                        <img src='<?php echo BASE_URL . "/assets/img/setting-profile-ico.png"?>' alt="setting-profile-ico.png" class="profile-setting-ico">

                        <div class="profile-setting-text">Cài đặt tài khoản</div>

                        <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="profile-setting-arrow">
                    </div>
                </div>

                <div class="profile-components">
                    <div class="profile-form">
                        <h3 class="profile-form-title">Hồ sơ cá nhân</h3>

                        <div class="profile-line"></div>

                        <div class="profile-avatar">
                            <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="profile-avatar-img">
                        
                            <div class="profile-avatar-upload">
                                <button type="button" class="profile-avatar-btn">Tải ảnh mới</button>

                                <!-- max size? -->
                                <div class="profile-avatar-text">Định dạng JPG, PNG. Dung lượng tối đa ?MB.</div>
                            </div>
                        </div>

                        <label for="profile-fullname-input" class="profile-fullname">Họ và tên</label>

                        <input type="text" name="profile-fullname-input" id="profile-fullname-input" class="profile-fullname-input"
                        placeholder="Nhập vào họ tên">

                        <label for="profile-phone-input" class="profile-phone">Số điện thoại</label>

                        <input type="text" name="profile-phone-input" id="profile-phone-input" class="profile-phone-input"
                        placeholder="Nhập số điện thoại">

                        <label for="profile-address-input" class="profile-address">Địa chỉ</label>

                        <input type="text" name="profile-address-input" id="profile-address-input" class="profile-address-input"
                        placeholder="Nhập vào số nhà">

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

                        <h3 class="profile-privacy">Thông tin bảo mật</h3>

                        <div class="profile-line"></div>
                        
                        <label for="profile-id-card-input" class="profile-id-card">Căn cước công dân</label>

                        <input type="text" name="profile-id-card-input" id="profile-id-card-input" class="profile-id-card-input"
                        placeholder="CCCD/ CMND/ Hộ chiếu">

                        <label for="filter-gender-cb" class="profile-gender">Giới tính</label>

                        <div class="filter-gender">
                            <input type="checkbox" name="filter-gender-cb" id="filter-gender-cb" class="filter-gender-cb">

                            <label for="filter-gender-cb" class="filter-gender-lb">
                                Chọn giới tính

                                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
                            </label>

                            <ul class="filter-gender-list">
                                <!-- an example item -->
                                <li class="filter-gender-item">Nam</li>
                                
                                <li class="filter-gender-item">Nữ</li>
                            </ul>
                        </div>

                        <label for="profile-dob-input" class="profile-dob">Ngày sinh</label>

                        <input type="text" name="profile-dob-input" id="profile-dob-input" class="profile-dob-input"
                        placeholder="01/01/2026">

                        <button type="button" class="profile-save">Lưu thay đổi</button>
                    </div>

                    <div class="profile-pass">
                        <h3 class="profile-pass-title">Thay đổi mật khẩu</h3>

                        <div class="profile-cur-pass">
                            <input type="password" name="profile-cur-pass-input" id="profile-cur-pass-input" class="profile-cur-pass-input"
                            placeholder="Mật khẩu hiện tại">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>' alt="hidden.png" class="profile-cur-pass-hidden">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>' alt="show.png" class="profile-cur-pass-show">
                        </div>

                        <div class="profile-new-pass">
                            <input type="password" name="profile-new-pass-input" id="profile-new-pass-input" class="profile-new-pass-input"
                            placeholder="Mật khẩu mới">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>' alt="hidden.png" class="profile-new-pass-hidden">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>' alt="show.png" class="profile-new-pass-show">
                        </div>

                        <div class="profile-re-new-pass">
                            <input type="password" name="profile-re-new-pass-input" id="profile-re-new-pass-input" class="profile-re-new-pass-input"
                            placeholder="Xác nhận mật khẩu mới">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>' alt="hidden.png" class="profile-re-new-pass-hidden">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>' alt="show.png" class="profile-re-new-pass-show">
                        </div>

                        <button type="button" class="profile-pass-save">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
  <script>
    // tab script
    const info = document.querySelector(".profile-info");
    const setting = document.querySelector(".profile-setting");
    const form = document.querySelector(".profile-form");
    const pass = document.querySelector(".profile-pass");

    info.addEventListener("click", (e) => {
        form.style.display = "flex";
        pass.style.display = "none";
    });

    setting.addEventListener("click", (e) => {
        pass.style.display = "flex";
        form.style.display = "none";
    });

    // pass script
    const cur_pass = document.querySelector(".profile-cur-pass-input");
    const cur_pass_hidden = document.querySelector(".profile-cur-pass-hidden");
    const cur_pass_show = document.querySelector(".profile-cur-pass-show");

    cur_pass_hidden.addEventListener("click", (e) => {
        cur_pass.setAttribute("type", "text");
        cur_pass_show.style.display = "flex";
        cur_pass_hidden.style.display = "none";
    });

    cur_pass_show.addEventListener("click", (e) => {
        cur_pass.setAttribute("type", "password");
        cur_pass_hidden.style.display = "flex";
        cur_pass_show.style.display = "none";
    });
    
    const new_pass = document.querySelector(".profile-new-pass-input");
    const new_pass_hidden = document.querySelector(".profile-new-pass-hidden");
    const new_pass_show = document.querySelector(".profile-new-pass-show");

    new_pass_hidden.addEventListener("click", (e) => {
        new_pass.setAttribute("type", "text");
        new_pass_show.style.display = "flex";
        new_pass_hidden.style.display = "none";
    });

    new_pass_show.addEventListener("click", (e) => {
        new_pass.setAttribute("type", "password");
        new_pass_hidden.style.display = "flex";
        new_pass_show.style.display = "none";
    });
    
    const re_new_pass = document.querySelector(".profile-re-new-pass-input");
    const re_new_pass_hidden = document.querySelector(".profile-re-new-pass-hidden");
    const re_new_pass_show = document.querySelector(".profile-re-new-pass-show");

    re_new_pass_hidden.addEventListener("click", (e) => {
        re_new_pass.setAttribute("type", "text");
        re_new_pass_show.style.display = "flex";
        re_new_pass_hidden.style.display = "none";
    });

    re_new_pass_show.addEventListener("click", (e) => {
        re_new_pass.setAttribute("type", "password");
        re_new_pass_hidden.style.display = "flex";
        re_new_pass_show.style.display = "none";
    });
  </script>
</html>