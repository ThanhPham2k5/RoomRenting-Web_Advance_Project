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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/new-post.css" ?>'/>

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
    <title>Modify Post Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>
    
    <div class="new-block">
      <div class="new">
        <div class="new-pic">
          <h3 class="new-pic-title">Hình ảnh</h3>

          <input type="file" name="new-post-file-input" id="new-post-file-input" accept=".jpg,.jpeg,.png" multiple style="display: none;">
          <button type="button" class="new-post-upload">
            <img src='<?php echo BASE_URL . "/assets/img/upload-img.png"?>' alt="upload-img.png" class="new-post-upload-img">
          </button>

          <div class="new-pic-list">
            <div class="new-pic-box pic-box-1">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-1.png" class="new-pic-1">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del new-pic-del-1">
            </div>

            <div class="new-pic-box pic-box-2">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-2.png" class="new-pic-2">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del new-pic-del-2">
            </div>

            <div class="new-pic-box pic-box-3">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-3.png" class="new-pic-3">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del new-pic-del-3">
            </div>

            <div class="new-pic-box pic-box-4">
              <img src='<?php echo BASE_URL . "/assets/img/post.png"?>' alt="pic-4.png" class="new-pic-4">

              <img src='<?php echo BASE_URL . "/assets/img/pic-del.png"?>' alt="pic-del.png" class="new-pic-del new-pic-del-4">
            </div>
          </div>
        </div>

        <div class="new-form">
          <label for="profile-address-input" class="profile-address"><h3>Địa chỉ</h3></label>

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
              </ul>
          </div>

          <div class="profile-error district-error">Số nhà không hợp lệ</div>

          <label for="profile-square-input" class="profile-square"><h3>Diện tích</h3></label>

          <input type="number" name="profile-square-input" id="profile-square-input" class="profile-square-input"
          placeholder="Nhập diện tích (VD: 35.2) m2" min="1">

          <div class="profile-error square-error">Số nhà không hợp lệ</div>
          
          <label for="profile-room-input" class="profile-room"><h3>Loại phòng</h3></label>

          <div class="filter-room">
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

          <div class="profile-error room-error">Số nhà không hợp lệ</div>

          <label for="profile-occupants-input" class="profile-occupants"><h3>Số người ở tối đa</h3></label>

          <input type="number" name="profile-occupants-input" id="profile-occupants-input" class="profile-occupants-input"
          placeholder="Nhập số lượng"
          min="1">

          <div class="profile-error occupants-error">Số nhà không hợp lệ</div>

          <label for="profile-price-input" class="profile-price"><h3>Giá thuê</h3></label>

          <input type="number" name="profile-price-input" id="profile-price-input" class="profile-price-input"
          placeholder="Nhập giá thuê"
          min="0">

          <div class="profile-error price-error">Số nhà không hợp lệ</div>

          <label for="profile-deposit-input" class="profile-deposit"><h3>Giá cọc</h3></label>

          <input type="number" name="profile-deposit-input" id="profile-deposit-input" class="profile-deposit-input"
          placeholder="Nhập giá cọc"
          min="0">

          <div class="profile-error deposit-error">Số nhà không hợp lệ</div>

          <label for="profile-post-input" class="profile-post"><h3>Tiêu đề và mô tả</h3></label>

          <input type="text" name="profile-post-input" id="profile-post-input" class="profile-post-input"
          placeholder="Nhập tiêu đề">

          <div class="profile-error post-error">Số nhà không hợp lệ</div>

          <textarea name="profile-post-textarea" id="profile-post-textarea" class="profile-post-textarea"
          placeholder="Nhập mô tả"></textarea>

          <div class="profile-error post-textarea-error">Số nhà không hợp lệ</div>

          <button type="button" class="new-submit">Đăng bài</button>
        </div>
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

    // image button
    var selectedFiles = []

    document.querySelector(".new-post-upload").addEventListener("click", (e) => {
      document.querySelector("#new-post-file-input").click()
    })

    document.querySelector("#new-post-file-input").addEventListener("change", (e) => {
      Array.from(e.target.files).forEach((file, index) => {
        if(selectedFiles.length >= 4) {
          selectedFiles.shift()
        }

        selectedFiles.push({
          type: "file",
          file: file
        })
      })
      
      e.target.value = ""

      for(let i = 0; i < 4; i++) {
          document.querySelector(".new-pic-" + (i + 1)).setAttribute("src", '<?= BASE_URL ?>/assets/img/post.png')
      }

      selectedFiles.forEach((item, i) => {
        if (item.type === "url") {
            document.querySelector(".new-pic-" + (i + 1)).src = item.url
        } else {
            const reader = new FileReader()
            reader.onload = (e) => {
                document.querySelector(".new-pic-" + (i + 1)).src = e.target.result
            }
            reader.readAsDataURL(item.file)
        }
      })
    })

    //  delete temp img
    document.querySelectorAll(".new-pic-del").forEach((btn, index) => {
      btn.addEventListener("click", (e) => {
        selectedFiles.splice(index, 1)

        for(let i = 0; i < 4; i++) {
          document.querySelector(".new-pic-" + (i + 1)).setAttribute("src", '<?= BASE_URL ?>/assets/img/post.png')
        }

        selectedFiles.forEach((item, i) => {
          if(item.type === "url")
            document.querySelector(".new-pic-" + (i + 1)).src = item.url
          else {
            const reader = new FileReader()
            reader.onload = (e) => {
                document.querySelector(".new-pic-" + (i + 1)).setAttribute("src", e.target.result)
            }
            reader.readAsDataURL(item.file)
          }
        })
      })
    })

    // update button
    document.querySelector(".new-submit").addEventListener("click", async (e) => {
      // validation
      var isValid = true

      const address_regex = /^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\/,\.]{1,255}$/
      if(!address_regex.test(document.querySelector(".profile-address-input").value.trim())) {
          if(isValid) {
              document.querySelector(".profile-address-input").focus()
          }
          isValid = false
          document.querySelector(".address-error").textContent = "Số nhà phải có từ 1 kí tự trở lên."
          document.querySelector(".address-error").style.display = "flex"
      } else {            
          document.querySelector(".address-error").style.display = "none"
      }

      const province_regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{3,255}$/
      if(!province_regex.test(document.querySelector(".filter-province-lb-text").textContent.trim()) || document.querySelector(".filter-province-lb-text").textContent.trim() === "Chọn tỉnh thành") {
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
      if(!district_regex.test(document.querySelector(".filter-district-lb-text").textContent.trim()) || document.querySelector(".filter-district-lb-text").textContent.trim() === "Chọn phường xã") {
          if(isValid) {
              // document.querySelector(".profile-district-input").focus()
          }
          isValid = false
          document.querySelector(".district-error").textContent = "Phường xã không được trống."
          document.querySelector(".district-error").style.display = "flex"
      } else {            
          document.querySelector(".district-error").style.display = "none"
      }

      const validRooms = ["Phòng đơn", "Căn hộ", "Ký túc xá"]
      if(!validRooms.includes(document.querySelector(".filter-room-lb-text").textContent.trim())) {
          if(isValid) {
              // document.querySelector(".profile-room-input").focus()
          }
          isValid = false
          document.querySelector(".room-error").textContent = "Loại phòng không được trống."
          document.querySelector(".room-error").style.display = "flex"
      } else {            
          document.querySelector(".room-error").style.display = "none"
      }

      const numbRegex = /^\d{1,}$/

      const squareRegex = /^\d+([.,]\d+)?$/
      if(!squareRegex.test(document.querySelector(".profile-square-input").value.trim())) {
        if(isValid)
          document.querySelector(".profile-square-input").focus()
        isValid = false
        document.querySelector(".square-error").textContent = "Diện tích phải là số và nhỏ nhất là 1."
        document.querySelector(".square-error").style.display = "flex"
      } else {            
          document.querySelector(".square-error").style.display = "none"
      }
      
      if(!numbRegex.test(document.querySelector(".profile-occupants-input").value.trim())) {
        if(isValid)
          document.querySelector(".profile-occupants-input").focus()
        isValid = false
        document.querySelector(".occupants-error").textContent = "Số người ở phải là số và nhỏ nhất là 1."
        document.querySelector(".occupants-error").style.display = "flex"
      } else {            
          document.querySelector(".occupants-error").style.display = "none"
      }
      
      if(!numbRegex.test(document.querySelector(".profile-price-input").value.trim())) {
        if(isValid)
          document.querySelector(".profile-price-input").focus()
        isValid = false
        document.querySelector(".price-error").textContent = "Giá thuê phải là số."
        document.querySelector(".price-error").style.display = "flex"
      } else {            
          document.querySelector(".price-error").style.display = "none"
      }
      
      if(!numbRegex.test(document.querySelector(".profile-deposit-input").value.trim())) {
        if(isValid)
          document.querySelector(".profile-deposit-input").focus()
        isValid = false
        document.querySelector(".deposit-error").textContent = "Giá cọc phải là số."
        document.querySelector(".deposit-error").style.display = "flex"
      } else if (Number(document.querySelector(".profile-deposit-input").value.trim()) > Number(document.querySelector(".profile-price-input").value.trim())) {
        if(isValid)
          document.querySelector(".profile-deposit-input").focus()
        isValid = false
        document.querySelector(".deposit-error").textContent = "Giá cọc phải nhỏ hơn giá thuê."
        document.querySelector(".deposit-error").style.display = "flex"
      } else {            
          document.querySelector(".deposit-error").style.display = "none"
      }

      const title_regex = /^.{3,100}$/
      const desc_regex = /^.{3,1000}$/
      if(!title_regex.test(document.querySelector(".profile-post-input").value.trim())) {
          if(isValid) {
              document.querySelector(".profile-post-input").focus()
          }
          isValid = false
          document.querySelector(".post-error").textContent = "Tiêu đề bài đăng phải có từ 3 kí tự trở lên."
          document.querySelector(".post-error").style.display = "flex"
      } else {            
          document.querySelector(".post-error").style.display = "none"
      }
      
      if(!desc_regex.test(document.querySelector(".profile-post-textarea").value.trim())) {
          if(isValid) {
              document.querySelector(".profile-post-textarea").focus()
          }
          isValid = false
          document.querySelector(".post-textarea-error").textContent = "Mô tả bài đăng phải có từ 3 kí tự trở lên."
          document.querySelector(".post-textarea-error").style.display = "flex"
      } else {            
          document.querySelector(".post-textarea-error").style.display = "none"
      }

      if(isValid) {
        const formData = new FormData()
        formData.append("title", document.querySelector(".profile-post-input").value.trim())
        formData.append("price", document.querySelector(".profile-price-input").value.trim())
        const areaValue = document.querySelector(".profile-square-input").value.trim().replace(",", ".")
        const area = parseFloat(areaValue)
        formData.append("area", area)
        formData.append("house_number", document.querySelector(".profile-address-input").value.trim())
        formData.append("ward", document.querySelector(".filter-district-lb-text").textContent.trim())
        formData.append("province", document.querySelector(".filter-province-lb-text").textContent.trim())
        formData.append("description", document.querySelector(".profile-post-textarea").value.trim())
        formData.append("deposit", document.querySelector(".profile-deposit-input").value.trim())
        formData.append("status", "pending")
        formData.append("authorized", 0)

        // if(selectedFiles.length == null || selectedFiles.length <= 0) {
        //   alert("Vui lòng chọn 1 ảnh bài đăng!")
        //   return
        // }

        selectedFiles.forEach((item, index) => {
          if(item.file === "file") {
            formData.append("images[" + index + "]", item.file)
            formData.append("orders[" + index + "]", index + 1)
          }
        })

        if(document.querySelector(".filter-room-lb-text").textContent.trim() === "Phòng đơn")
          formData.append("room_type", "room")
        if(document.querySelector(".filter-room-lb-text").textContent.trim() === "Căn hộ")
          formData.append("room_type", "apartment")
        if(document.querySelector(".filter-room-lb-text").textContent.trim() === "Ký túc xá")
          formData.append("room_type", "dorm")

        formData.append("max_occupants", document.querySelector(".profile-occupants-input").value.trim())
        formData.append("_method", "PUT")
        
        const token = localStorage.getItem("token")
        const account_id = localStorage.getItem("account_id")

        try {
          const response = await fetch("http://backend.test/api/accounts/" + account_id + "?include=user", {
            method: "GET",
            headers: {
              "Accept": "application/json",
              "Authorization": "Bearer " + token
            }
          })

          const data = await response.json()
          if(response.ok) {
            if(data.data) {
              formData.append("user_id", data.data.user.id)
            }
          } else {
            console.error(data)
          }
        } catch (err) {
          console.error(err)
        }

        try {
          const response = await fetch("http://backend.test/api/posts/" + post_id, {
            method: "POST",
            headers: {
              "Accept": "application/json",
              "Authorization": "Bearer " + token
            },
            body: formData
          })

          const data = await response.json()
          if(response.ok) {
            if(data.message === "Post updated successfully") {
              alert("Cập nhật thông tin bài đăng thành công.")
              window.location.href = "manage-post.php"
            }
          } else {
            console.error(data)
          }
        } catch (err) {
          console.error(err)
        }
      }
    })

    const params = new URLSearchParams(window.location.search)
    const post_id = params.get("post_id")

    // auto fill post info
    async function autoFillModify(account_id, token) {
      try {
        const response = await fetch("http://backend.test/api/posts/" + post_id + "?include=postImages,user",{
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
            document.querySelector(".profile-address-input").value = data.data.houseNumber
            document.querySelector(".filter-province-lb-text").textContent = data.data.province
            await autoWardByName(account_id, token, data.data.province)
            document.querySelector(".filter-district-lb-text").textContent = data.data.ward
            document.querySelector(".profile-square-input").value = data.data.area
            if(data.data.roomType === "room")
              document.querySelector(".filter-room-lb-text").textContent = "Phòng đơn"
            if(data.data.roomType === "apartment")
              document.querySelector(".filter-room-lb-text").textContent = "Căn hộ"
            if(data.data.roomType === "dorm")
              document.querySelector(".filter-room-lb-text").textContent = "Ký túc xá"
            document.querySelector(".profile-occupants-input").value = data.data.maxOccupants
            document.querySelector(".profile-price-input").value = data.data.price
            document.querySelector(".profile-deposit-input").value = data.data.deposit
            document.querySelector(".profile-post-input").value = data.data.title
            document.querySelector(".profile-post-textarea").value = data.data.description

            data.data.postImages.forEach((image, index) => {
              const url = "http://backend.test" + image.imagePostUrl

              selectedFiles.push({
                type: "url",
                url: url,
                order: image.order
              })

              document.querySelector(".new-pic-" + (index + 1)).src = url
            })
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
        await Promise.all([autoFillProvince(account_id, token), autoFillModify(account_id, token)])
      } else {
        alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
        window.location.href = "login.php"
      }
    })
  </script>
</html>