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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/setting-profile.css" ?>'/>

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
    <title>Setting Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
        
    <div class="profile-block">
        <div class="profile">
            <h2 class="profile-title">Cài đặt</h2>

            <div class="profile-content">
                <div class="profile-tab">
                    <div class="profile-info">
                        <img src='<?php echo BASE_URL . "/assets/img/info-ico.png"?>' alt="info-ico.png" class="profile-info-ico">

                        <div class="profile-info-text">Thông tin cá nhân</div>

                        <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="profile-info-arrow">
                    </div>
                    
                    <div class="profile-setting">
                        <img src='<?php echo BASE_URL . "/assets/img/setting-profile-ico.png"?>' alt="setting-profile-ico.png" class="profile-setting-ico">

                        <div class="profile-setting-text">Cài đặt tài khoản</div>

                        <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="profile-setting-arrow">
                    </div>
                </div>

                <div class="profile-components">
                    <div class="profile-form">
                        <h3 class="profile-form-title">Hồ sơ cá nhân</h3>

                        <div class="profile-line"></div>

                        <div class="profile-avatar">
                            <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="profile-avatar-img">
                        
                            <div class="profile-avatar-upload">
                                <input type="file" id="profile-avatar-input" 
                                accept=".jpg,.jpeg,.png" style="display:none">
                                
                                <button type="button" class="profile-avatar-btn">Tải ảnh mới</button>

                                <!-- max size? -->
                                <div class="profile-avatar-text">Định dạng JPG, PNG. Dung lượng tối đa 2MB.</div>
                            </div>
                        </div>

                        <label for="profile-fullname-input" class="profile-fullname">Họ và tên</label>

                        <input type="text" name="profile-fullname-input" id="profile-fullname-input" class="profile-fullname-input"
                        placeholder="Nhập vào họ tên">

                        <div class="profile-error fullname-error">Số nhà không hợp lệ</div>

                        <label for="profile-phone-input" class="profile-phone">Số điện thoại</label>

                        <input type="text" name="profile-phone-input" id="profile-phone-input" class="profile-phone-input"
                        placeholder="Nhập số điện thoại">

                        <div class="profile-error phone-error">Số nhà không hợp lệ</div>

                        <label for="profile-address-input" class="profile-address">Địa chỉ</label>

                        <input type="text" name="profile-address-input" id="profile-address-input" class="profile-address-input"
                        placeholder="Nhập vào số nhà">

                        <div class="profile-error address-error">Số nhà không hợp lệ</div>

                        <div class="filter-province">
                            <input type="checkbox" name="filter-province-cb" id="filter-province-cb" class="filter-province-cb">

                            <label for="filter-province-cb" class="filter-province-lb">
                                <div class="filter-province-lb-text">Chọn tỉnh thành</div>

                                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
                            </label>

                            <ul class="filter-province-list">
                                <!-- an example item -->
                            </ul>
                        </div>

                        <div class="profile-error province-error">Số nhà không hợp lệ</div>

                        <div class="filter-district">
                            <input type="checkbox" name="filter-district-cb" id="filter-district-cb" class="filter-district-cb">

                            <label for="filter-district-cb" class="filter-district-lb">
                                <div class="filter-district-lb-text">Chọn phường xã</div>

                                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
                            </label>

                            <ul class="filter-district-list">
                                <!-- an example item -->
                            </ul>
                        </div>

                        <div class="profile-error district-error">Số nhà không hợp lệ</div>

                        <h3 class="profile-privacy">Thông tin bảo mật</h3>

                        <div class="profile-line"></div>
                        
                        <label for="profile-id-card-input" class="profile-id-card">Căn cước công dân</label>

                        <input type="text" name="profile-id-card-input" id="profile-id-card-input" class="profile-id-card-input"
                        placeholder="CCCD/ CMND/ Hộ chiếu">

                        <div class="profile-error id-card-error">Số nhà không hợp lệ</div>

                        <label for="filter-gender-cb" class="profile-gender">Giới tính</label>

                        <div class="filter-gender">
                            <input type="checkbox" name="filter-gender-cb" id="filter-gender-cb" class="filter-gender-cb">

                            <label for="filter-gender-cb" class="filter-gender-lb">
                                <div class="filter-gender-lb-text">Chọn giới tính</div>

                                <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
                            </label>

                            <ul class="filter-gender-list">
                                <!-- an example item -->
                                <li class="filter-gender-item">Nam</li>
                                
                                <li class="filter-gender-item">Nữ</li>
                            </ul>
                        </div>

                        <div class="profile-error gender-error">Số nhà không hợp lệ</div>

                        <label for="profile-dob-input" class="profile-dob">Ngày sinh</label>

                        <input type="text" name="profile-dob-input" id="profile-dob-input" class="profile-dob-input"
                        placeholder="yyyy-mm-dd">

                        <div class="profile-error dob-error">Số nhà không hợp lệ</div>

                        <button type="button" class="profile-save">Lưu thay đổi</button>
                    </div>

                    <div class="profile-pass">
                        <h3 class="profile-pass-title">Thay đổi mật khẩu</h3>

                        <div class="profile-cur-pass">
                            <input type="password" name="profile-cur-pass-input" id="profile-cur-pass-input" class="profile-cur-pass-input"
                            placeholder="Mật khẩu hiện tại">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>' alt="hidden.png" class="profile-cur-pass-hidden">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>' alt="show.png" class="profile-cur-pass-show">
                        </div>

                        <div class="profile-error cur-pass-error">Số nhà không hợp lệ</div>

                        <div class="profile-new-pass">
                            <input type="password" name="profile-new-pass-input" id="profile-new-pass-input" class="profile-new-pass-input"
                            placeholder="Mật khẩu mới">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>' alt="hidden.png" class="profile-new-pass-hidden">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>' alt="show.png" class="profile-new-pass-show">
                        </div>

                        <div class="profile-error new-pass-error">Số nhà không hợp lệ</div>

                        <div class="profile-re-new-pass">
                            <input type="password" name="profile-re-new-pass-input" id="profile-re-new-pass-input" class="profile-re-new-pass-input"
                            placeholder="Xác nhận mật khẩu mới">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-hidden-ico.png"?>' alt="hidden.png" class="profile-re-new-pass-hidden">

                            <img src='<?php echo BASE_URL . "/assets/img/logo-show-ico.png"?>' alt="show.png" class="profile-re-new-pass-show">
                        </div>

                        <div class="profile-error re-new-pass-error">Số nhà không hợp lệ</div>

                        <button type="button" class="profile-pass-save">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
  <script>
    // tab script
    const info = document.querySelector(".profile-info");
    const setting = document.querySelector(".profile-setting");
    const form = document.querySelector(".profile-form");
    const pass = document.querySelector(".profile-pass");

    info.addEventListener("click", (e) => {
        form.style.display = "flex";
        pass.style.display = "none";
    });

    setting.addEventListener("click", (e) => {
        pass.style.display = "flex";
        form.style.display = "none";
    });

    // pass script
    const cur_pass = document.querySelector(".profile-cur-pass-input");
    const cur_pass_hidden = document.querySelector(".profile-cur-pass-hidden");
    const cur_pass_show = document.querySelector(".profile-cur-pass-show");

    cur_pass_hidden.addEventListener("click", (e) => {
        cur_pass.setAttribute("type", "text");
        cur_pass_show.style.display = "flex";
        cur_pass_hidden.style.display = "none";
    });

    cur_pass_show.addEventListener("click", (e) => {
        cur_pass.setAttribute("type", "password");
        cur_pass_hidden.style.display = "flex";
        cur_pass_show.style.display = "none";
    });
    
    const new_pass = document.querySelector(".profile-new-pass-input");
    const new_pass_hidden = document.querySelector(".profile-new-pass-hidden");
    const new_pass_show = document.querySelector(".profile-new-pass-show");

    new_pass_hidden.addEventListener("click", (e) => {
        new_pass.setAttribute("type", "text");
        new_pass_show.style.display = "flex";
        new_pass_hidden.style.display = "none";
    });

    new_pass_show.addEventListener("click", (e) => {
        new_pass.setAttribute("type", "password");
        new_pass_hidden.style.display = "flex";
        new_pass_show.style.display = "none";
    });
    
    const re_new_pass = document.querySelector(".profile-re-new-pass-input");
    const re_new_pass_hidden = document.querySelector(".profile-re-new-pass-hidden");
    const re_new_pass_show = document.querySelector(".profile-re-new-pass-show");

    re_new_pass_hidden.addEventListener("click", (e) => {
        re_new_pass.setAttribute("type", "text");
        re_new_pass_show.style.display = "flex";
        re_new_pass_hidden.style.display = "none";
    });

    re_new_pass_show.addEventListener("click", (e) => {
        re_new_pass.setAttribute("type", "password");
        re_new_pass_hidden.style.display = "flex";
        re_new_pass_show.style.display = "none";
    });

    // auto fill province list
    async function autoFillProvince(account_id, token) {
        try {
            const response = await fetch("http://backend.test/api/address/provinces", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            })

            const data = await response.json()
            if(response.ok) {
                // console.log(data)
                if(data.data) {
                    let html = ""

                    data.data.forEach(item => {
                        html += `
                            <li class="filter-province-item ${item.provinceCode}">${item.name}</li>
                        `
                    })

                    document.querySelector(".filter-province-list").innerHTML = html

                    // auto update ward after choosing
                    document.querySelectorAll(".filter-province-item").forEach(item => {
                        item.addEventListener("click", async (e) => {
                            const province_text = document.querySelector(".filter-province-lb-text")
                            
                            province_text.textContent = item.textContent

                            const province_id = [...province_text.classList].find(c => c.startsWith("provinceCode-"))
                            if(province_id) {
                                province_text.classList.remove(province_id)
                            }
                            province_text.classList.add("provinceCode-" + item.classList[1])


                            document.querySelector(".filter-province-cb").checked = false
                            document.querySelector(".filter-province-lb .filter-arrow").style.rotate = "0deg"

                            const provinceCode = item.classList[1]
                            await autoWard(account_id, token, provinceCode)
                        })
                    })
                }
            } else {
                console.error(data)
            }
        } catch (err) {
            console.error(err)
        }
    }

    // auto fill district list with provinceCode
    async function autoWard(account_id, token, provinceCode) {
        try {
            const response = await fetch("http://backend.test/api/address/provinces/" + provinceCode + "/wards", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            })

            const data = await response.json()
            if(response.ok) {
                // console.log(data)
                if(data.data) {
                    let html = ""

                    data.data.forEach(item => {
                        html += `
                            <li class="filter-district-item ${item.wardCode}">${item.name}</li>
                        `
                    })

                    document.querySelector(".filter-district-list").innerHTML = html

                    // auto update text after choosing
                    document.querySelectorAll(".filter-district-item").forEach(item => {
                        item.addEventListener("click", async (e) => {
                            const district_text = document.querySelector(".filter-district-lb-text")    

                            district_text.textContent = item.textContent

                            const district_id = [...district_text.classList].find(c => c.startsWith("districtCode-"))
                            if(district_id) {
                                district_text.classList.remove(district_id)
                            }
                            district_text.classList.add("districtCode-" + item.classList[1])

                            document.querySelector(".filter-district-cb").checked = false
                            document.querySelector(".filter-district-lb .filter-arrow").style.rotate = "0deg"
                        })
                    })
                }
            } else {
                console.error(data)
            }
        } catch (err) {
            console.error(err)
        }
    }

    // auto fill district list with provinceName
    async function autoWardByName(account_id, token, provinceName) {
        try {
            const response = await fetch("http://backend.test/api/address/provinces/name/" + provinceName + "/wards", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            })

            const data = await response.json()
            if(response.ok) {
                // console.log(data)
                if(data.data) {
                    let html = ""

                    data.data.forEach(item => {
                        html += `
                            <li class="filter-district-item ${item.wardCode}">${item.name}</li>
                        `
                    })

                    document.querySelector(".filter-district-list").innerHTML = html

                    // auto update text after choosing
                    document.querySelectorAll(".filter-district-item").forEach(item => {
                        item.addEventListener("click", async (e) => {
                            const district_text = document.querySelector(".filter-district-lb-text")    

                            district_text.textContent = item.textContent

                            const district_id = [...district_text.classList].find(c => c.startsWith("districtCode-"))
                            if(district_id) {
                                district_text.classList.remove(district_id)
                            }
                            district_text.classList.add("districtCode-" + item.classList[1])

                            document.querySelector(".filter-district-cb").checked = false
                            document.querySelector(".filter-district-lb .filter-arrow").style.rotate = "0deg"
                        })
                    })
                }
            } else {
                console.error(data)
            }
        } catch (err) {
            console.error(err)
        }
    }

    // auto update text after choosing
    document.querySelectorAll(".filter-gender-item").forEach(item => {
        item.addEventListener("click", async (e) => {
            const gender_text = document.querySelector(".filter-gender-lb-text")    

            gender_text.textContent = item.textContent

            document.querySelector(".filter-gender-cb").checked = false
            document.querySelector(".filter-gender-lb .filter-arrow").style.rotate = "0deg"
        })
    })

    // province button (arrow animation)
    document.querySelector(".filter-province-cb").addEventListener("change", (e) => {
        const arrow = document.querySelector(".filter-province-lb .filter-arrow");
        arrow.style.rotate = e.target.checked ? "180deg" : "0deg";
    });

    // ward button
    document.querySelector(".filter-district-cb").addEventListener("change", (e) => {
        const arrow = document.querySelector(".filter-district-lb .filter-arrow");
        arrow.style.rotate = e.target.checked ? "180deg" : "0deg";
    });

    // gender button
    document.querySelector(".filter-gender-cb").addEventListener("change", (e) => {
        const arrow = document.querySelector(".filter-gender-lb .filter-arrow");
        arrow.style.rotate = e.target.checked ? "180deg" : "0deg";
    });

    // auto fill personal data
    async function autoPersonalInfo(account_id, token) {
        try {
            const response = await fetch("http://backend.test/api/personalInfos/byAccount/" + account_id, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            })

            const data = await response.json()
            if(response.ok) {
                // console.log(data.data)
                if(data.data) {
                    document.querySelector(".profile-avatar-img").setAttribute("src", data.data.profileUrl)
                    document.querySelector(".profile-fullname-input").setAttribute("value", data.data.name)
                    document.querySelector(".profile-phone-input").setAttribute("value", data.data.phoneNumber)
                    document.querySelector(".profile-address-input").setAttribute("value", data.data.houseNumber)
                    document.querySelector(".filter-province-lb-text").textContent = data.data.province
                    await autoWardByName(account_id, token, data.data.province)
                    document.querySelector(".filter-district-lb-text").textContent = data.data.ward
                    document.querySelector(".profile-id-card-input").setAttribute("value", data.data.pid)
                    document.querySelector(".filter-gender-lb-text").textContent = data.data.gender
                    document.querySelector(".profile-dob-input").setAttribute("value", data.data.dateOfBirth)
                }
            } else {
                console.error(data)
            }
        } catch (err) {
            console.error(err)
        }
    }

    async function loadSettingPage() {
        const account_id = localStorage.getItem("account_id")
        const token = localStorage.getItem("token")

        if(account_id != null && token != null) {
            await Promise.all([
                autoFillProvince(account_id, token),
                autoPersonalInfo(account_id,token)
            ])
        } else {
            alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
            window.location.href = "login.php"
        }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      await loadSettingPage()
    })

    // upload user avatar
    const avatarBtn = document.querySelector(".profile-avatar-btn")
    const avatarInput = document.querySelector("#profile-avatar-input")
    const avatarImg = document.querySelector(".profile-avatar-img")

    avatarBtn.addEventListener("click", () => {
        avatarInput.click()
    })

    avatarInput.addEventListener("change", (e) => {
        const file = e.target.files[0]
        if (!file) return

        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"]
        if (!allowedTypes.includes(file.type)) {
            alert("Chỉ chấp nhận định dạng JPG, PNG!")
            avatarInput.value = ""
            return
        }

        const maxSize = 2 * 1024 * 1024
        if (file.size > maxSize) {
            alert("Dung lượng ảnh tối đa 2MB!")
            avatarInput.value = ""
            return
        }

        // read file and place on interface
        const reader = new FileReader()
        reader.onload = (e) => {
            avatarImg.src = e.target.result
        }
        reader.readAsDataURL(file)
    })

    // update new password
    document.querySelector(".profile-pass-save").addEventListener("click", async (e) => {
        // validation
        var isValid = true
        const password_regex = /^[a-zA-Z0-9!@#$%^&*]{8,255}$/

        if(!password_regex.test(document.querySelector(".profile-cur-pass-input").value.trim())) {
            isValid = false
            document.querySelector(".profile-cur-pass-input").focus()
            document.querySelector(".cur-pass-error").textContent = "Mật khẩu phải có từ 8 - 255 kí tự."
            document.querySelector(".cur-pass-error").style.display = "flex"
        } else {
            document.querySelector(".cur-pass-error").style.display = "none"
        }

        if(!password_regex.test(document.querySelector(".profile-new-pass-input").value.trim())) {
            if(isValid) {
                document.querySelector(".profile-new-pass-input").focus()
            }
            isValid = false
            document.querySelector(".new-pass-error").textContent = "Mật khẩu mới phải có từ 8 - 255 kí tự."
            document.querySelector(".new-pass-error").style.display = "flex"
        } else {
            document.querySelector(".new-pass-error").style.display = "none"
        }

        if(!password_regex.test(document.querySelector(".profile-re-new-pass-input").value.trim()) || document.querySelector(".profile-re-new-pass-input").value.trim() != document.querySelector(".profile-new-pass-input").value.trim()) {
            if(isValid) {
                document.querySelector(".profile-re-new-pass-input").focus()
            }
            isValid = false
            document.querySelector(".re-new-pass-error").textContent = "Mật khẩu mới nhập lại không đồng nhất."
            document.querySelector(".re-new-pass-error").style.display = "flex"
        } else {
            document.querySelector(".re-new-pass-error").style.display = "none"
        }

        if(isValid) {
            var account_id = localStorage.getItem("account_id")
            var token = localStorage.getItem("token")

            try {
                const response = await fetch("http://backend.test/api/accounts/" + account_id + "/change-password", {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                        "current_password": document.querySelector(".profile-cur-pass-input").value.trim(),
                        "new_password": document.querySelector(".profile-new-pass-input").value.trim(),
                        "new_password_confirmation": document.querySelector(".profile-re-new-pass-input").value.trim()
                    })
                })

                const data = await response.json()
                if(response.ok) {
                    if(data.success) {
                        alert(data.message)
                        document.querySelector(".user-logout").click()
                    } else {
                        if(data.message == "Mật khẩu hiện tại không đúng.") {
                            isValid = false
                            document.querySelector(".profile-cur-pass-input").focus()
                            document.querySelector(".cur-pass-error").textContent = "Mật khẩu hiện tại không đúng."
                            document.querySelector(".cur-pass-error").style.display = "flex"
                        } else {
                            document.querySelector(".cur-pass-error").style.display = "none"
                        }

                        if(data.message == "Mật khẩu mới không được giống mật khẩu cũ.") {
                            if(isValid) {
                                document.querySelector(".profile-new-pass-input").focus()
                            }
                            isValid = false
                            document.querySelector(".new-pass-error").textContent = "Mật khẩu mới không được giống mật khẩu cũ."
                            document.querySelector(".new-pass-error").style.display = "flex"
                        } else {
                            document.querySelector(".new-pass-error").style.display = "none"
                        }
                    }
                } else {
                    console.error(data)
                }
            } catch (err) {
                console.error(err)
            }
        }
    })

    // update personal data
    document.querySelector(".profile-save").addEventListener("click", async (e) => {
        // validation
        var isValid = true

        const fullname_regex = /^[a-zA-ZÀ-ỹ\s]{3,255}$/u
        if(!fullname_regex.test(document.querySelector(".profile-fullname-input").value.trim())) {
            isValid = false
            document.querySelector(".profile-fullname-input").focus()
            document.querySelector(".fullname-error").textContent = "Tên phải có từ 3 kí tự trở lên."
            document.querySelector(".fullname-error").style.display = "flex"
        } else {            
            document.querySelector(".fullname-error").style.display = "none"
        }

        const phone_regex = /^(03|05|07|08|09)[0-9]{8}$/
        if(!phone_regex.test(document.querySelector(".profile-phone-input").value.trim())) {
            if(isValid) {
                document.querySelector(".profile-phone-input").focus()
            }
            isValid = false
            document.querySelector(".phone-error").textContent = "Số điện thoại phải có 10 kí số và bắt đầu là (03|05|07|08|09)."
            document.querySelector(".phone-error").style.display = "flex"
        } else {            
            document.querySelector(".phone-error").style.display = "none"
        }

        const address_regex = /^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\/,\.]{3,255}$/
        if(!address_regex.test(document.querySelector(".profile-address-input").value.trim())) {
            if(isValid) {
                document.querySelector(".profile-address-input").focus()
            }
            isValid = false
            document.querySelector(".address-error").textContent = "Số nhà phải có từ 3 kí tự trở lên."
            document.querySelector(".address-error").style.display = "flex"
        } else {            
            document.querySelector(".address-error").style.display = "none"
        }

        const province_regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{3,255}$/
        if(!province_regex.test(document.querySelector(".filter-province-lb-text").textContent.trim())) {
            if(isValid) {
                // document.querySelector(".profile-province-input").focus()
            }
            isValid = false
            document.querySelector(".province-error").textContent = "Tỉnh thành không được trống."
            document.querySelector(".province-error").style.display = "flex"
        } else {            
            document.querySelector(".province-error").style.display = "none"
        }

        const district_regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{3,255}$/
        if(!district_regex.test(document.querySelector(".filter-district-lb-text").textContent.trim())) {
            if(isValid) {
                // document.querySelector(".profile-district-input").focus()
            }
            isValid = false
            document.querySelector(".district-error").textContent = "Phường xã không được trống."
            document.querySelector(".district-error").style.display = "flex"
        } else {            
            document.querySelector(".district-error").style.display = "none"
        }

        const id_card_regex = /^[0-9]{12}$/
        if(!id_card_regex.test(document.querySelector(".profile-id-card-input").value.trim())) {
            if(isValid) {
                document.querySelector(".profile-id-card-input").focus()
            }
            isValid = false
            document.querySelector(".id-card-error").textContent = "CCCD phải có đủ 12 số."
            document.querySelector(".id-card-error").style.display = "flex"
        } else {            
            document.querySelector(".id-card-error").style.display = "none"
        }

        const gender_regex = /^(Nam|Nữ|Khác)$/
        if(!gender_regex.test(document.querySelector(".filter-gender-lb-text").textContent.trim())) {
            if(isValid) {
                // document.querySelector(".profile-gender-input").focus()
            }
            isValid = false
            document.querySelector(".gender-error").textContent = "Giới tính phải là Nam hoặc Nữ."
            document.querySelector(".gender-error").style.display = "flex"
        } else {            
            document.querySelector(".gender-error").style.display = "none"
        }

        const dob_regex = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/
        if(!dob_regex.test(document.querySelector(".profile-dob-input").value.trim())) {
            if(isValid) {
                document.querySelector(".profile-dob-input").focus()
            }
            isValid = false
            document.querySelector(".dob-error").textContent = "Ngày sinh phải có dạng yyyy-mm-dd."
            document.querySelector(".dob-error").style.display = "flex"
        } else {            
            document.querySelector(".dob-error").style.display = "none"
        }

        if(isValid) {
            const account_id = localStorage.getItem("account_id")
            const token = localStorage.getItem("token")

            // Body
            const formData = new FormData()
            formData.append("date_of_birth", document.querySelector(".profile-dob-input").value.trim())
            formData.append("gender", document.querySelector(".filter-gender-lb-text").textContent.trim())
            formData.append("house_number", document.querySelector(".profile-address-input").value.trim())
            formData.append("ward", document.querySelector(".filter-district-lb-text").textContent.trim())
            formData.append("province", document.querySelector(".filter-province-lb-text").textContent.trim())
            formData.append("phone_number", document.querySelector(".profile-phone-input").value.trim())
            formData.append("name", document.querySelector(".profile-fullname-input").value.trim())
            formData.append("pid", document.querySelector(".profile-id-card-input").value.trim())
            formData.append("_method", "PUT")

            // user avatar
            const avatarFile = document.querySelector("#profile-avatar-input").files[0]
            if (avatarFile) {
                formData.append("profile_url", avatarFile)
            }

            try {
                const response = await fetch("http://backend.test/api/personalInfos/byAccount/" + account_id, {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: formData
                })

                const data = await response.json()
                if (response.ok) {
                    if (data.personalInfo) {
                        alert("Cập nhật thành công!")
                        console.log(data.personalInfo)
                        window.location.reload()
                    }
                } else {
                    console.error(data)
                    alert(data.message || "Cập nhật thất bại!")
                }
            } catch (err) {
                console.error(err)
                alert("Lỗi kết nối!")
            }
        }
    })
  </script>
</html>