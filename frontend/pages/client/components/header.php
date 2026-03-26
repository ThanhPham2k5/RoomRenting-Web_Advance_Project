<?php
  include_once(__DIR__ . "/../core/config.php")
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/reset.css" ?> '/>
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/main.css" ?>' />
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/components/header.css" ?>' />
  </head>
  <body>
    <div class="header">
      <a class="header-logo" href='<?php echo BASE_URL . "/pages/client/index.php"?>'>
        <img
          src='<?php echo BASE_URL . "/assets/img/logo.png"?>'
          alt="logo.png"
          class="header-logo-img"
        />

        <h2 class="header-logo-text">RoomRenting.com</h2>
      </a>

      <!-- normal mode -->
      <div class="header-buttons">
        <!-- Navigate to Sign up Page -->
        <a href='<?php echo BASE_URL . "/pages/client/signup.php" ?>' class="header-button button-sign-up">Đăng ký</a>

        <!-- Navigate to Log in Page -->
        <a href='<?php echo BASE_URL . "/pages/client/login.php" ?>' class="header-button button-log-in">Đăng nhập</a>

        <!-- Notification -->
        <div class="header-notify">
          <img src='<?php echo BASE_URL . "/assets/img/notify.png"?>' alt="notify.png" class="header-notification">

          <div class="notify-block">
            Thông báo

            <div class="notify-tab">
              <button type="button" class="notify-news notify-selected">Tin tức</button>
              
              <button type="button" class="notify-transaction">Giao dịch</button>

              <button type="button" class="notify-action">Hoạt động</button>
            </div>

            <div class="notify-line"></div>

            <div class="notify-title">
              Thông báo tin tức gần đây
            </div>

            <div class="notify-list">
              <!-- an example item -->
              <a href="" class="notify-item notify-item-unread">
                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                <div class="notify-content">
                  <div class="notify-info">Căn nhà giá 5 tỷ, đường Trương Phước Phan, phường Bình Trị Đông, quận Bình Tân</div>

                  <!-- using for transaction -->
                  <div class="notify-value"></div>
                </div>
              </a>

              <a href="" class="notify-item">
                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                <div class="notify-content">
                  <div class="notify-info">Thêm điểm vào tài khoản thành công</div>

                  <!-- using for transaction -->
                  <div class="notify-value value-add">+999 Điểm ( Nạp thêm điểm thành công )</div>
                </div>
              </a>

              <?php for ($i = 1; $i <= 10; $i++) { ?>
              <a href="" class="notify-item">
                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                <div class="notify-content">
                  <div class="notify-info">Thêm điểm vào tài khoản thành công</div>

                  <!-- using for transaction -->
                  <div class="notify-value value-subtract">-100 Điểm ( Phí sử dụng dịch vụ )</div>
                </div>
              </a>
              <?php } ?>
            </div>
          </div>

          <div class="notify-alert"></div>
        </div>

        <!-- Manage Posts (Client) -->
        <a href='<?php echo BASE_URL . "/pages/client/login.php" ?>' class="header-button button-posts">
          <img src='<?php echo BASE_URL . "/assets/img/posts-ico.png"?>' alt="posts-ico.png" class="button-posts-ico">
          
          <div class="button-posts-text">Quản lý bài đăng</div>
        </a>

        <!-- Post (Client) -->
        <a href='<?php echo BASE_URL . "/pages/client/signup.php" ?>' class="header-button button-post">Đăng bài</a>

        <!-- User -->
        <div class="user-block">
          <div class="header-button button-user">
            <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="user-ico.png" class="button-user-ico">

            <img src='<?php echo BASE_URL . "/assets/img/user-arrow.png"?>' alt="user-arrow.png" class="button-user-arrow">
          </div>

          <!-- User Panel -->
            <div class="user-panel">
              <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

              <div class="user-name">Po Pici</div>

              <div class="user-id">Mã KH: 36363636</div>

              <a href="" class="user-link">Đi tới trang cá nhân</a>

              <div class="user-point-section">
                <div class="user-point-info">
                  Điểm

                  <div class="user-point-value">
                    100.000

                    <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point.png" class="user-point-img">
                  </div>
                </div>

                <button type="button" class="user-point-btn">Nạp ngay</button>
              </div>

              <div class="user-extend">Tiện ích</div>

              <div class="user-list">
                <div class="user-favourite">
                  <img src='<?php echo BASE_URL . "/assets/img/favourite-ico.png"?>' alt="favourite-ico.png" class="user-favourite-ico">

                  Bài đăng đã thích

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </div>
                
                <div class="user-suggest">
                  <img src='<?php echo BASE_URL . "/assets/img/suggest-ico.png"?>' alt="suggest-ico.png"  class="user-suggest-ico">

                  Đề xuất của bạn

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </div>
                
                <div class="user-transaction">
                  <img src='<?php echo BASE_URL . "/assets/img/transaction-ico.png"?>' alt="transaction-ico.png"  class="user-transaction-ico">

                  Lịch sử giao dịch

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </div>
              </div>

              <div class="user-other">Khác</div>

              <div class="user-setting">
                <img src='<?php echo BASE_URL . "/assets/img/setting-ico.png"?>' alt="setting-ico.png"  class="user-setting-ico">

                Cài đặt tài khoản

                <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
              </div>

              <div class="user-logout">
                <img src='<?php echo BASE_URL . "/assets/img/logout-ico.png"?>' alt="logout-ico.png"  class="user-logout-ico">

                Đăng xuất
              </div>
            </div>
        </div>
      </div>

      <!-- responsive mode -->
      <div class="header-menu">
        <button class="header-button header-menu-button">
          <img
            src='<?php echo BASE_URL . "/assets/img/menu-ico.png"?>'
            alt="menu-ico"
            class="header-menu-ico"
          />

          <div class="header-menu-text">Menu</div>
        </button>

        <div class="sidebar">
          <a href='<?php echo BASE_URL . "/pages/client/signup.php" ?>' class="sidebar-item sidebar-signup">Đăng ký</a>

          <a href='<?php echo BASE_URL . "/pages/client/login.php" ?>' class="sidebar-item sidebar-login">Đăng nhập</a>

          <div class="sidebar-notify-block">
            <div class="sidebar-item sidebar-notification">
              Thông báo
            </div>

            <div class="menu-notify-block">
                <div class="notify-tab">
                  <button type="button" class="notify-news notify-selected">Tin tức</button>
                  
                  <button type="button" class="notify-transaction">Giao dịch</button>

                  <button type="button" class="notify-action">Hoạt động</button>
                </div>

                <div class="notify-line"></div>

                <div class="notify-title">
                  Thông báo tin tức gần đây
                </div>

                <div class="notify-list">
                  <!-- an example item -->
                  <a href="" class="notify-item notify-item-unread">
                    <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                    <div class="notify-content">
                      <div class="notify-info">Căn nhà giá 5 tỷ, đường Trương Phước Phan, phường Bình Trị Đông, quận Bình Tân</div>

                      <!-- using for transaction -->
                      <div class="notify-value"></div>
                    </div>
                  </a>

                  <a href="" class="notify-item">
                    <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                    <div class="notify-content">
                      <div class="notify-info">Thêm điểm vào tài khoản thành công</div>

                      <!-- using for transaction -->
                      <div class="notify-value value-add">+999 Điểm ( Nạp thêm điểm thành công )</div>
                    </div>
                  </a>

                  <?php for ($i = 1; $i <= 10; $i++) { ?>
                  <a href="" class="notify-item">
                    <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="item-img.png" class="notify-item-img">

                    <div class="notify-content">
                      <div class="notify-info">Thêm điểm vào tài khoản thành công</div>

                      <!-- using for transaction -->
                      <div class="notify-value value-subtract">-100 Điểm ( Phí sử dụng dịch vụ )</div>
                    </div>
                  </a>
                  <?php } ?>
                </div>
              </div>
          </div>

          <a href='<?php echo BASE_URL . "/pages/client/login.php" ?>' class="sidebar-item sidebar-posts">Quản lý bài đăng</a>

          <a href='<?php echo BASE_URL . "/pages/client/login.php" ?>' class="sidebar-item sidebar-post">Đăng bài</a>

          <div class="sidebar-user-block">
            <div class="sidebar-item sidebar-user">
              Tài khoản
            </div>

            <!-- User Panel -->
              <div class="menu-user-panel">
                <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

                <div class="user-name">Po Pici</div>

                <div class="user-id">Mã KH: 36363636</div>

                <a href="" class="user-link">Đi tới trang cá nhân</a>

                <div class="user-point-section">
                  <div class="user-point-info">
                    Điểm

                    <div class="user-point-value">
                      100.000

                      <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point.png" class="user-point-img">
                    </div>
                  </div>

                  <button type="button" class="user-point-btn">Nạp ngay</button>
                </div>

                <div class="user-extend">Tiện ích</div>

                <div class="user-list">
                  <div class="user-favourite">
                    <img src='<?php echo BASE_URL . "/assets/img/favourite-ico.png"?>' alt="favourite-ico.png" class="user-favourite-ico">

                    Bài đăng đã thích

                    <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                  </div>
                  
                  <div class="user-suggest">
                    <img src='<?php echo BASE_URL . "/assets/img/suggest-ico.png"?>' alt="suggest-ico.png"  class="user-suggest-ico">

                    Đề xuất của bạn

                    <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                  </div>
                  
                  <div class="user-transaction">
                    <img src='<?php echo BASE_URL . "/assets/img/transaction-ico.png"?>' alt="transaction-ico.png"  class="user-transaction-ico">

                    Lịch sử giao dịch

                    <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                  </div>
                </div>

                <div class="user-other">Khác</div>

                <div class="user-setting">
                  <img src='<?php echo BASE_URL . "/assets/img/setting-ico.png"?>' alt="setting-ico.png"  class="user-setting-ico">

                  Cài đặt tài khoản

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </div>

                <div class="user-logout">
                  <img src='<?php echo BASE_URL . "/assets/img/logout-ico.png"?>' alt="logout-ico.png"  class="user-logout-ico">

                  Đăng xuất
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script>
    // menu button script
    const header_menu_button = document.querySelector(".header-menu-button");

    const sidebar = document.querySelector(".sidebar");

    // check flex first becuz the first time loads the page will be none => cause double check click
    header_menu_button.addEventListener("click", (e) => {
      if (sidebar.style.display == "flex") {
        sidebar.style.display = "none";
      } else {
        sidebar.style.display = "flex";
      }
    });

    // notification script
    const notify_button = document.querySelector(".header-notification");
    const notify_block = document.querySelector(".notify-block");

    notify_button.addEventListener("click", (e) => {
      if (notify_block.style.display == "flex") {
        notify_block.style.display = "none";
      } else {
        notify_block.style.display = "flex";
      }
    });

    const notify_sidebar = document.querySelector(".sidebar-notification");
    const menu_notify_block = document.querySelector(".menu-notify-block");

    notify_sidebar.addEventListener("click", (e) => {
      if (menu_notify_block.style.display == "flex") {
        menu_notify_block.style.display = "none";
      } else {
        menu_notify_block.style.display = "flex";
      }
    });

    // user panel script
    const user_button = document.querySelector(".button-user");
    const user_button_ico = document.querySelector(".button-user-arrow");
    const user_block = document.querySelector(".user-panel");

    user_button.addEventListener("click", (e) => {
      if (user_block.style.display == "flex") {
        user_block.style.display = "none";
        user_button_ico.style.transform = "rotate(0deg)";
      } else {
        user_block.style.display = "flex";
        user_button_ico.style.transform = "rotate(180deg)";
      }
    });

    const menu_user_button = document.querySelector(".sidebar-user");
    const menu_user_block = document.querySelector(".menu-user-panel");

    menu_user_button.addEventListener("click", (e) => {
      if (menu_user_block.style.display == "flex") {
        menu_user_block.style.display = "none";
      } else {
        menu_user_block.style.display = "flex";
      }
    });
  </script>
</html>
