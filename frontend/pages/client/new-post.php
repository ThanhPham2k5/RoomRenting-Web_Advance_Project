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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/new-post.css" ?>'/>

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
    <title>New Post Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
    
    <div class="new-block">
      <div class="new">
        <div class="new-pic">
          <h3 class="new-pic-title">Hình ảnh</h3>

          <button type="button" class="new-post-upload">
            <img src='<?php echo BASE_URL . "/assets/img/upload-img.png"?>' alt="upload-img.png" class="new-post-upload-img">
          </button>

          <div class="new-pic-list">
            <div class="new-pic-box">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-1.png" class="new-pic-1">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del">
            </div>

            <div class="new-pic-box">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-2.png" class="new-pic-2">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del">
            </div>

            <div class="new-pic-box">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-3.png" class="new-pic-3">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del">
            </div>

            <div class="new-pic-box">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-4.png" class="new-pic-4">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del">
            </div>
          </div>
        </div>

        <div class="new-form">
          <label for="profile-address-input" class="profile-address"><h3>Địa chỉ</h3></label>

          <input type="text" name="profile-address-input" id="profile-address-input" class="profile-address-input"
          placeholder="Nhập vào số nhà">

          <div class="profile-error address-error">Số nhà không hợp lệ</div>

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

          <div class="profile-error province-error">Số nhà không hợp lệ</div>

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

          <div class="profile-error district-error">Số nhà không hợp lệ</div>

          <label for="profile-square-input" class="profile-square"><h3>Diện tích</h3></label>

          <input type="text" name="profile-square-input" id="profile-square-input" class="profile-square-input"
          placeholder="Nhập diện tích (VD: 35m2)">

          <div class="profile-error square-error">Số nhà không hợp lệ</div>

          <label for="profile-price-input" class="profile-price"><h3>Giá thuê</h3></label>

          <input type="number" name="profile-price-input" id="profile-price-input" class="profile-price-input"
          placeholder="Nhập giá thuê"
          min="0">

          <div class="profile-error price-error">Số nhà không hợp lệ</div>

          <label for="profile-deposit-input" class="profile-deposit"><h3>Giá cọc</h3></label>

          <input type="number" name="profile-deposit-input" id="profile-deposit-input" class="profile-deposit-input"
          placeholder="Nhập giá cọc"
          min="0">

          <div class="profile-error deposit-error">Số nhà không hợp lệ</div>

          <label for="profile-post-input" class="profile-post"><h3>Tiêu đề và mô tả</h3></label>

          <input type="text" name="profile-post-input" id="profile-post-input" class="profile-post-input"
          placeholder="Nhập tiêu đề">

          <div class="profile-error post-error">Số nhà không hợp lệ</div>

          <textarea name="profile-post-textarea" id="profile-post-textarea" class="profile-post-textarea"
          placeholder="Nhập mô tả"></textarea>

          <div class="profile-error post-textarea-error">Số nhà không hợp lệ</div>

          <button type="button" class="new-submit">Đăng bài</button>
        </div>
      </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
</html>