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
</html>