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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/homepage.css" ?>'/>

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
    <title>Home Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="hero">
      <div class="hero-content">
        <div class="content-title">
          <h1 class="title-main">
            Tìm nơi để<br />Sống trọn giấc mơ của bạn<br />Một cách dễ dàng tại
            đây
          </h1>

          <div class="line"></div>

          <h3 class="title-sub">
            Tất cả những gì bạn cần để tìm chỗ ở đều có ở<br />
            đây, giúp bạn dễ dàng hơn trong việc tìm kiếm
          </h3>
        </div>
      </div>

      <img
        src='<?php echo BASE_URL . "/assets/img/hero-img.png" ?>'
        alt="hero-img.png"
        class="hero-img"
      />
    </div>

    <div class="newpost">
      <h2 class="newpost-title">Bài đăng mới nhất</h2>

      <div class="newpost-postlist">
        <!-- a post sample -->
        <div class="post">
          <div class="post-favour">
            <img
              src='<?php echo BASE_URL . "/assets/img/favour.png" ?>'
              alt="favour.png"
              class="post-favour-ico"
            />
          </div>

          <a href="./detail-post.php" class="post-body">
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
        </div>
      </div>

      <a href='<?php echo BASE_URL . "/pages/client/posts.php"?>' class="more">Xem thêm</a>

      <div class="suggest">
        <div class="suggest-text">Muốn nhận bài đăng phù hợp?</div>

        <a href='<?php echo BASE_URL . "/pages/client/suggest.php"?>' class="suggest-link"> Thêm đề xuất của bạn</a>
      </div>
    </div>

    <!-- The suggest list will visible when complete suggest form or collect from user info-->
    <!-- Using the same class name to inherit CSS -->
    <!-- To seperate with the previous class name, give a new class name with "suitable" prefix, eg. suitable-title -->
    <div class="newpost">
      <h2 class="newpost-title">Bài đăng phù hợp với bạn</h2>

      <div class="newpost-postlist">
        <!-- a post sample -->
        <div class="post">
          <div class="post-favour">
            <img
              src='<?php echo BASE_URL . "/assets/img/favour.png" ?>'
              alt="favour.png"
              class="post-favour-ico"
            />
          </div>

          <a href="./detail-post.php" class="post-body">
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
        </div>
      </div>

      <a href='<?php echo BASE_URL . "/pages/client/suggest-posts.php"?>' class="more">Xem thêm</a>
    </div>
    
    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
  <script>
    // get all posts to posts section (do not require token)
    async function getNewPost() {
      const response = await fetch("http://127.0.0.1:8000/api/posts?per_page=5", {
        method: "GET",
        headers: {
          "Accept": "application/json"
        }
      })

      const data = await response.json()
      if(response.ok) {
        if(data.data)
          return data.data
        else {
          console.log(data.data)
        }
      } else {
        console.log(data)
      }
    }

    // get suggest posts to suggest posts section (require token)
    async function getSuggestPost(account_id, token) {
      
    }

    // check user login or not and update post section
    async function updateHomePage() {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      // not login yet
      if (account_id != null && token != null) {
        // update post section (not require -> do not have favour button)
        var posts = await getNewPost()
      } else {
        // logined
        // update post section (require -> must have favour button)
        var posts = await getNewPost()
      }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      await updateHomePage()
    })
  </script>
</html>
