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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/signup.css" ?>'/>

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
    <title>Signup Page | RoomRenting</title>
  </head>
  <body>
    <div class="login">
      <a href="./index.php"><img src='<?php echo BASE_URL . "/assets/img/logo.png"?>' alt="logo.png" class="login-logo" /></a>

      <h1 class="login-main-text">Đăng ký</h1>

      <h3 class="login-sub-text">Đăng ký tài khoản của bạn</h3>

      <div class="login-username">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-user-ico.png"?>'
          alt="login-user-ico"
          class="login-username-ico"
        />

        <input
          type="text"
          name="username"
          id="username"
          class="login-username-text"
          placeholder="Nhập username của bạn"
          required
        />
      </div>

      <div class="login-username-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-username-error-ico"
        />

        <div class="login-username-error-text">Lỗi username</div> 
      </div>

      <div class="login-phone">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-phone-ico.png"?>'
          alt="login-phone-ico"
          class="login-phone-ico"
        />

        <input
          type="text"
          name="phone"
          id="phone"
          class="login-phone-text"
          placeholder="Nhập số điện thoại của bạn"
          required
        />
      </div>

      <div class="login-phone-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-phone-error-ico"
        />

        <div class="login-phone-error-text">Lỗi số điện thoại</div> 
      </div>

      <div class="login-email">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-email-ico.png"?>'
          alt="login-email-ico"
          class="login-email-ico"
        />

        <input
          type="email"
          name="email"
          id="email"
          class="login-email-text"
          placeholder="Nhập email của bạn"
          required
        />
      </div>

      <div class="login-email-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-email-error-ico"
        />

        <div class="login-email-error-text">Lỗi email</div> 
      </div>

      <div class="login-password">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-password-ico.png"?>'
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
          src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>'
          alt="login-show-ico"
          class="login-show-ico"
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>'
          alt="login-hidden-ico"
          class="login-hidden-ico"
        />
      </div>

      <div class="login-password-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-password-error-ico"
        />

        <div class="login-password-error-text">Lỗi mật khẩu</div> 
      </div>

      <div class="login-re-password">
        <img
          src='<?php echo BASE_URL . "/assets/img/logo-password-ico.png"?>'
          alt="login-re-password-ico"
          class="login-re-password-ico"
        />

        <input
          type="password"
          name="password"
          id="password"
          class="login-re-password-text"
          placeholder="Nhập lại mật khẩu"
          required
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>'
          alt="login-show-ico"
          class="login-show-ico"
          hidden
        />

        <img
          src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>'
          alt="login-hidden-ico"
          class="login-hidden-ico"
        />
      </div>

      <div class="login-re-password-error">
        <img
          src='<?php echo BASE_URL . "/assets/img/error.png"?>'
          alt="error.png"
          class="login-re-password-error-ico"
        />

        <div class="login-re-password-error-text">Lỗi mật khẩu nhập lại</div> 
      </div>

      <input type="submit" value="Đăng ký" class="login-submit" />

      <div class="login-signup">
        Đã có tài khoản?

        <a href="./login.php" class="login-signup-link">Đăng nhập ngay</a>
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

    const re_pass_input = document.querySelector(".login-re-password-text")
    const hidden_re_pass_input = document.querySelector(".login-re-password .login-hidden-ico")
    const show_re_pass_input = document.querySelector(".login-re-password .login-show-ico")

    hidden_re_pass_input.addEventListener("click", (e) => {
      re_pass_input.setAttribute("type", "text")
      hidden_re_pass_input.style.display = "none"
      show_re_pass_input.style.display = "block"
    })

    show_re_pass_input.addEventListener("click", (e) => {
      re_pass_input.setAttribute("type", "password")
      show_re_pass_input.style.display = "none"
      hidden_re_pass_input.style.display = "block"
    })

    // validation
    const username_input = document.querySelector(".login-username-text")
    const phone_input = document.querySelector(".login-phone-text")
    const email_input = document.querySelector(".login-email-text")
    const password_input = document.querySelector(".login-password-text")
    const re_password_input = document.querySelector(".login-re-password-text")

    const username_error = document.querySelector(".login-username-error")
    const phone_error = document.querySelector(".login-phone-error")
    const email_error = document.querySelector(".login-email-error")
    const password_error = document.querySelector(".login-password-error")
    const re_password_error = document.querySelector(".login-re-password-error")

    const username_error_text = document.querySelector(".login-username-error-text")
    const phone_error_text = document.querySelector(".login-phone-error-text")
    const email_error_text = document.querySelector(".login-email-error-text")
    const password_error_text = document.querySelector(".login-password-error-text")
    const re_password_error_text = document.querySelector(".login-re-password-error-text")

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

      var phone_regex = /^(03|05|07|08|09)[0-9]{8}$/
      const phone_value = phone_input.value.trim()
      if(!phone_regex.test(phone_value)) {
        if(isValid) 
          phone_input.focus()
        isValid = false;
        phone_error_text.textContent = "Số điện thoại chứa 10 kí số và bắt đầu bằng (03|05|07|08|09)."
        phone_error.style.display = "flex"
      } else {
        phone_error.style.display = "none"
      }

      var email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
      const email_value = email_input.value.trim()
      if(!email_regex.test(email_value)) {
        if(isValid) 
          email_input.focus()
        isValid = false;
        email_error_text.textContent = "Email có định dạng không hợp lệ (VD: nva123@gmail.com)."
        email_error.style.display = "flex"
      } else {
        email_error.style.display = "none"
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

      var re_password_regex = /^.{8,255}$/
      const re_password_value = re_password_input.value.trim()
      if(!re_password_regex.test(re_password_value) || re_password_value != password_value) {
        if(isValid) 
          re_password_input.focus()
        isValid = false;
        re_password_error_text.textContent = "Mật khẩu không đồng nhất."
        re_password_error.style.display = "flex"
      } else {
        re_password_error.style.display = "none"
      }

      if(isValid) {
        const response = await fetch("http://127.0.0.1:8000/api/register", {
          method: "POST",
          headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            "username": username_value,
            "password": password_value,
            "password_confirmation": re_password_value,
            "role": "user",
            "email": email_value,
            "phone_number": phone_value,
            "roles": ["user"]
          })
        })

        const data = await response.json()
        
        if(response.ok) {
          alert("Bạn đã đăng ký tài khoản thành công!")
          window.location.href = '<?php echo BASE_URL . "/pages/client/login.php" ?>'
        } else {
          console.log(data)
          if(data.errors) {
            if(data.errors.username && data.errors.username[0] == "The username has already been taken.") {
              isValid = false;
              username_input.focus()
              username_error_text.textContent = "Username " + username_value + " đã tồn tại."
              username_error.style.display = "flex"
            } else {
              username_error.style.display = "none"
            }

            if(data.errors.phone_number && data.errors.phone_number[0] == "The phone number has already been taken.") {
              if(isValid)
                phone_input.focus()
              isValid = false;
              phone_error_text.textContent = "Số điện thoại " + phone_value + " đã được đăng ký."
              phone_error.style.display = "flex"
            } else {
              phone_error.style.display = "none"
            }

            if(data.errors.email && data.errors.email[0] == "The email has already been taken.") {
              if(isValid)
                email_input.focus()
              isValid = false;
              email_error_text.textContent = "Email " + email_value + " đã được đăng ký."
              email_error.style.display = "flex"
            } else {
              email_error.style.display = "none"
            }
          }
        }
      }
    })
  </script>
</html>
