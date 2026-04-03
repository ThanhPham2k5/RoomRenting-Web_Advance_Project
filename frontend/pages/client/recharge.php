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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/recharge.css" ?>'/>

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
    <title>Recharge Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
    
    <div class="recharge-block">
      <div class="recharge">
        <h3 class="recharge-title">Quy đổi giá trị nạp</h3>

        <div class="recharge-line"></div>

        <div class="recharge-point">
          <label for="recharge-point-input" class="recharge-point-lb"><h3>Số điểm nạp</h3></label>

          <div class="recharge-point-enter">
            <input type="number" name="recharge-point-input" id="recharge-point-input" class="recharge-point-input"
            min="0"
            placeholder="Nhập số điểm cần nạp">

            <img src='<?php echo BASE_URL . "/assets/img/point.png"?>' alt="point-ico.png" class="recharge-point-ico">
          </div>
        </div>

        <div class="recharge-info">
          <div class="recharge-info-title"><h3>Thông tin nạp tiền</h3></div>

          <div class="recharge-ratio">
            <div class="recharge-coin">
              <img src='<?php echo BASE_URL . "/assets/img/point.png"?>'  alt="coin-ico.png" class="recharge-coin-ico">

              <div class="recharge-coin-value">0 điểm</div>
            </div>

            <img src='<?php echo BASE_URL . "/assets/img/recharge-arrow.png"?>' alt="arrow.png" class="recharge-arrow">
            
            <div class="recharge-money">
              <img src='<?php echo BASE_URL . "/assets/img/money.png"?>'  alt="money-ico.png" class="recharge-money-ico">

              <div class="recharge-money-value">0 VND</div>
            </div>
          </div>

          <div class="recharge-board">
            <div class="recharge-total">
              <div class="recharge-total-title">Tổng</div>

              <div class="recharge-total-value">0 VND</div>
            </div>

            <div class="recharge-vat">
              <div class="recharge-vat-title">Thuế VAT (10%)</div>

              <div class="recharge-vat-value">0 VND</div>
            </div>

            <div class="recharge-line"></div>

            <div class="recharge-sum">
              <div class="recharge-sum-title">Tổng tiền thanh toán</div>

              <div class="recharge-sum-value">0 VND</div>
            </div>
          </div>
        </div>

        <div class="payment">
          <div class="pament-title"><h3>Phương thức thanh toán</h3></div>
          
          <div class="payment-banking">
            <img src='<?php echo BASE_URL . "/assets/img/banking-ico.png"?>' alt="banking-ico.png" class="payment-banking-ico">

            <label for="payment-banking-input" class="payment-banking-lb">Chuyển khoản ngân hàng</label>

            <input type="radio" name="payment-method" id="payment-banking-input" class="payment-banking-input"
            checked>
          </div>

          <div class="payment-momo">
            <img src='<?php echo BASE_URL . "/assets/img/momo-ico.png"?>' alt="momo-ico.png" class="payment-momo-ico">

            <label for="payment-momo-input" class="payment-momo-lb">Ví MoMo</label>

            <input type="radio" name="payment-method" id="payment-momo-input" class="payment-momo-input">
          </div>

          <div class="payment-zalo">
            <img src='<?php echo BASE_URL . "/assets/img/zalo-ico.png"?>' alt="zalo-ico.png" class="payment-zalo-ico">

            <label for="payment-zalo-input" class="payment-zalo-lb">Ví ZaloPay</label>

            <input type="radio" name="payment-method" id="payment-zalo-input" class="payment-zalo-input">
          </div>

          <div class="payment-interal-bank">
            <img src='<?php echo BASE_URL . "/assets/img/interal-bank-ico.png"?>' alt="interal-bank-ico.png" class="payment-interal-bank-ico">

            <label for="payment-interal-bank-input" class="payment-interal-bank-lb">Thẻ ngân hàng nội địa</label>

            <input type="radio" name="payment-method" id="payment-interal-bank-input" class="payment-interal-bank-input">
          </div>

          <div class="payment-global-bank">
            <img src='<?php echo BASE_URL . "/assets/img/global-bank-ico.png"?>' alt="global-bank-ico.png" class="payment-global-bank-ico">

            <label for="payment-global-bank-input" class="payment-global-bank-lb">Thẻ quốc tế</label>

            <input type="radio" name="payment-method" id="payment-global-bank-input" class="payment-global-bank-input">
          </div>
        </div>

        <a href='<?php echo BASE_URL . "/pages/client/payment.php"?>' type="button" class="recharge-pay">Thanh toán</a>
      </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>

  <script>
    var rechargeId = ""
    var point = 0
    var money = 0

    // auto update number data
    document.querySelector(".recharge-point-input").addEventListener("change", (e) => {
      const input = Number(document.querySelector(".recharge-point-input").value.trim())

      document.querySelector(".recharge-coin-value").textContent = input.toLocaleString("vi-VN") + " điểm"

      document.querySelector(".recharge-money-value").textContent = Math.ceil(input * money / point).toLocaleString("vi-VN") + " VND"

      document.querySelector(".recharge-total-value").textContent = Math.ceil(input * money / point).toLocaleString("vi-VN") + " VND"

      document.querySelector(".recharge-vat-value").textContent = Math.ceil((input * money / point) * 10 / 100).toLocaleString("vi-VN") + " VND"

      document.querySelector(".recharge-sum-value").textContent = Math.ceil((input * money / point) * 110 / 100).toLocaleString("vi-VN") + " VND"
    })

    // submit button
    document.querySelector(".recharge-pay").addEventListener("click", async (e) => {
      e.preventDefault()
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")
      const input = Number(document.querySelector(".recharge-point-input").value.trim())

      if(account_id != null && token != null) {
        try {
          const response = await fetch("http://127.0.0.1:8000/api/rechargeBills", {
            method: "POST",
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/json",
              "Authorization": "Bearer " + token
            },
            body: JSON.stringify({
              "money": Math.ceil(input * money / point),
              "total_money": Math.ceil((input * money / point) * 110 / 100),
              "status": "completed",
              "vat": Math.ceil((input * money / point) * 10 / 100),
              "recharge_rule_id": rechargeId,
              "account_id": account_id
            })
          })

          const data = await response.json()
          if(response.ok) {
            if(data.message === "Recharge bill created successfully") {
              alert("Đã nạp điểm thành công.")
              window.location.reload()
            }
          } else {
            console.error(data)
          }
        } catch (err) {
          console.error(err)
        }
      }
    })

    async function getRechargeRule(account_id, token) {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/rechargeRules", {
          method: "GET",
          headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + token
          }
        })

        const data = await response.json()
        if(response.ok) {
          if(data.data) {
            data.data.forEach(rule => {
              if(rule.deletedAt == null) {
                rechargeId = rule.id
                point = rule.points
                money = rule.money
              }
            })
            console.log(rechargeId)
            console.log(point)
            console.log(money)
          }
        } else {
          console.error(data)
        }
      } catch (err) {
        console.error(err)
      }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      if(account_id != null && token != null) {
        await getRechargeRule(account_id, token)
      } else {
        alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
        window.location.href = "login.php"
      }
    })
  </script>
</html>