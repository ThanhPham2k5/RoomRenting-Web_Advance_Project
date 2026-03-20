<?php 
  include_once(__DIR__ . "/../core/config.php")
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='<?php echo BASE_URL ."/css/client/reset.css" ?>' />
    <link rel="stylesheet" href='<?php echo BASE_URL ."/css/client/main.css" ?>' />
    <link rel="stylesheet" href='<?php echo BASE_URL ."/css/client/components/footer.css" ?>' />
  </head>
  <body>
    <div class="footer">
      <div class="footer-logo">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo.png" ?>'
          alt="logo.png"
          class="footer-logo-img"
        />

        <h2 class="footer-logo-text">RoomRenting.com</h2>
      </div>

      <h3 class="footer-slogan">
        Chúng tôi rất tự hào về việc đảm bảo sự hài lòng của<br />
        khách hàng
      </h3>

      <div class="footer-socials">
        <a href="">
          <img
            src='<?php echo BASE_URL . "/assets/img/facebook.png" ?>'
            alt="facebook.png"
            class="footer-facebook footer-socials-ico"
          />
        </a>

        <a href="">
          <img
            src='<?php echo BASE_URL . "/assets/img/twitter.png" ?>'
            alt="twitter.png"
            class="footer-twitter footer-socials-ico"
          />
        </a>

        <a href="">
          <img
            src='<?php echo BASE_URL . "/assets/img/instagram.png" ?>'
            alt="instagram.png"
            class="footer-instagram footer-socials-ico"
          />
        </a>

        <a href="">
          <img
            src='<?php echo BASE_URL . "/assets/img/thread.png" ?>'
            alt="thread.png"
            class="footer-thread footer-socials-ico"
          />
        </a>
      </div>

      <div class="footer-line"></div>

      <div class="footer-copyright">
        © 2026 RoomRenting. All rights reserved.
      </div>
    </div>
  </body>
</html>
