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
        </div>
      </div>
    </div>
  </body>

  <script>
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
  </script>
</html>
