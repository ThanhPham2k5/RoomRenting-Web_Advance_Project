<?php
  include(__DIR__ . "/core/config.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='<?php echo BASE_URL. "/css/client/reset.css" ?>'/>
    <link rel="stylesheet" href='<?php echo BASE_URL. "/css/client/main.css" ?>'/>
    <link rel="stylesheet" href='<?php echo BASE_URL. "/css/client/pages/login.css" ?>'/>

    <link
      rel="icon"
      type="image/png"
      href='<?php echo BASE_URL. "/assets/favicon/favicon-96x96.png" ?>'
      sizes="96x96"
    />
    <link
      rel="icon"
      type="image/svg+xml"
      href='<?php echo BASE_URL. "/assets/favicon/favicon.svg" ?>'
    />
    <link rel="shortcut icon" href='<?php echo BASE_URL. "/assets/favicon/favicon.ico" ?>'/>
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href='<?php echo BASE_URL. "/assets/favicon/apple-touch-icon.png" ?>'
    />
    <link rel="manifest" href='<?php echo BASE_URL. "/assets/favicon/site.webmanifest" ?>'/>
    <title>Login Page | RoomRenting</title>
  </head>
  <body>
    <div class="login">
      <a href="./index.php"><img src='<?php echo BASE_URL. "/assets/img/logo.png" ?>' alt="logo.png" class="login-logo" /></a>

      <h1 class="login-main-text">Đăng nhập</h1>

      <h3 class="login-sub-text">Đăng nhập vào tài khoản của bạn</h3>

      <div class="login-username">
        <img
          src='<?php echo BASE_URL. "/assets/img/logo-user-ico.png" ?>'
          alt="login-user-ico"
          class="login-username-ico"
        />

        <input
          type="text"
          name="username"
          id="username"
          class="login-username-text"
          placeholder="Nhập username hoặc email"
          required
        />
      </div>

      <div class="login-username-error">
        <img
          src='<?php echo BASE_URL. "/assets/img/error.png" ?>'
          alt="error.png"
          class="login-username-error-ico"
        />

        <div class="login-username-error-text">Lỗi username</div> 
      </div>

      <div class="login-password">
        <img
          src='<?php echo BASE_URL. "/assets/img/logo-password-ico.png" ?>'
          alt="login-password-ico"
          class="login-password-ico"
        />

        <input
          type="password"
          name="password"
          id="password"
          class="login-password-text"
          placeholder="Nhập mật khẩu"
          required
        />

        <img
          src='<?php echo BASE_URL. "/assets/img/logo-show-ico.png" ?>'
          alt="login-show-ico"
          class="login-show-ico"
          hidden
        />

        <img
          src='<?php echo BASE_URL. "/assets/img/logo-hidden-ico.png" ?>'
          alt="login-hidden-ico"
          class="login-hidden-ico"
        />
      </div>

      <div class="login-password-error">
        <img
          src='<?php echo BASE_URL. "/assets/img/error.png" ?>'
          alt="error.png"
          class="login-password-error-ico"
        />

        <div class="login-password-error-text">Lỗi mật khẩu</div> 
      </div>

      <!-- <div class="login-option">
        <div class="login-option-remember">
          <input
            type="checkbox"
            name="login-option-checkbox"
            id="login-option-checkbox"
            class="login-option-checkbox"
          />

          <label for="login-option-checkbox" class="login-option-remember-text"
            >Nhớ mật khẩu</label
          >
        </div>

        <a href="" class="login-option-forget">Quên mật khẩu?</a>
      </div> -->

      <input type="submit" value="Đăng nhập" class="login-submit" />

      <div class="login-signup">
        Chưa phải thành viên?

        <a href="./signup.php" class="login-signup-link">Tạo tài khoản ngay</a>
      </div>
    </div>
  </body>
  <script>
    // pass button
    const pass_input = document.querySelector(".login-password-text")
    const hidden_pass_input = document.querySelector(".login-password .login-hidden-ico")
    const show_pass_input = document.querySelector(".login-password .login-show-ico")

    hidden_pass_input.addEventListener("click", (e) => {
      pass_input.setAttribute("type", "text")
      hidden_pass_input.style.display = "none"
      show_pass_input.style.display = "block"
    })

    show_pass_input.addEventListener("click", (e) => {
      pass_input.setAttribute("type", "password")
      show_pass_input.style.display = "none"
      hidden_pass_input.style.display = "block"
    })

    // validation
    const username_input = document.querySelector(".login-username-text")
    const password_input = document.querySelector(".login-password-text")

    const username_error = document.querySelector(".login-username-error")
    const password_error = document.querySelector(".login-password-error")

    const username_error_text = document.querySelector(".login-username-error-text")
    const password_error_text = document.querySelector(".login-password-error-text")

    const submit_btn = document.querySelector(".login-submit")

    submit_btn.addEventListener("click", async (e) => {
      var isValid = true;

      var username_regex = /^[a-zA-Z0-9]{3,30}$/
      const username_value = username_input.value.trim()
      if(!username_regex.test(username_value)) {
        isValid = false;
        username_input.focus()
        username_error_text.textContent = "Username có độ dài từ 3 đến 30 kí tự, chỉ chứa kí tự chữ và số."
        username_error.style.display = "flex"
      } else {
        username_error.style.display = "none"
      }

      var password_regex = /^.{8,255}$/
      const password_value = password_input.value.trim()
      if(!password_regex.test(password_value)) {
        if(isValid) 
          password_input.focus()
        isValid = false;
        password_error_text.textContent = "Mật khẩu từ 8 đến 255 kí tự."
        password_error.style.display = "flex"
      } else {
        password_error.style.display = "none"
      }

      if(isValid) {
        const response = await fetch("http://127.0.0.1:8000/api/login", {
          method: "POST",
          headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            "username": username_value,
            "password": password_value
          })
        })

        const data = await response.json()
        
        if(response.ok) {
          sessionStorage.setItem("token", data.token)
          sessionStorage.setItem("account_id", data.account.id)
          console.log(data)
          console.log(data.token)
          console.log(data.account)
          console.log(data.account.id)
          alert("Bạn đã đăng nhập thành công!")
          window.location.href = '<?php echo BASE_URL . "/pages/client/index.php" ?>'
        } else {
          console.log(data)
          if(data.message) {
              isValid = false;

              username_input.focus()
              username_error_text.textContent = "Username " + username_value + " không chính xác."
              username_error.style.display = "flex"

              password_error_text.textContent = "Mất khẩu không chính xác."
              password_error.style.display = "flex"
          } else {
              username_error.style.display = "none"
              password_error.style.display = "none"
          }
        }
      }
    })
  </script>
</html>
