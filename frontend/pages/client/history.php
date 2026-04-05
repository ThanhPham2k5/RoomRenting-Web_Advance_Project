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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/history.css" ?>'/>

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
    <title>History Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
    
    <div class="history-block">
        <div class="history">
            <div class="user-profile">
                <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

                <div class="user-profile-info">
                    <div class="user-name">Người dùng</div>

                    <div class="user-point-section">
                        <div class="user-point-info">
                        Điểm

                        <div class="user-point-value">
                            0

                            <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point.png" class="user-point-img">
                        </div>
                        </div>

                        <a href='<?php echo BASE_URL . "/pages/client/recharge.php"?>'" class="user-point-btn">Nạp ngay</a>
                    </div>
                </div>
            </div>

            <h3 class="history-title">Lịch sử giao dịch</h3>

            <div class="history-line"></div>

            <div class="history-tab">
                <div class="history-recharge history-selected">
                    <img src='<?php echo BASE_URL . "/assets/img/recharge-ico.png"?>' alt="recharge-ico.png" class="history-recharge-ico">

                    Lịch sử nạp
                </div>

                <div class="history-pay">
                    <img src='<?php echo BASE_URL . "/assets/img/pay-ico.png"?>' alt="pay-ico.png" class="history-pay-ico">

                    Lịch sử trừ
                </div>
            </div>

            <div class="history-board">
                <h3 class="history-board-title">Lịch sử nạp</h3>

                <div class="history-notify-list">
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
            </div>
        </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
  <script>
    // filter & sort & page value
    var page = 1
    var lastPage = 1

    // pagination button
    document.querySelector(".page-extra-prev").addEventListener("click", async (e) => {
      page = 1
      await updateHistoryPage()
    })

    document.querySelector(".page-prev").addEventListener("click", async (e) => {
      page = Math.max(1, page - 1)
      await updateHistoryPage()
    })

    document.querySelector(".page-extra-next").addEventListener("click", async (e) => {
      page = lastPage
      await updateHistoryPage()
    })

    document.querySelector(".page-next").addEventListener("click", async (e) => {
      page = Math.min(lastPage, page + 1)
      await updateHistoryPage()
    })
    
    document.querySelector(".page-prev-number").addEventListener("click", async (e) => {
      page = parseInt(document.querySelector(".page-prev-number").textContent.trim())
      await updateHistoryPage()
    })
    
    document.querySelector(".page-current-number").addEventListener("click", async (e) => {
      page = parseInt(document.querySelector(".page-current-number").textContent.trim())
      await updateHistoryPage()
    })
    
    document.querySelector(".page-next-number").addEventListener("click", async (e) => {
      page = parseInt(document.querySelector(".page-next-number").textContent.trim())
      await updateHistoryPage()
    })

    document.querySelector(".page-number").addEventListener("change", async (e) => {
      const pageNumber = document.querySelector(".page-number").value.trim()
      if(!pageNumber)
        page = 1
      else 
        page =  Math.min(lastPage, Math.max(1, parseInt(pageNumber)))

      document.querySelector(".page-number").value = page
      await updateHistoryPage()
    })

    function updatePageNumber() {
      const prevPage = document.querySelector(".page-prev-number")
      const currPage = document.querySelector(".page-current-number")
      const nextPage = document.querySelector(".page-next-number")

      // only 1 page
      if (page === 1 && lastPage === 1) {
          prevPage.textContent = 1
          prevPage.classList.add("page-selected")
          currPage.textContent = 2
          currPage.classList.remove("page-selected")
          currPage.classList.add("page-none")
          nextPage.textContent = 3
          nextPage.classList.remove("page-selected")
          nextPage.classList.add("page-none")

      // 2 page
      } else if (lastPage === 2) {
          nextPage.textContent = 3
          nextPage.classList.remove("page-selected")
          nextPage.classList.add("page-none")

          if (page === 1) {
              prevPage.textContent = 1
              prevPage.classList.add("page-selected")
              currPage.textContent = 2
              currPage.classList.remove("page-selected")
              currPage.classList.remove("page-none")
          } else {
              prevPage.textContent = 1
              prevPage.classList.remove("page-selected")
              currPage.textContent = 2
              currPage.classList.add("page-selected")
              currPage.classList.remove("page-none")
          }

      // 3+ page
      } else {
          currPage.classList.remove("page-none")
          nextPage.classList.remove("page-none")

          if (page === 1) {
              prevPage.textContent = 1
              prevPage.classList.add("page-selected")
              currPage.textContent = 2
              currPage.classList.remove("page-selected")
              nextPage.textContent = 3
              nextPage.classList.remove("page-selected")
          } else if (page === lastPage) {
              nextPage.textContent = lastPage
              nextPage.classList.add("page-selected")
              currPage.textContent = lastPage - 1
              currPage.classList.remove("page-selected")
              prevPage.textContent = lastPage - 2
              prevPage.classList.remove("page-selected")
          } else if (page > 1 && page < lastPage) {
              currPage.textContent = page
              currPage.classList.add("page-selected")
              prevPage.textContent = page - 1
              prevPage.classList.remove("page-selected")
              nextPage.textContent = page + 1
              nextPage.classList.remove("page-selected")
          }
      }
    }

    // history tab
    document.querySelector(".history-recharge").addEventListener("click", async (e) => {
        if(!document.querySelector(".history-recharge").classList.contains("history-selected")) {
            document.querySelector(".history-recharge").classList.add("history-selected")
            document.querySelector(".history-pay").classList.remove("history-selected")
            await updateHistoryPage()
        }
    })
    
    document.querySelector(".history-pay").addEventListener("click", async (e) => {
        if(!document.querySelector(".history-pay").classList.contains("history-selected")) {
            document.querySelector(".history-pay").classList.add("history-selected")
            document.querySelector(".history-recharge").classList.remove("history-selected")
            await updateHistoryPage()
        }
    })

    async function getBill(account_id, token, billType, page) {
        try {
            const response = await fetch("http://backend.test/api/" + billType + "?per_page=10&include=account&filter[account.id]=" + account_id + "&filter[status]=completed&page=" + page + "&sort=-createdAt", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            })

            const data = await response.json()
            if(response.ok) {
                if(data.data) {
                    lastPage = data.meta.last_page
                    return data.data
                }
            } else {
                console.error(data)
            }
        } catch (err) {
            console.error(err)
        }
    }

    async function updateHistoryPage() {
        const account_id = localStorage.getItem("account_id")
        const token = localStorage.getItem("token")

        if(account_id != null && token != null) {
            var billType = document.querySelector(".history-recharge").classList.contains("history-selected") ? "rechargeBills" : "payBills"
            var valueItem = document.querySelector(".history-recharge").classList.contains("history-selected") ? "value-add" : "value-subtract"
            var billTitle = document.querySelector(".history-recharge").classList.contains("history-selected") ? "Thêm điểm" : "Trừ điểm"
            document.querySelector(".history-board-title").textContent = document.querySelector(".history-recharge").classList.contains("history-selected") ? "Lịch sử nạp" : "Lịch sử trừ"

            const histories = await getBill(account_id, token, billType, page)

            if(histories != null && histories.length > 0) {
                let html = ""

                histories.forEach(history => {
                    var point = Number(history.points).toLocaleString("vi-VN")
                    var date = new Date(history.createdAt).toLocaleString("vi-VN")

                    html += `
                        <div class="notify-item">
                            <img src='<?php echo BASE_URL . "/assets/img/transaction-img.png"?>' alt="item-img.png" class="notify-item-img">

                            <div class="notify-content">
                            <div class="notify-info">${billTitle} vào tài khoản thành công</div>

                            <!-- using for transaction -->
                            <div class="notify-value ${valueItem}">+${point} Điểm ( Nạp thêm điểm thành công )</div>

                            <div class="notify-time">${date}</div>
                            </div>
                        </div>
                    `
                });

                document.querySelector(".history-notify-list").innerHTML = html

                updatePageNumber()
            } else {
                document.querySelector(".history-notify-list").textContent = "Chưa có lịch sử giao dịch."
                updatePageNumber()
            }
        } else {
            alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
            window.location.href = "login.php"
        }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      await updateHistoryPage()
    })
  </script>
</html>