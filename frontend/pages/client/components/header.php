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

        <!-- Notification -->
        <div class="header-notify">
          <img src='<?php echo BASE_URL . "/assets/img/notify.png"?>' alt="notify.png" class="header-notification">

          <div class="notify-block">
            Thông báo

            <div class="notify-tab">
              <button type="button" class="notify-news notify-selected">Tin tức</button>
              
              <button type="button" class="notify-transaction">Giao dịch</button>

              <!-- <button type="button" class="notify-action">Hoạt động</button> -->
            </div>

            <div class="notify-line"></div>

            <div class="notify-title">
              Thông báo tin tức gần đây
            </div>

            <div class="notify-list"></div>
          </div>

          <div class="notify-alert"></div>
        </div>

        <!-- Manage Posts (Client) -->
        <a href='<?php echo BASE_URL . "/pages/client/manage-post.php" ?>' class="header-button button-posts">
          <img src='<?php echo BASE_URL . "/assets/img/posts-ico.png"?>' alt="posts-ico.png" class="button-posts-ico">
          
          <div class="button-posts-text">Quản lý bài đăng</div>
        </a>

        <!-- Post (Client) -->
        <a href='<?php echo BASE_URL . "/pages/client/new-post.php" ?>' class="header-button button-post">Đăng bài</a>

        <!-- User -->
        <div class="user-block">
          <div class="header-button button-user">
            <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="user-ico.png" class="button-user-ico">

            <img src='<?php echo BASE_URL . "/assets/img/user-arrow.png"?>' alt="user-arrow.png" class="button-user-arrow">
          </div>

          <!-- User Panel -->
            <div class="user-panel">
              <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

              <div class="user-name">Người dùng</div>

              <div class="user-id">Mã KH: xxxx</div>

              <a href='<?php echo BASE_URL . "/pages/client/my-profile.php"?>' class="user-link">Đi tới trang cá nhân</a>

              <div class="user-point-section">
                <div class="user-point-info">
                  Điểm

                  <div class="user-point-value">
                    0

                    <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point.png" class="user-point-img">
                  </div>
                </div>

                <a href='<?php echo BASE_URL . "/pages/client/recharge.php"?>' class="user-point-btn">Nạp ngay</a>
              </div>

              <div class="user-extend">Tiện ích</div>

              <div class="user-list">
                <a href='<?php echo BASE_URL . "/pages/client/favourite.php"?>' class="user-favourite">
                  <img src='<?php echo BASE_URL . "/assets/img/favourite-ico.png"?>' alt="favourite-ico.png" class="user-favourite-ico">

                  <span>Bài đăng đã thích</span>

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </a>
                
                <a href='<?php echo BASE_URL . "/pages/client/suggest.php"?>' class="user-suggest">
                  <img src='<?php echo BASE_URL . "/assets/img/suggest-ico.png"?>' alt="suggest-ico.png"  class="user-suggest-ico">

                  <span>Đề xuất của bạn</span>

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </a>
                
                <a href='<?php echo BASE_URL . "/pages/client/history.php"?>' class="user-transaction">
                  <img src='<?php echo BASE_URL . "/assets/img/transaction-ico.png"?>' alt="transaction-ico.png"  class="user-transaction-ico">

                  <span>Lịch sử giao dịch</span>

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </a>
              </div>

              <div class="user-other">Khác</div>

              <a href='<?php echo BASE_URL . "/pages/client/setting-profile.php"?>' class="user-setting">
                <img src='<?php echo BASE_URL . "/assets/img/setting-ico.png"?>' alt="setting-ico.png"  class="user-setting-ico">

                Cài đặt tài khoản

                <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
              </a>

              <div class="user-logout">
                <img src='<?php echo BASE_URL . "/assets/img/logout-ico.png"?>' alt="logout-ico.png"  class="user-logout-ico">

                Đăng xuất
              </div>
            </div>
        </div>
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

          <div class="sidebar-notify-block">
            <div class="sidebar-item sidebar-notification">
              Thông báo
            </div>

            <div class="menu-notify-block">
                <div class="notify-tab">
                  <button type="button" class="notify-news notify-selected">Tin tức</button>
                  
                  <button type="button" class="notify-transaction">Giao dịch</button>

                  <!-- <button type="button" class="notify-action">Hoạt động</button> -->
                </div>

                <div class="notify-line"></div>

                <div class="notify-title">
                  Thông báo tin tức gần đây
                </div>

                <div class="notify-list"></div>
              </div>
          </div>

          <a href='<?php echo BASE_URL . "/pages/client/manage-post.php" ?>' class="sidebar-item sidebar-posts">Quản lý bài đăng</a>

          <a href='<?php echo BASE_URL . "/pages/client/new-post.php" ?>' class="sidebar-item sidebar-post">Đăng bài</a>

          <div class="sidebar-user-block">
            <div class="sidebar-item sidebar-user">
              Tài khoản
            </div>

            <!-- User Panel -->
              <div class="menu-user-panel">
                <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

                <div class="user-name">Người dùng</div>

                <div class="user-id">Mã KH: xxxx</div>

                <a href='<?php echo BASE_URL . "/pages/client/my-profile.php"?>' class="user-link">Đi tới trang cá nhân</a>

                <div class="user-point-section">
                  <div class="user-point-info">
                    Điểm

                    <div class="user-point-value">
                      0

                      <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point.png" class="user-point-img">
                    </div>
                  </div>

                  <a href='<?php echo BASE_URL . "/pages/client/recharge.php"?>' class="user-point-btn">Nạp ngay</a>
                </div>

                <div class="user-extend">Tiện ích</div>

                <div class="user-list">
                  <a href='<?php echo BASE_URL . "/pages/client/favourite.php"?>' class="user-favourite">
                    <img src='<?php echo BASE_URL . "/assets/img/favourite-ico.png"?>' alt="favourite-ico.png" class="user-favourite-ico">

                    Bài đăng đã thích

                    <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                  </a>
                  
                  <a href='<?php echo BASE_URL . "/pages/client/suggest.php"?>' class="user-suggest">
                    <img src='<?php echo BASE_URL . "/assets/img/suggest-ico.png"?>' alt="suggest-ico.png"  class="user-suggest-ico">

                    Đề xuất của bạn

                    <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                  </a>
                  
                  <a href='<?php echo BASE_URL . "/pages/client/history.php"?>' class="user-transaction">
                    <img src='<?php echo BASE_URL . "/assets/img/transaction-ico.png"?>' alt="transaction-ico.png"  class="user-transaction-ico">

                    Lịch sử giao dịch

                    <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                  </a>
                </div>

                <div class="user-other">Khác</div>

                <a href='<?php echo BASE_URL . "/pages/client/setting-profile.php"?>' class="user-setting">
                  <img src='<?php echo BASE_URL . "/assets/img/setting-ico.png"?>' alt="setting-ico.png"  class="user-setting-ico">

                  Cài đặt tài khoản

                  <img src='<?php echo BASE_URL . "/assets/img/arrow.png"?>' alt="arrow.png" class="user-arrow">
                </a>

                <div class="user-logout">
                  <img src='<?php echo BASE_URL . "/assets/img/logout-ico.png"?>' alt="logout-ico.png"  class="user-logout-ico">

                  Đăng xuất
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    // menu button script
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

    // notification script
    const notify_button = document.querySelector(".header-notification");
    const notify_block = document.querySelector(".notify-block");

    notify_button.addEventListener("click", (e) => {
      if (notify_block.style.display == "flex") {
        notify_block.style.display = "none";
      } else {
        notify_block.style.display = "flex";
      }
    });

    const notify_sidebar = document.querySelector(".sidebar-notification");
    const menu_notify_block = document.querySelector(".menu-notify-block");

    notify_sidebar.addEventListener("click", (e) => {
      if (menu_notify_block.style.display == "flex") {
        menu_notify_block.style.display = "none";
      } else {
        menu_notify_block.style.display = "flex";
      }
    });

    // user panel script
    const user_button = document.querySelector(".button-user");
    const user_button_ico = document.querySelector(".button-user-arrow");
    const user_block = document.querySelector(".user-panel");

    user_button.addEventListener("click", (e) => {
      if (user_block.style.display == "flex") {
        user_block.style.display = "none";
        user_button_ico.style.transform = "rotate(0deg)";
      } else {
        user_block.style.display = "flex";
        user_button_ico.style.transform = "rotate(180deg)";
      }
    });

    const menu_user_button = document.querySelector(".sidebar-user");
    const menu_user_block = document.querySelector(".menu-user-panel");

    menu_user_button.addEventListener("click", (e) => {
      if (menu_user_block.style.display == "flex") {
        menu_user_block.style.display = "none";
      } else {
        menu_user_block.style.display = "flex";
      }
    });

    // check user token and update header bar
    async function getPersonalInfo(account_id, token) {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/accounts/" + account_id + "?include=user.personalInfo", {
          method: "GET",
          headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + token
          }
        })

        const data = await response.json()
        if(response.ok) {
          if(data.data.user.personalInfo.profileUrl) {
            document.querySelector(".button-user-ico").setAttribute("src", data.data.user.personalInfo.profileUrl)
            
            document.querySelectorAll(".user-avatar").forEach(item => {
              item.setAttribute("src", data.data.user.personalInfo.profileUrl)
            })
          }

          if(data.data.username) {
            document.querySelectorAll(".user-name").forEach(item => {
              item.textContent = data.data.username
            })
          }
          
          if(data.data.id) {
            document.querySelectorAll(".user-id").forEach(item => {
              item.textContent = "Mã KH: " + data.data.id
            })
          }
          
          if(data.data.user.points) {
            document.querySelectorAll(".user-point-value").forEach(item => {
              var point_value = data.data.user.points

              // beautify number
              item.textContent = point_value.toLocaleString("vi-VN")
            })
          }
        } else {
          console.error(data)
        }
      } catch (err) {
        console.error(err)
      }
    }

    var notifyCache = {
      news: null,
      transaction: null,
    newsExpiredAt: null,
    transactionExpiredAt: null
    }

    const CACHE_TTL = 30 * 1000

    async function checkUnreadNotification(account_id, token) {
      const newsUnread = notifyCache.news?.unread?.length > 0
      const transactionUnread = notifyCache.transaction?.unread?.length > 0

      if (notifyCache.news !== null && notifyCache.transaction !== null) {
          const hasUnread = newsUnread || transactionUnread
          document.querySelector(".notify-alert").style.display = hasUnread ? "block" : "none"
          return
      }

      try {
        const [res_news, res_transaction] = await Promise.all([
          fetch("http://127.0.0.1:8000/api/notifications?filter[account.id]=" + account_id + "&filter[status]=unread&filter[notificationType]=news", {
              headers: { "Accept": "application/json", "Authorization": "Bearer " + token }
          }),
          fetch("http://127.0.0.1:8000/api/notifications?filter[account.id]=" + account_id + "&filter[status]=unread&filter[notificationType]=transaction", {
              headers: { "Accept": "application/json", "Authorization": "Bearer " + token }
          })
        ])

        const data_news = await res_news.json()
        const data_transaction = await res_transaction.json()

        const hasUnread = (data_news.data?.length > 0) || (data_transaction.data?.length > 0)
        document.querySelector(".notify-alert").style.display = hasUnread ? "block" : "none"
      } catch (err) {
        console.error(err)
      }
    }

    async function getNotification(account_id, token) {
      var isNews = false
      var isTransaction = false   

      // news notification
      if(document.querySelector(".notify-news").classList.contains("notify-selected")) {  
        var isUnread = true
        var isRead = true
        var unread_notifyList = []
        var read_notifyList = []

        if(!notifyCache.news || Date.now() > notifyCache.newsExpiredAt) {
          try {
            // get unread & read notify in news
            const [response_unread, response_read] = await Promise.all([fetch("http://127.0.0.1:8000/api/notifications?include=account&filter[account.id]=" + account_id + "&filter[status]=unread&filter[notificationType]=news", {
              method: "GET",
              headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token
              }
            }),fetch("http://127.0.0.1:8000/api/notifications?include=account&filter[account.id]=" + account_id + "&filter[status]=read&filter[notificationType]=news", {
              method: "GET",
              headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token
              }
            })])

            const [data_unread, data_read] = await Promise.all([response_unread.json(), response_read.json()])

            if(response_unread.ok) {
              if(data_unread.data && data_unread.data.length > 0) {
                // get list and append into array
                unread_notifyList = data_unread.data
                // console.log(data_unread.data)
              } else {
                isUnread = false // the unread array is empty
              }
            } else {
              console.error(data_unread)
            }

            if(response_read.ok) {
              if(data_read.data && data_read.data.length > 0) {
                // get list and append into array
                read_notifyList = data_read.data
                // console.log(data_read.data)
              } else {
                isRead = false // the unread array is empty
              }
            } else {
              console.error(data_read)
            }
          
            // store in cache for next using
            notifyCache.news = {
              unread: data_unread.data?.length > 0 ? data_unread.data : [],
              read: data_read.data?.length > 0 ? data_read.data : []
            }
            // expired time for the next fetch
            notifyCache.newsExpiredAt = Date.now() + CACHE_TTL
          } catch (err) {
            console.error(err)
          }
        } else {
          if(notifyCache.news.unread) {
            isUnread = true
            unread_notifyList = notifyCache.news.unread
          } else {
            isUnread = false
          }
          
          if(notifyCache.news.read) {
            isRead = true
            read_notifyList = notifyCache.news.read
          } else {
            isRead = false
          }
        }

        // no news notification
        if(!isRead && !isUnread) {
          isNews = false
          document.querySelector(".notify-list").textContent = "Không có thông báo nào gần đây."
        } else {
          // news notification
          // insert all item in array to notify-list with css format
          isNews = true
          let html = ""

          if(isUnread) {
            unread_notifyList.forEach(notify => {
              html += `
                <a href='<?php echo BASE_URL ?>/pages/client/detail-post.php?post_id=${notify.notifiable.id}' class="notify-item notify-item-unread notify-id-${notify.id}">
                  <img src='http://127.0.0.1:8000${notify.notifiable.postImages[0].imagePostUrl}' alt="item-img.png" class="notify-item-img">

                  <div class="notify-content">
                    <div class="notify-info">${notify.title}</div>

                    <!-- using for transaction -->
                    <div class="notify-value">${notify.content}</div>
                  </div>
                </a>
              `
            })
          }

          if(isRead) {
            read_notifyList.forEach(notify => {
              html += `
                <a href='<?php echo BASE_URL ?>/pages/client/detail-post.php?post_id=${notify.notifiable.id}' class="notify-item notify-id-${notify.id}">
                  <img src='http://127.0.0.1:8000${notify.notifiable.postImages[0].imagePostUrl}' alt="item-img.png" class="notify-item-img">

                  <div class="notify-content">
                    <div class="notify-info">${notify.title}</div>

                    <!-- using for transaction -->
                    <div class="notify-value">${notify.content}</div>
                  </div>
                </a>
              `
            })
          }

          document.querySelectorAll(".notify-list").forEach(item => {
            item.innerHTML = html
          })

          // Mark as read after click an unread notification
          document.querySelectorAll(".notify-item").forEach(item => {
            item.addEventListener("click", async (e) => {
              e.preventDefault()

              if(item.classList.contains("notify-item-unread")) {
                item.classList.remove("notify-item-unread")
                const notify_id = item.classList.item(1).replace("notify-id-", "")

                const token = localStorage.getItem("token")
                const account_id = localStorage.getItem("account_id")

                var notification_type = document.querySelector(".notify-news").classList.contains("notify-selected") ? "news" : "transaction"

                try {
                  const response = await fetch("http://127.0.0.1:8000/api/notifications/" + notify_id, {
                    method: "PUT",
                    headers: {
                      "Accept": "application/json",
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                      "status": "read"
                    })
                  })

                  const data = await response.json()
                  if(response.ok) {
                    // console.log(data)

                    // reset cache
                    notifyCache.news = null
                  } else {
                    console.error(data)
                  }
                } catch (err) {
                  console.error(err)
                }
              }

              window.location.href = item.getAttribute("href")
            })
          })
        }
      }

      // transaction notification
      if(document.querySelector(".notify-transaction").classList.contains("notify-selected")) {  
        var isUnread = true
        var isRead = true
        var unread_notifyList = []
        var read_notifyList = []

        if(!notifyCache.transaction || Date.now() > notifyCache.transactionExpiredAt) {
          try {
            // get unread & read notify in transaction
            const [response_unread, response_read] = await Promise.all([fetch("http://127.0.0.1:8000/api/notifications?include=account&filter[account.id]=" + account_id + "&filter[status]=unread&filter[notificationType]=transaction", {
              method: "GET",
              headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token
              }
            }),fetch("http://127.0.0.1:8000/api/notifications?include=account&filter[account.id]=" + account_id + "&filter[status]=read&filter[notificationType]=transaction", {
              method: "GET",
              headers: {
                "Accept": "application/json",
                "Authorization": "Bearer " + token
              }
            })])

            const [data_unread, data_read] = await Promise.all([response_unread.json(), response_read.json()])

            if(response_unread.ok) {
              if(data_unread.data && data_unread.data.length > 0) {
                // get list and append into array
                unread_notifyList = data_unread.data
                // console.log(data_unread.data)
              } else {
                isUnread = false // the unread array is empty
              }
            } else {
              console.error(data_unread)
            }

            if(response_read.ok) {
              if(data_read.data && data_read.data.length > 0) {
                // get list and append into array
                read_notifyList = data_read.data
                // console.log(data_read.data)
              } else {
                isRead = false // the unread array is empty
              }
            } else {
              console.error(data_read)
            }

            // store in cache for next using
            notifyCache.transaction = {
                unread: data_unread.data?.length > 0 ? data_unread.data : [],
                read: data_read.data?.length > 0 ? data_read.data : []
            }
            // expired time for the next fetch
            notifyCache.transactionExpiredAt = Date.now() + CACHE_TTL
          } catch (err) {
            console.error(err)
          }
        } else {
          if(notifyCache.transaction.unread) {
            isUnread = true
            unread_notifyList = notifyCache.transaction.unread
          } else {
            isUnread = false
          }
          
          if(notifyCache.transaction.read) {
            isRead = true
            read_notifyList = notifyCache.transaction.read
          } else {
            isRead = false
          }
        }

        // no transaction notification
        if(!isRead && !isUnread) {
          isTransaction = false
          document.querySelector(".notify-list").textContent = "Không có thông báo nào gần đây."
        } else {
          // transaction notification
          // insert all item in array to notify-list with css format
          isTransaction = true
          let html = ""

          if(isUnread) {
            unread_notifyList.forEach(notify => {
              var notifyValue = ""
              var notifyContent = notify.content
              if (notifyContent.includes("successfully")) notifyValue = "value-add"
              if (notifyContent.includes("failed")) notifyValue = "value-subtract"
              if (notifyContent.includes("being processed")) notifyValue = "value-pending"
              html += `
                <a href='<?php echo BASE_URL ?>/pages/client/history.php?post_id=${notify.notifiable.id}' class="notify-item notify-item-unread notify-id-${notify.id}">
                  <img src='<?php echo BASE_URL . "/assets/img/transaction-img.png"?>' alt="item-img.png" class="notify-item-img">

                  <div class="notify-content">
                    <div class="notify-info">${notify.title}</div>

                    <!-- using for transaction -->
                    <div class="notify-value ${notifyValue}">${notify.content}</div>
                  </div>
                </a>
              `
            })
          }

          if(isRead) {
            read_notifyList.forEach(notify => {
              var notifyValue = ""
              var notifyContent = notify.content
              if (notifyContent.includes("successfully")) notifyValue = "value-add"
              if (notifyContent.includes("failed")) notifyValue = "value-subtract"
              if (notifyContent.includes("being processed")) notifyValue = "value-pending"
              html += `
                <a href='<?php echo BASE_URL ?>/pages/client/history.php?post_id=${notify.notifiable.id}' class="notify-item notify-id-${notify.id}">
                  <img src='<?php echo BASE_URL . "/assets/img/transaction-img.png"?>' alt="item-img.png" class="notify-item-img">

                  <div class="notify-content">
                    <div class="notify-info">${notify.title}</div>

                    <!-- using for transaction -->
                    <div class="notify-value ${notifyValue}">${notify.content}</div>
                  </div>
                </a>
              `
            })
          }

          document.querySelectorAll(".notify-list").forEach(item => {
            item.innerHTML = html
          })

          // Mark as read after click an unread notification
          document.querySelectorAll(".notify-item").forEach(item => {
            item.addEventListener("click", async (e) => {
              e.preventDefault()

              if(item.classList.contains("notify-item-unread")) {
                item.classList.remove("notify-item-unread")
                const notify_id = item.classList.item(1).replace("notify-id-", "")

                const token = localStorage.getItem("token")
                const account_id = localStorage.getItem("account_id")

                var notification_type = document.querySelector(".notify-news").classList.contains("notify-selected") ? "news" : "transaction"

                try {
                  const response = await fetch("http://127.0.0.1:8000/api/notifications/" + notify_id, {
                    method: "PUT",
                    headers: {
                      "Accept": "application/json",
                      "Content-Type": "application/json",
                      "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                      "status": "read"
                    })
                  })

                  const data = await response.json()
                  if(response.ok) {
                    // console.log(data)
                    notifyCache.transaction = null
                  } else {
                    console.error(data)
                  }
                } catch (err) {
                  console.error(err)
                }
              }

              window.location.href = item.getAttribute("href")
            })
          })
        }
      }

      // update notify button
      await checkUnreadNotification(account_id, token)
    }

    async function updateHeader() {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      if(account_id && token) {
        await Promise.all([
          getPersonalInfo(account_id, token),
          checkUnreadNotification(account_id, token)
        ])

        // update header buttons
        document.querySelector(".button-sign-up").style.display = "none"
        document.querySelector(".button-log-in").style.display = "none"

        document.querySelector(".header-notify").style.display = "flex"
        document.querySelector(".button-post").style.display = "flex"
        document.querySelector(".button-posts").style.display = "flex"
        document.querySelector(".user-block").style.display = "flex"

        document.querySelector(".sidebar-signup").style.display = "none"
        document.querySelector(".sidebar-login").style.display = "none"

        document.querySelector(".sidebar-notify-block").style.display = "flex"
        document.querySelector(".sidebar-post").style.display = "flex"
        document.querySelector(".sidebar-posts").style.display = "flex"
        document.querySelector(".sidebar-user-block").style.display = "flex"
      } else {
        // console.log(data)
        document.querySelector(".button-sign-up").style.display = "flex"
        document.querySelector(".button-log-in").style.display = "flex"
      }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      await updateHeader()
    })

    // Notification button
    document.querySelector(".header-notify").addEventListener("click", async (e) => {
      // reset cache
      // notifyCache.news = null
      // notifyCache.transaction = null

      const account_id = localStorage.getItem("account_id")
      const token = localStorage.getItem("token")
      await getNotification(account_id, token)
    })

    var isLoadingNotify = false

    document.querySelector(".notify-news").addEventListener("click", async (e) => {
      if(isLoadingNotify) return
      if (!document.querySelector(".notify-news").classList.contains("notify-selected")) {
        isLoadingNotify = true
        document.querySelector(".notify-list").style.display = "none"
        document.querySelector(".notify-title").style.display = "none" 
        document.querySelector(".notify-news").classList.add("notify-selected")
        document.querySelector(".notify-transaction").classList.remove("notify-selected")

        const account_id = localStorage.getItem("account_id")
        const token = localStorage.getItem("token")
        await getNotification(account_id, token)
        document.querySelector(".notify-list").style.display = "flex"
        document.querySelector(".notify-title").textContent = "Thông báo tin tức gần đây"
        document.querySelector(".notify-title").style.display = "flex" 
        isLoadingNotify = false
      }
    })

    document.querySelector(".notify-transaction").addEventListener("click", async (e) => {
      if(isLoadingNotify) return
      if (!document.querySelector(".notify-transaction").classList.contains("notify-selected")) {
        isLoadingNotify = true
        document.querySelector(".notify-list").style.display = "none"
        document.querySelector(".notify-title").style.display = "none" 
        document.querySelector(".notify-transaction").classList.add("notify-selected")
        document.querySelector(".notify-news").classList.remove("notify-selected")

        const account_id = localStorage.getItem("account_id")
        const token = localStorage.getItem("token")
        await getNotification(account_id, token)
        document.querySelector(".notify-list").style.display = "flex"
        document.querySelector(".notify-title").textContent = "Thông báo giao dịch gần đây"
        document.querySelector(".notify-title").style.display = "flex" 
        isLoadingNotify = false
      }
    })

    // log out button
    document.querySelector(".user-logout").addEventListener("click", async (e) => {
      const token = localStorage.getItem("token")

      try {
        const response = await fetch("http://127.0.0.1:8000/api/logout", {
          method: "POST",
          headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + token
          }
        })

        const data = await response.json()
        if(response.ok) {
          console.log(data.message)
          localStorage.removeItem("account_id")
          localStorage.removeItem("token")
          if(data.message == "Logged out successfully") {
            alert("Bạn đã đăng xuất. Hẹn gặp lại!")
          }
          window.location.reload()
        } else {
          console.error(data)
        }
      } catch (err) {
        console.error(err)
      }
    })
  </script>
</html>
