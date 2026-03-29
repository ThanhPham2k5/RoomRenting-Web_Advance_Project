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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/suggest-posts.css" ?>'/>

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
    <title>Suggest Post Page | RoomRenting</title>
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

    <div class="posts">
      <div class="posts-head">
        <h2 class="posts-head-text">Sắp xếp theo</h2>

        <div class="posts-head-buttons">
          <button type="button" class="posts-newest">
            <img src='<?php echo BASE_URL . "/assets/img/posts-newest-ico.png"?>' alt="posts-newest-ico.png" class="posts-newest-ico">

            Mới nhất
          </button>

          <button type="button" class="posts-ascending">
            <img src='<?php echo BASE_URL . "/assets/img/posts-ascending-ico.png"?>' alt="posts-ascending-ico.png" class="posts-ascending-ico">

            Giá thấp - cao
          </button>

          <button type="button" class="posts-descending">
            <img src='<?php echo BASE_URL . "/assets/img/posts-descending-ico.png"?>' alt="posts-descending-ico.png" class="posts-descending-ico">

            Giá cao - thấp
          </button>
        </div>
      </div>

      <div class="newpost-postlist">
        <?php for ($i = 1; $i <=12; $i++) { ?>
        <!-- a post sample -->
        <a href="./index.php" class="post">
          <div class="post-favour">
            <img
              src='<?php echo BASE_URL . "/assets/img/favour.png" ?>'
              alt="favour.png"
              class="post-favour-ico"
            />
          </div>

          <img
            src='<?php echo BASE_URL . "/assets/img/post.png" ?>'
            alt="post.png"
            class="post-img"
          />

          <div class="post-title">
            Phòng giá 5 tỷ/ tháng, đường Trương Phước Phan, phường Bình Trị
            Đông, quận Bình Tân
          </div>

          <div class="post-address">
            <img
              src='<?php echo BASE_URL . "/assets/img/address.png" ?>'
              alt="address.png"
              class="address-ico"
            />

            <div class="address-info">Phường Bình Trị Đông, Tp Hồ Chí Minh</div>
          </div>

          <div class="post-info">
            <h3 class="post-price">5 tỷ/tháng</h3>

            <div class="post-square">57.5 m2</div>
          </div>
        </a>
        <?php } ?>
      </div>
    </div>

    <div class="pagination">
      <img src='<?php echo BASE_URL . "/assets/img/page-extra-prev.png"?>' alt="page-extra-prev.png" class="page-extra-prev">

      <img src='<?php echo BASE_URL . "/assets/img/page-prev.png"?>' alt="page-prev.png" class="page-prev">

      <div class="page-prev-number page-selected">1</div>

      <div class="page-current-number">2</div>

      <div class="page-next-number">3</div>

      <input type="number" name="page-number" id="page-number" class="page-number" 
      min="1"
      placeholder="...">
      
      <img src='<?php echo BASE_URL . "/assets/img/page-next.png"?>' alt="page-next.png" class="page-next">

      <img src='<?php echo BASE_URL . "/assets/img/page-extra-next.png"?>' alt="page-extra-next.png" class="page-extra-next">
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