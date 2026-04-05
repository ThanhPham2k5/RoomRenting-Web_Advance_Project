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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/suggest.css" ?>'/>

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
    <title>Suggest Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="filter-block">
      <div class="filter">
        <!-- <div class="filter-line"></div> -->

        <div class="filter-area"><h3>Khu vực</h3></div>

        <div class="filter-province">
          <input type="checkbox" name="filter-province-cb" id="filter-province-cb" class="filter-province-cb">

          <label for="filter-province-cb" class="filter-province-lb">
            <div class="filter-province-lb-text">Chọn tỉnh thành</div>

            <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
          </label>

          <ul class="filter-province-list">
          </ul>
        </div>
        <div class="filter-error province-error">Số nhà không hợp lệ</div>

        <div class="filter-district">
          <input type="checkbox" name="filter-district-cb" id="filter-district-cb" class="filter-district-cb">

          <label for="filter-district-cb" class="filter-district-lb">
            <div class="filter-district-lb-text">Chọn phường xã</div> 

            <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
          </label>

          <ul class="filter-district-list">
          </ul>
        </div>
        <div class="filter-error district-error">Số nhà không hợp lệ</div>

        <div class="filter-line"></div>

        <div class="filter-room"><h3>Loại phòng</h3></div>

        <div class="filter-rooms">
          <input type="checkbox" name="filter-room-cb" id="filter-room-cb" class="filter-room-cb">

          <label for="filter-room-cb" class="filter-room-lb">
            <div class="filter-room-lb-text">Chọn loại phòng</div> 

            <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
          </label>

          <ul class="filter-room-list">
            <li class="filter-room-item">Phòng đơn</li>
            <li class="filter-room-item">Căn hộ</li>
            <li class="filter-room-item">Ký túc xá</li>
          </ul>
        </div>
        <div class="filter-error rooms-error">Số nhà không hợp lệ</div>

        <div class="filter-line"></div>

        <div class="filter-price"><h3>Giá cả</h3></div>

        <input type="number" name="filter-min-price" id="filter-min-price" 
        placeholder="Giá nhỏ nhất" 
        min="0" class="filter-min-price">
        <div class="filter-error min-price-error">Số nhà không hợp lệ</div>

        <input type="number" name="filter-max-price" id="filter-max-price" 
        placeholder="Giá lớn nhất" 
        min="0" class="filter-max-price">
        <div class="filter-error max-price-error">Số nhà không hợp lệ</div>

        <div class="filter-line"></div>

        <div class="filter-square"><h3>Diện tích</h3></div>

        <input type="number" name="filter-square-number" id="filter-square-number" 
        placeholder="Nhập diện tích" 
        min="0" class="filter-square-number">
        <div class="filter-error square-error">Số nhà không hợp lệ</div>

        <div class="filter-line"></div>

        <button type="button" class="filter-apply">Lưu</button>
      </div>
    </div>

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>

  <script>
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

                            // reset ward value
                            document.querySelector(".filter-district-lb-text").textContent = "Chọn phường xã"

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
    document.querySelectorAll(".filter-room-item").forEach(item => {
        item.addEventListener("click", async (e) => {
            const room_text = document.querySelector(".filter-room-lb-text")    

            room_text.textContent = item.textContent

            document.querySelector(".filter-room-cb").checked = false
            document.querySelector(".filter-room-lb .filter-arrow").style.rotate = "0deg"
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

    // room button
    document.querySelector(".filter-room-cb").addEventListener("change", (e) => {
        const arrow = document.querySelector(".filter-room-lb .filter-arrow");
        arrow.style.rotate = e.target.checked ? "180deg" : "0deg";
    });

    // auto fill form
    async function autoFillForm(account_id, token) {
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
          if(data.data) {
            if(data.data.province)
              document.querySelector(".filter-province-lb-text").textContent = data.data.province

            // auto fill ward
            await autoWardByName(account_id, token, data.data.province)

            if(data.data.ward)
              document.querySelector(".filter-district-lb-text").textContent = data.data.ward

            if(data.data.roomType) {
              var roomType = "Chọn loại phòng"
              if(data.data.roomType === "room")
                roomType = "Phòng đơn"
              if(data.data.roomType === "apartment")
                roomType = "Căn hộ"
              if(data.data.roomType === "dorm")
                roomType = "Ký túc xá"
              document.querySelector(".filter-district-room-text").textContent = roomType
            }

            if(data.data.priceMin)
              document.querySelector(".filter-min-price").value = data.data.priceMin

            if(data.data.priceMax)
              document.querySelector(".filter-max-price").value = data.data.priceMax

            if(data.data.area)
              document.querySelector(".filter-square-number").value = data.data.area
          }
        } else {
          console.error(data)
        }
      } catch (err) {
        console.error(err)
      }
    }

    // save button
    document.querySelector(".filter-apply").addEventListener("click", async (e) => {
      // validate
      var isValid = true
      var province = ""
      var ward = ""
      var roomType = ""

      const stringRegex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{3,255}$/
      const numbRegex = /^\d{1,}$/

      if((document.querySelector(".filter-province-lb-text").textContent.trim() && stringRegex.test(document.querySelector(".filter-province-lb-text").textContent.trim()))) {
        if(document.querySelector(".filter-province-lb-text").textContent.trim() !== "Chọn tỉnh thành") {
          province = document.querySelector(".filter-province-lb-text").textContent.trim()
        }
        document.querySelector(".province-error").style.display = "none"
      } else {
        isValid = false
        document.querySelector(".province-error").textContent = "Tỉnh thành không hợp lệ."
        document.querySelector(".province-error").style.display = "flex"
      }

      if((document.querySelector(".filter-district-lb-text").textContent.trim() && stringRegex.test(document.querySelector(".filter-district-lb-text").textContent.trim()))) {
        if(document.querySelector(".filter-district-lb-text").textContent.trim() !== "Chọn phường xã") {
          ward = document.querySelector(".filter-district-lb-text").textContent.trim()
        }
        document.querySelector(".district-error").style.display = "none"
      } else {
        isValid = false
        document.querySelector(".district-error").textContent = "Phường xã không hợp lệ."
        document.querySelector(".district-error").style.display = "flex"
      }

      if((document.querySelector(".filter-room-lb-text").textContent.trim() && stringRegex.test(document.querySelector(".filter-room-lb-text").textContent.trim()))) {
        if(document.querySelector(".filter-room-lb-text").textContent.trim() !== "Chọn loại phòng") {
          roomType = document.querySelector(".filter-room-lb-text").textContent.trim()
        }
        document.querySelector(".rooms-error").style.display = "none"
      } else {
        isValid = false
        document.querySelector(".rooms-error").textContent = "Loại phòng không hợp lệ."
        document.querySelector(".rooms-error").style.display = "flex"
      }

      if((document.querySelector(".filter-min-price").value.trim() && numbRegex.test(document.querySelector(".filter-min-price").value.trim()) && document.querySelector(".filter-min-price").value.trim() >= 0)
      || !document.querySelector(".filter-min-price").value.trim()) {
        document.querySelector(".min-price-error").style.display = "none"
      } else {
        if(isValid)
          document.querySelector(".filter-min-price").focus()
        isValid = false
        document.querySelector(".min-price-error").textContent = "Giá nhỏ nhất không hợp lệ."
        document.querySelector(".min-price-error").style.display = "flex"
      }

      if((document.querySelector(".filter-max-price").value.trim() && numbRegex.test(document.querySelector(".filter-max-price").value.trim()) && document.querySelector(".filter-max-price").value.trim() > 0)
      || !document.querySelector(".filter-max-price").value.trim()) {
        document.querySelector(".max-price-error").style.display = "none"
      } else {
        if(isValid)
          document.querySelector(".filter-max-price").focus()
        isValid = false
        document.querySelector(".max-price-error").textContent = "Giá lớn nhất không hợp lệ."
        document.querySelector(".max-price-error").style.display = "flex"
      }

      if((document.querySelector(".filter-square-number").value.trim() && numbRegex.test(document.querySelector(".filter-square-number").value.trim()) && document.querySelector(".filter-square-number").value.trim() > 0)
      || !document.querySelector(".filter-square-number").value.trim()) {
        document.querySelector(".square-error").style.display = "none"
      } else {
        if(isValid)
          document.querySelector(".filter-square-number").focus()
        isValid = false
        document.querySelector(".square-error").textContent = "Diện tích không hợp lệ."
        document.querySelector(".square-error").style.display = "flex"
      }

      if(isValid) {
        const account_id = localStorage.getItem("account_id")
        const token = localStorage.getItem("token")

        if(roomType == "Phòng đơn")
          roomType = "room"
        else if(roomType == "Căn hộ")
          roomType = "apartment"
        else if(roomType == "Ký túc xá")
          roomType = "dorm" 

        try {
          const response = await fetch("http://backend.test/api/forms/byAccount/" + account_id, {
            method: "PUT",
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/json",
              "Authorization": "Bearer " + token
            },
            body: JSON.stringify({
              "province": province,
              "ward": ward,
              "room_type": roomType,
              "area": document.querySelector(".filter-square-number").value.trim(),
              "price_min": document.querySelector(".filter-min-price").value.trim(),
              "price_max": document.querySelector(".filter-max-price").value.trim(),
              "max_occupants": null
            })
          })

          const data = await response.json()
          if(response.ok) {
            if(data.message === "Form updated successfully") {
              // console.log(data)
              alert("Lưu thông tin thành công. Đang chuyển hướng sang trang bài đăng phù hợp.")
              window.location.href = "suggest-posts.php"
            }
          } else {
            console.error(data)
          }
        } catch (err) {
          console.error(err)
        }
      }
    })

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      if(account_id != null && token != null) {
        await Promise.all([autoFillProvince(account_id, token), autoFillForm(account_id, token)])
      } else {
        alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
        window.location.href = "login.php"
      }
    })
  </script>
</html>