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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/signup.css" ?>'/>

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
    <link rel="shortcut icon" href='<?php echo BASE_URL . "/assets/favicon/favicon.ico" ?>'/>
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href='<?php echo BASE_URL . "/assets/favicon/apple-touch-icon.png"?>'
    />
    <link rel="manifest" href='<?php echo BASE_URL . "/assets/favicon/site.webmanifest" ?>'/>
    <title>Signup Page | RoomRenting</title>
  </head>
  <body>
    <div class="login">
      <a href="./index.php"><img src='<?php echo BASE_URL . "/assets/img/logo.png"?>' alt="logo.png" class="login-logo" /></a>

      <h1 class="login-main-text">Đăng ký</h1>

      <h3 class="login-sub-text">Đăng ký tài khoản của bạn</h3>

      <div class="login-username">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-user-ico.png"?>'
          alt="login-user-ico"
          class="login-username-ico"
        />

        <input
          type="text"
          name="username"
          id="username"
          class="login-username-text"
          placeholder="Nhập username của bạn"
          required
        />
      </div>

      <div class="login-username-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-username-error-ico"
        />

        Lỗi username
      </div>

      <div class="login-password">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-phone-ico.png"?>'
          alt="login-phone-ico"
          class="login-username-ico"
        />

        <input
          type="text"
          name="username"
          id="username"
          class="login-username-text"
          placeholder="Nhập số điện thoại của bạn"
          required
        />
      </div>

      <div class="login-username-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-username-error-ico"
        />

        Lỗi số điện thoại
      </div>

      <div class="login-password">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-email-ico.png"?>'
          alt="login-email-ico"
          class="login-username-ico"
        />

        <input
          type="email"
          name="username"
          id="username"
          class="login-username-text"
          placeholder="Nhập email của bạn"
          required
        />
      </div>

      <div class="login-username-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-username-error-ico"
        />

        Lỗi email
      </div>

      <div class="login-password">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-password-ico.png"?>'
          alt="login-password-ico"
          class="login-password-ico"
        />

        <input
          type="password"
          name="password"
          id="password"
          class="login-password-text"
          placeholder="Nhập mật khẩu"
          required
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>'
          alt="login-show-ico"
          class="login-show-ico"
          hidden
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>'
          alt="login-hidden-ico"
          class="login-hidden-ico"
        />
      </div>

      <div class="login-password-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-password-error-ico"
        />

        Lỗi mật khẩu
      </div>

      <div class="login-password">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-password-ico.png"?>'
          alt="login-password-ico"
          class="login-password-ico"
        />

        <input
          type="password"
          name="password"
          id="password"
          class="login-password-text"
          placeholder="Nhập lại mật khẩu"
          required
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>'
          alt="login-show-ico"
          class="login-show-ico"
          hidden
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>'
          alt="login-hidden-ico"
          class="login-hidden-ico"
        />
      </div>

      <div class="login-password-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-password-error-ico"
        />

        Lỗi mật khẩu nhập lại
      </div>

      <input type="submit" value="Đăng ký" class="login-submit" />

      <div class="login-signup">
        Đã có tài khoản?

        <a href="./login.php" class="login-signup-link">Đăng nhập ngay</a>
      </div>
    </div>
  </body>
</html>
