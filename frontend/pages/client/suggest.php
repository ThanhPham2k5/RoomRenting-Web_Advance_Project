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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/suggest.css" ?>'/>

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
    <title>Suggest Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="filter-block">
      <div class="filter">
        <!-- <div class="filter-line"></div> -->

        <div class="filter-area"><h3>Khu vực</h3></div>

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

        <div class="filter-line"></div>

        <div class="filter-room"><h3>Loại phòng</h3></div>

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

        <div class="filter-line"></div>

        <div class="filter-price"><h3>Giá cả</h3></div>

        <input type="number" name="filter-min-price" id="filter-min-price" 
        placeholder="Giá nhỏ nhất" 
        min="0" class="filter-min-price">

        <input type="number" name="filter-max-price" id="filter-max-price" 
        placeholder="Giá lớn nhất" 
        min="0" class="filter-max-price">

        <div class="filter-line"></div>

        <div class="filter-square"><h3>Diện tích</h3></div>

        <input type="number" name="filter-square-number" id="filter-square-number" 
        placeholder="Nhập diện tích" 
        min="0" class="filter-square-number">

        <div class="filter-line"></div>

        <button type="button" class="filter-apply">Lưu</button>
      </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
</html>