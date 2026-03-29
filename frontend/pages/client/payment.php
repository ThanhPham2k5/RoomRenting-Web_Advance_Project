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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/payment.css" ?>'/>

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
    <title>Payment Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="payment-block">
        <div class="payment">
            <h3 class="payment-title">Quét mã thanh toán</h3>

            <img src='<?php echo BASE_URL . "/assets/img/payment-qr.svg"?>' alt="payment-qr.png" class="payment-qr">
            
            <div class="payment-title">hoặc</div>

            
            <label for="payment-input" class="payment-code"><h3>Mã thẻ</h3></label>

            <input type="text" name="payment-input" id="payment-input" class="payment-input"
            placeholder="Nhập mã thẻ">

            <button type="button" class="payment-btn">Thanh toán</button>
        </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
</html>