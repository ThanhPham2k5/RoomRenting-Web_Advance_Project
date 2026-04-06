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
        <!-- <div class="post">
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
        </div> -->
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
        <!-- <div class="post">
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
        </div> -->
      </div>

      <a href='<?php echo BASE_URL . "/pages/client/suggest-posts.php"?>' class="more">Xem thêm</a>
    </div>
    
    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
  <script>
    function formatPrice(price) {
        if (price >= 1000000000) return (price / 1000000000).toFixed(1) + " tỷ"
        if (price >= 1000000) return (price / 1000000).toFixed(1) + " triệu"
        return Number(price).toLocaleString("vi-VN")
    }

    // get all posts to posts section (do not require token)
    async function getNewPost() {
      try {
        const response = await fetch("http://backend.test/api/posts?per_page=5&filter[status]=completed&include=postImages,favorites.account&sort=-createdAt&filter[trashed]=without", {
          method: "GET",
          headers: {
            "Accept": "application/json"
          }
        })

        const data = await response.json()
        if(response.ok) {
          if(data.data) {
            // console.log(data.data)
            return data.data
          }
        } else {
          console.error(data)
        }
      } catch (err) {
        console.error(err)
      }
    }

    // get suggest posts to suggest posts section (require token)
    async function getSuggestPost(account_id, token) {
      try {
        const response = await fetch("http://backend.test/api/posts/recommendations/" + account_id + "?per_page=5&filter[status]=completed&include=postImages,favorites.account&sort=-createdAt&filter[trashed]=without", {
          method: "GET",
          headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + token
          }
        })

        const data = await response.json()
        if(response.ok) {
          if(data.data) {
            // console.log(data.data)
            return data.data
          }
        } else {
          console.error(data)
        }
      } catch (err) {
        console.error(err)
      }
    }

    // check form 
    document.querySelectorAll(".more")[1].addEventListener("click", async (e) => {
      e.preventDefault()

      const account_id = localStorage.getItem("account_id")
      const token = localStorage.getItem("token")

      if(account_id != null && token != null) {
        try {  
          const response = await fetch("http://backend.test/api/forms/byAccount/" + account_id, {
            method: "GET",
            headers: {
              "Accept": "application/json",
              "Authorization": "Bearer " + token
            }
          })

          const data = await response.json()
          if(response.ok) {
            // console.log(data)
            if(data.data.province || data.data.ward || data.data.roomType || data.data.priceMin || data.data.priceMax || data.data.area || data.data.maxOccupants) {
              window.location.href = "suggest-posts.php"
            } else {
              alert("Bạn chưa điền form nhận đề xuất. Đang chuyển hướng sang trang điền form.")
              window.location.href = "suggest.php"
            }
          } else {
            console.error(data)
          }
        } catch (err) {
          console.error(err)
        }
      } else {
        alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
        window.location.href = "login.php"
      }
    })

    // check user login or not and update post section
    async function updateHomePage() {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      if (account_id != null && token != null) {
        // logined
        // update post section (require -> must have favour button)
        let [posts, suggests] = await Promise.all([getNewPost(), getSuggestPost(account_id, token)])

        if(posts != null && posts.length > 0) {
          let html = ""

          posts.forEach(post => {
            var money = Number(post.price).toLocaleString("vi-VN")

            // check isFav or not
            var isFav = false
            var favId = ""
            post.favorites.forEach(favorite => {
              // console.log(favorite)
              if(favorite.account.id == account_id) {
                isFav = true
                favId = favorite.id
              }
            })

            var favIco = isFav ? "favour" : "unfavour"

            html += `
              <div class="post">
                <div class="post-favour post-id-${post.id} favourite-id-${favId} ${favIco}">
                  <img
                    src='<?php echo BASE_URL ?>/assets/img/${favIco}.png'
                    alt="favour.png"
                    class="post-favour-ico"
                  />
                </div>

                <a href='<?php echo BASE_URL ?>/pages/client/detail-post.php?post_id=${post.id}' class="post-body">
                  <img
                    src='http://backend.test${post.postImages[0].imagePostUrl}'
                    alt="post.png"
                    class="post-img"
                  />

                  <div class="post-title">
                    ${post.title}
                  </div>

                  <div class="post-address">
                    <img
                      src='<?php echo BASE_URL . "/assets/img/address.png" ?>'
                      alt="address.png"
                      class="address-ico"
                    />

                    <div class="address-info">${post.houseNumber}, ${post.ward}, ${post.province}</div>
                  </div>

                  <div class="post-info">
                    <h3 class="post-price">${formatPrice(post.price)} VND/tháng</h3>

                    <div class="post-square">${post.area} m2</div>
                  </div>
                </a>
              </div>
            `
          });
          
          // update post section (must have favour button)
          document.querySelectorAll(".newpost-postlist")[0].innerHTML = html

          // update favorite post when client clicked
          document.querySelectorAll(".newpost-postlist")[0].querySelectorAll(".post-favour").forEach(item => {
            item.addEventListener("click", async (e) => { 
              // console.log(item.classList)
              var favIco = item.classList.contains("favour")
              const postClass = [...item.classList].find(c => c.startsWith("post-id-"))
              var post_id = postClass.replace("post-id-", "")

              // create new favorite
              if(!favIco) {
                item.classList.remove("unfavour")
                item.classList.add("favour")
                item.querySelector(".post-favour-ico").setAttribute("src", '<?php echo BASE_URL ?>/assets/img/favour.png')

                try {
                  const response = await fetch("http://backend.test/api/favorites", {
                    method: "POST",
                    headers: {
                      "Accept": "application/json",
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                      "account_id": account_id,
                      "post_id": post_id
                    })
                  })

                  const data = await response.json()
                  if(response.ok) {
                    // console.log(data)
                    if(data) {
                      const favClass = [...item.classList].find(c => c.startsWith("favourite-id-"))
                      if(favClass) {
                        item.classList.remove(favClass)
                        item.classList.add("favourite-id-" + data.favorite.id)
                      }
                    }
                  } else {
                    console.error(err)
                  }
                } catch (err) {
                  console.error(err)
                }
              }

              // delete favorite
              if(favIco) {
                item.classList.remove("favour")
                item.classList.add("unfavour")
                item.querySelector(".post-favour-ico").setAttribute("src", '<?php echo BASE_URL ?>/assets/img/unfavour.png')
                const favClass = [...item.classList].find(c => c.startsWith("favourite-id-"))
                var fav_id = favClass.replace("favourite-id-", "")

                try {
                  const response = await fetch("http://backend.test/api/favorites/" + fav_id, {
                    method: "DELETE",
                    headers: {
                      "Accept": "application/json",
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + token
                    }
                  })

                  const data = await response.json()
                  if(response.ok) {
                    // console.log(data)
                  } else {
                    console.error(err)
                  }
                } catch (err) {
                  console.error(err)
                }
              }
            })
          })
          
          html = ""

          if(!suggests || suggests.length == 0) {
            suggests = posts
          }

          // console.log(suggests)

          suggests.forEach(post => {
            var money = Number(post.price).toLocaleString("vi-VN")

            // check isFav or not
            var isFav = false
            var favId = ""
            post.favorites.forEach(favorite => {
              // console.log(favorite)
              if(favorite.account.id == account_id) {
                isFav = true
                favId = favorite.id
              }
            })

            var favIco = isFav ? "favour" : "unfavour"

            html += `
              <div class="post">
                <div class="post-favour post-id-${post.id} favourite-id-${favId} ${favIco}">
                  <img
                    src='<?php echo BASE_URL ?>/assets/img/${favIco}.png'
                    alt="favour.png"
                    class="post-favour-ico"
                  />
                </div>

                <a href='<?php echo BASE_URL ?>/pages/client/detail-post.php?post_id=${post.id}' class="post-body">
                  <img
                    src='http://backend.test${post.postImages[0].imagePostUrl}'
                    alt="post.png"
                    class="post-img"
                  />

                  <div class="post-title">
                    ${post.title}
                  </div>

                  <div class="post-address">
                    <img
                      src='<?php echo BASE_URL . "/assets/img/address.png" ?>'
                      alt="address.png"
                      class="address-ico"
                    />

                    <div class="address-info">${post.houseNumber}, ${post.ward}, ${post.province}</div>
                  </div>

                  <div class="post-info">
                    <h3 class="post-price">${formatPrice(post.price)} VND/tháng</h3>

                    <div class="post-square">${post.area} m2</div>
                  </div>
                </a>
              </div>
            `
          });
          
          
          // update suggest section (must have favour button)
          document.querySelectorAll(".newpost-postlist")[1].innerHTML = html

          // update favorite suggest when client clicked
          document.querySelectorAll(".newpost-postlist")[1].querySelectorAll(".post-favour").forEach(item => {
            item.addEventListener("click", async (e) => { 
              // console.log(item.classList)
              var favIco = item.classList.contains("favour")
              const postClass = [...item.classList].find(c => c.startsWith("post-id-"))
              var post_id = postClass.replace("post-id-", "")

              // create new favorite
              if(!favIco) {
                item.classList.remove("unfavour")
                item.classList.add("favour")
                item.querySelector(".post-favour-ico").setAttribute("src", '<?php echo BASE_URL ?>/assets/img/favour.png')

                try {
                  const response = await fetch("http://backend.test/api/favorites", {
                    method: "POST",
                    headers: {
                      "Accept": "application/json",
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                      "account_id": account_id,
                      "post_id": post_id
                    })
                  })

                  const data = await response.json()
                  if(response.ok) {
                    // console.log(data)
                    if(data) {
                      const favClass = [...item.classList].find(c => c.startsWith("favourite-id-"))
                      if(favClass) {
                        item.classList.remove(favClass)
                        item.classList.add("favourite-id-" + data.favorite.id)
                      }
                    }
                  } else {
                    console.error(err)
                  }
                } catch (err) {
                  console.error(err)
                }
              }

              // delete favorite
              if(favIco) {
                item.classList.remove("favour")
                item.classList.add("unfavour")
                item.querySelector(".post-favour-ico").setAttribute("src", '<?php echo BASE_URL ?>/assets/img/unfavour.png')
                const favClass = [...item.classList].find(c => c.startsWith("favourite-id-"))
                var fav_id = favClass.replace("favourite-id-", "")

                try {
                  const response = await fetch("http://backend.test/api/favorites/" + fav_id, {
                    method: "DELETE",
                    headers: {
                      "Accept": "application/json",
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + token
                    }
                  })

                  const data = await response.json()
                  if(response.ok) {
                    // console.log(data)
                  } else {
                    console.error(err)
                  }
                } catch (err) {
                  console.error(err)
                }
              }
            })
          })
        }
      } else {
        // not login yet
        var posts = await getNewPost()
        // console.log(posts)
        
        if(posts != null && posts.length > 0) {
          let html = ""

          posts.forEach(post => {
            var money = Number(post.price).toLocaleString("vi-VN")
            html += `
              <div class="post">
                <div class="post-favour" style="display: none">
                  <img
                    src='<?php echo BASE_URL . "/assets/img/favour.png" ?>'
                    alt="favour.png"
                    class="post-favour-ico"
                  />
                </div>

                <a href='<?php echo BASE_URL ?>/pages/client/detail-post.php?post_id=${post.id}' class="post-body">
                  <img
                    src='http://backend.test${post.postImages[0].imagePostUrl}'
                    alt="post.png"
                    class="post-img"
                  />

                  <div class="post-title">
                    ${post.title}
                  </div>

                  <div class="post-address">
                    <img
                      src='<?php echo BASE_URL . "/assets/img/address.png" ?>'
                      alt="address.png"
                      class="address-ico"
                    />

                    <div class="address-info">${post.houseNumber}, ${post.ward}, ${post.province}</div>
                  </div>

                  <div class="post-info">
                    <h3 class="post-price">${money} VND/tháng</h3>

                    <div class="post-square">${post.area} m2</div>
                  </div>
                </a>
              </div>
            `
          });
          
          // update post section (not require -> do not have favour button)
          document.querySelectorAll(".newpost-postlist").forEach(item => {
            item.innerHTML = html
          })
        }
      }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      await updateHomePage()
    })
  </script>
</html>
