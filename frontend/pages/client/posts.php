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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/posts.css" ?>'/>

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
    <title>Post Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="filter-background">
      <div class="filter">
        <div class="filter-return-block">
          <div class="filter-return">
            <img src='<?php echo BASE_URL . "/assets/img/return-ico.png"?>' alt="return-ico.png" class="filter-return-ico">

            Quay lại
          </div>

          <div class="filter-reset">
            <img src='<?php echo BASE_URL . "/assets/img/filter-reset.png"?>' alt="reset-ico.png" class="filter-reset-ico">

            Làm mới
          </div>
        </div>

        <!-- <div class="filter-line"></div> -->

        <div class="filter-area">Khu vực</div>

        <div class="filter-province">
          <input type="checkbox" name="filter-province-cb" id="filter-province-cb" class="filter-province-cb">

          <label for="filter-province-cb" class="filter-province-lb">
            <div class="filter-province-lb-text">Chọn tỉnh thành</div> 

            <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
          </label>

          <ul class="filter-province-list">
          </ul>
        </div>

        <div class="filter-district">
          <input type="checkbox" name="filter-district-cb" id="filter-district-cb" class="filter-district-cb">

          <label for="filter-district-cb" class="filter-district-lb">
            <div class="filter-district-lb-text">Chọn phường xã</div> 

            <img src='<?php echo BASE_URL . "/assets/img/arrow_bold.png"?>' alt="arrow.png" class="filter-arrow">
          </label>

          <ul class="filter-district-list">
          </ul>
        </div>

        <!-- <div class="filter-line"></div> -->

        <div class="filter-room">Loại phòng</div>

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

        <!-- <div class="filter-line"></div> -->

        <div class="filter-price">Giá cả</div>

        <input type="number" name="filter-min-price" id="filter-min-price" 
        placeholder="Giá nhỏ nhất" 
        min="0" class="filter-min-price">

        <input type="number" name="filter-max-price" id="filter-max-price" 
        placeholder="Giá lớn nhất" 
        min="0" class="filter-max-price">

        <!-- <div class="filter-line"></div> -->

        <div class="filter-square">Diện tích</div>

        <input type="number" name="filter-square-number" id="filter-square-number" 
        placeholder="Nhập diện tích" 
        min="0" class="filter-square-number">

        <!-- <div class="filter-line"></div> -->

        <div class="filter-occupants">Số người ở tối đa</div>

        <input type="number" name="filter-occupants-number" id="filter-occupants-number" 
        placeholder="Nhập số người" 
        min="1" class="filter-occupants-number">

        <!-- <div class="filter-line"></div> -->

        <button type="button" class="filter-apply">Áp dụng</button>
      </div>
    </div>

    <div class="content-search">
      <div class="search-tool">
        <img
          src='<?php echo BASE_URL . "/assets/img/Find.png" ?>'
          alt="find.png"
          class="search-ico"
        />

        <input
          type="text"
          name=""
          id=""
          placeholder="Tìm kiếm"
          class="search-bar"
        />
      </div>

      <div class="search-seperate"></div>

      <div class="other-tools">
        <div class="filter-tool">
          <img
            src='<?php echo BASE_URL . "/assets/img/Vector.png" ?>'
            alt="filter.png"
            class="filter-ico"
          />

          <div class="filter-text">Bộ lọc</div>
        </div>

        <button class="search-submit">Tìm phòng</button>
      </div>
    </div>

    <div class="posts">
      <div class="posts-head">
        <h2 class="posts-head-text">Sắp xếp theo</h2>

        <div class="posts-head-buttons">
          <button type="button" class="posts-newest posts-sort-selected">
              <svg class="posts-newest-ico" width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g>
                      <path d="M9.41088 16.825L12.5609 14.925L15.7109 16.85L14.8859 13.25L17.6609 10.85L14.0109 10.525L12.5609 7.12495L11.1109 10.5L7.46088 10.825L10.2359 13.25L9.41088 16.825ZM12.5609 17.275L8.41088 19.775C8.22754 19.8916 8.03588 19.9416 7.83588 19.9249C7.63588 19.9083 7.46088 19.8416 7.31088 19.725C7.16088 19.6083 7.04421 19.4626 6.96088 19.288C6.87754 19.1133 6.86088 18.9173 6.91088 18.7L8.01088 13.975L4.33588 10.8C4.16921 10.65 4.06521 10.479 4.02388 10.287C3.98254 10.095 3.99488 9.90762 4.06088 9.72495C4.12688 9.54228 4.22688 9.39228 4.36088 9.27495C4.49488 9.15762 4.67821 9.08262 4.91088 9.04995L9.76088 8.62495L11.6359 4.17495C11.7192 3.97495 11.8485 3.82495 12.0239 3.72495C12.1992 3.62495 12.3782 3.57495 12.5609 3.57495C12.7435 3.57495 12.9225 3.62495 13.0979 3.72495C13.2732 3.82495 13.4025 3.97495 13.4859 4.17495L15.3609 8.62495L20.2109 9.04995C20.4442 9.08328 20.6275 9.15828 20.7609 9.27495C20.8942 9.39162 20.9942 9.54162 21.0609 9.72495C21.1275 9.90829 21.1402 10.096 21.0989 10.288C21.0575 10.48 20.9532 10.6506 20.7859 10.8L17.1109 13.975L18.2109 18.7C18.2609 18.9166 18.2442 19.1126 18.1609 19.288C18.0775 19.4633 17.9609 19.609 17.8109 19.725C17.6609 19.841 17.4859 19.9076 17.2859 19.9249C17.0859 19.9423 16.8942 19.8923 16.7109 19.775L12.5609 17.275Z" fill="currentColor"/>
                  </g>
              </svg>
              Mới nhất
          </button>

          <button type="button" class="posts-ascending">
              <svg class="posts-ascending-ico" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_80_518)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M4.50001 3L5.29501 3.795L8.67001 7.17C8.87504 7.38208 8.98857 7.66621 8.98615 7.96118C8.98373 8.25615 8.86554 8.53837 8.65706 8.74706C8.44857 8.95574 8.16646 9.07419 7.87149 9.07689C7.57652 9.07959 7.29229 8.96633 7.08001 8.7615L5.62501 7.3065V19.8765C5.62501 20.1749 5.50649 20.461 5.29551 20.672C5.08453 20.883 4.79838 21.0015 4.50001 21.0015C4.20165 21.0015 3.9155 20.883 3.70452 20.672C3.49354 20.461 3.37501 20.1749 3.37501 19.8765V7.305L1.92001 8.76C1.70675 8.95872 1.42468 9.0669 1.13323 9.06176C0.841778 9.05662 0.563701 8.93855 0.357581 8.73243C0.151462 8.52631 0.0333938 8.24824 0.0282514 7.95678C0.0231091 7.66533 0.131294 7.38326 0.330014 7.17L3.70501 3.795L4.50001 3ZM12 10.125C12 10.746 12.504 11.25 13.125 11.25H15.375C15.6734 11.25 15.9595 11.1315 16.1705 10.9205C16.3815 10.7095 16.5 10.4234 16.5 10.125C16.5 9.82663 16.3815 9.54048 16.1705 9.3295C15.9595 9.11853 15.6734 9 15.375 9H13.125C12.8266 9 12.5405 9.11853 12.3295 9.3295C12.1185 9.54048 12 9.82663 12 10.125ZM13.125 16.125C12.8266 16.125 12.5405 16.0065 12.3295 15.7955C12.1185 15.5845 12 15.2984 12 15C12 14.7016 12.1185 14.4155 12.3295 14.2045C12.5405 13.9935 12.8266 13.875 13.125 13.875H19.875C20.1734 13.875 20.4595 13.9935 20.6705 14.2045C20.8815 14.4155 21 14.7016 21 15C21 15.2984 20.8815 15.5845 20.6705 15.7955C20.4595 16.0065 20.1734 16.125 19.875 16.125H13.125ZM13.125 21C12.8266 21 12.5405 20.8815 12.3295 20.6705C12.1185 20.4595 12 20.1734 12 19.875C12 19.5766 12.1185 19.2905 12.3295 19.0795C12.5405 18.8685 12.8266 18.75 13.125 18.75H22.875C23.1734 18.75 23.4595 18.8685 23.6705 19.0795C23.8815 19.2905 24 19.5766 24 19.875C24 20.1734 23.8815 20.4595 23.6705 20.6705C23.4595 20.8815 23.1734 21 22.875 21H13.125Z" fill="currentColor"/>
                  </g>
                  <defs>
                      <clipPath id="clip0_80_518">
                          <rect width="24" height="24" fill="white"/>
                      </clipPath>
                  </defs>
              </svg>
              Giá thấp - cao
          </button>

          <button type="button" class="posts-descending">
              <svg class="posts-descending-ico" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_80_523)">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M4.50001 21L5.29501 20.205L8.67001 16.83C8.87504 16.618 8.98857 16.3338 8.98615 16.0389C8.98373 15.7439 8.86554 15.4617 8.65706 15.253C8.44857 15.0443 8.16646 14.9258 7.87149 14.9231C7.57652 14.9204 7.29229 15.0337 7.08001 15.2385L5.62501 16.6935V4.12354C5.62501 3.82517 5.50649 3.53902 5.29551 3.32804C5.08453 3.11706 4.79838 2.99854 4.50001 2.99854C4.20165 2.99854 3.9155 3.11706 3.70452 3.32804C3.49354 3.53902 3.37501 3.82517 3.37501 4.12354V16.6935L1.92001 15.2385C1.70675 15.0398 1.42468 14.9316 1.13323 14.9368C0.841778 14.9419 0.563701 15.06 0.357581 15.2661C0.151462 15.4722 0.0333938 15.7503 0.0282514 16.0418C0.0231091 16.3332 0.131294 16.6153 0.330014 16.8285L3.70501 20.2035L4.50001 21ZM13.125 3.00004C12.8266 3.00004 12.5405 3.11856 12.3295 3.32954C12.1185 3.54052 12 3.82667 12 4.12504C12 4.4234 12.1185 4.70955 12.3295 4.92053C12.5405 5.13151 12.8266 5.25004 13.125 5.25004H22.875C23.1734 5.25004 23.4595 5.13151 23.6705 4.92053C23.8815 4.70955 24 4.4234 24 4.12504C24 3.82667 23.8815 3.54052 23.6705 3.32954C23.4595 3.11856 23.1734 3.00004 22.875 3.00004H13.125ZM13.125 7.87504C12.8266 7.87504 12.5405 7.99356 12.3295 8.20454C12.1185 8.41552 12 8.70167 12 9.00004C12 9.2984 12.1185 9.58455 12.3295 9.79553C12.5405 10.0065 12.8266 10.125 13.125 10.125H19.875C20.1734 10.125 20.4595 10.0065 20.6705 9.79553C20.8815 9.58455 21 9.2984 21 9.00004C21 8.70167 20.8815 8.41552 20.6705 8.20454C20.4595 7.99356 20.1734 7.87504 19.875 7.87504H13.125ZM12 13.875C12 13.5767 12.1185 13.2905 12.3295 13.0795C12.5405 12.8686 12.8266 12.75 13.125 12.75H15.375C15.6734 12.75 15.9595 12.8686 16.1705 13.0795C16.3815 13.2905 16.5 13.5767 16.5 13.875C16.5 14.1734 16.3815 14.4596 16.1705 14.6705C15.9595 14.8815 15.6734 15 15.375 15H13.125C12.8266 15 12.5405 14.8815 12.3295 14.6705C12.1185 14.4596 12 14.1734 12 13.875Z" fill="currentColor"/>
                  </g>
                  <defs>
                      <clipPath id="clip0_80_523">
                          <rect width="24" height="24" fill="white"/>
                      </clipPath>
                  </defs>
              </svg>
              Giá cao - thấp
          </button>
        </div>
      </div>

      <div class="newpost-postlist">
      </div>
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

    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>

  <script>
    // filter script
    const filter_button = document.querySelector(".filter-tool");
    const filter = document.querySelector(".filter-background");
    const filter_return = document.querySelector(".filter-return");

    filter_button.addEventListener("click", (e) => {
      if(filter.style.display == "flex") {
        filter.style.display = "none"
      } else {
        filter.style.display = "flex"
      }
    });

    filter_return.addEventListener("click", (e) => {
      if(filter.style.display == "flex") {
        filter.style.display = "none"
      } else {
        filter.style.display = "flex"
      }
    });

    function formatPrice(price) {
        if (price >= 1000000000) return (price / 1000000000).toFixed(1) + " tỷ"
        if (price >= 1000000) return (price / 1000000).toFixed(1) + " triệu"
        return Number(price).toLocaleString("vi-VN")
    }

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

                    // auto update ward and reset after choosing
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

    // filter & sort & page value
    var filterCondition = ""
    var sortCondition = "-createdAt" // default
    var searchCondition = ""
    var page = 1
    var lastPage = 1

    document.querySelector(".filter-apply").addEventListener("click", async (e) => {
      filterCondition = ""

      const stringRegex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{3,255}$/
      const numbRegex = /^\d{1,}$/

      if(document.querySelector(".filter-province-lb-text").textContent.trim() && stringRegex.test(document.querySelector(".filter-province-lb-text").textContent.trim()) && document.querySelector(".filter-province-lb-text").textContent.trim() !== "Chọn tỉnh thành") {
        filterCondition += "&filter[province]=" + document.querySelector(".filter-province-lb-text").textContent.trim()
      }

      if(document.querySelector(".filter-district-lb-text").textContent.trim() && stringRegex.test(document.querySelector(".filter-district-lb-text").textContent.trim()) && document.querySelector(".filter-district-lb-text").textContent.trim() !== "Chọn phường xã") {
        filterCondition += "&filter[ward]=" + document.querySelector(".filter-district-lb-text").textContent.trim()
      }

      if(document.querySelector(".filter-room-lb-text").textContent.trim() && stringRegex.test(document.querySelector(".filter-room-lb-text").textContent.trim()) && document.querySelector(".filter-room-lb-text").textContent.trim() !== "Chọn loại phòng") {
        var roomType = ""
        if(document.querySelector(".filter-room-lb-text").textContent.trim() === "Phòng đơn")
          roomType = "room"

        if(document.querySelector(".filter-room-lb-text").textContent.trim() === "Căn hộ")
          roomType = "apartment"
        
        if(document.querySelector(".filter-room-lb-text").textContent.trim() === "Ký túc xá")
          roomType = "dorm"

        filterCondition += "&filter[roomType]=" + roomType
      }

      if(document.querySelector(".filter-min-price").value.trim() && numbRegex.test(document.querySelector(".filter-min-price").value.trim()) && document.querySelector(".filter-min-price").value.trim() > 0) {
        filterCondition += "&filter[price][]=>=" + document.querySelector(".filter-min-price").value.trim()
      }

      if(document.querySelector(".filter-max-price").value.trim() && numbRegex.test(document.querySelector(".filter-max-price").value.trim()) && document.querySelector(".filter-max-price").value.trim() > 0) {
        filterCondition += "&filter[price][]=<=" + document.querySelector(".filter-max-price").value.trim()
      }

      if(document.querySelector(".filter-square-number").value.trim() && numbRegex.test(document.querySelector(".filter-square-number").value.trim()) && document.querySelector(".filter-square-number").value.trim() > 0) {
        filterCondition += "&filter[area]=" + document.querySelector(".filter-square-number").value.trim()
      }

      if(document.querySelector(".filter-occupants-number").value.trim() && numbRegex.test(document.querySelector(".filter-occupants-number").value.trim()) && document.querySelector(".filter-occupants-number").value.trim() > 0) {
        filterCondition += "&filter[maxOccupants][eq]=" + document.querySelector(".filter-occupants-number").value.trim()
      }

      page = 1
      await updatePostsPage()
      filter_return.click()
    })

    // reset filter
    document.querySelector(".filter-reset").addEventListener("click", (e) => { 
      filterCondition = ""
      document.querySelector(".filter-province-lb-text").textContent = "Chọn tỉnh thành"
      document.querySelector(".filter-district-lb-text").textContent = "Chọn phường xã"
      document.querySelector(".filter-room-lb-text").textContent = "Chọn loại phòng"
      document.querySelector(".filter-min-price").value = 0
      document.querySelector(".filter-max-price").value = 0
      document.querySelector(".filter-square-number").value = 0
      document.querySelector(".filter-apply").click()
    })

    // sort button
    document.querySelector(".posts-newest").addEventListener("click", async (e) => {
      if(!document.querySelector(".posts-newest").classList.contains("posts-sort-selected")) {
        document.querySelector(".posts-newest").classList.add("posts-sort-selected")
      }
      sortCondition = "createdAt"

      document.querySelector(".posts-ascending").classList.remove("posts-sort-selected")
      document.querySelector(".posts-descending").classList.remove("posts-sort-selected")

      page = 1
      await updatePostsPage()
    })
    
    document.querySelector(".posts-ascending").addEventListener("click", async (e) => {
      if(!document.querySelector(".posts-ascending").classList.contains("posts-sort-selected")) {
        document.querySelector(".posts-ascending").classList.add("posts-sort-selected")
      }
      sortCondition = "price"

      document.querySelector(".posts-newest").classList.remove("posts-sort-selected")
      document.querySelector(".posts-descending").classList.remove("posts-sort-selected")

      page = 1
      await updatePostsPage()
    })
    
    document.querySelector(".posts-descending").addEventListener("click", async (e) => {
      if(!document.querySelector(".posts-descending").classList.contains("posts-sort-selected")) {
        document.querySelector(".posts-descending").classList.add("posts-sort-selected")
      }
      sortCondition = "-price"

      document.querySelector(".posts-newest").classList.remove("posts-sort-selected")
      document.querySelector(".posts-ascending").classList.remove("posts-sort-selected")

      page = 1
      await updatePostsPage()
    })

    // search button
    document.querySelector(".search-submit").addEventListener("click", async (e) => {
      searchCondition = ""

      const stringRegex = /^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]{3,255}$/
      if((document.querySelector(".search-bar").value.trim() && stringRegex.test(document.querySelector(".search-bar").value.trim())) || !document.querySelector(".search-bar").value.trim()) {
        searchCondition = "&filter[search]=" + document.querySelector(".search-bar").value.trim()
        page = 1
        await updatePostsPage()
      }

      // reset all field
      document.querySelector(".search-bar").value = ""
    })

    // pagination button
    document.querySelector(".page-extra-prev").addEventListener("click", async (e) => {
      page = 1
      await updatePostsPage()
    })

    document.querySelector(".page-prev").addEventListener("click", async (e) => {
      page = Math.max(1, page - 1)
      await updatePostsPage()
    })

    document.querySelector(".page-extra-next").addEventListener("click", async (e) => {
      page = lastPage
      await updatePostsPage()
    })

    document.querySelector(".page-next").addEventListener("click", async (e) => {
      page = Math.min(lastPage, page + 1)
      await updatePostsPage()
    })
    
    document.querySelector(".page-prev-number").addEventListener("click", async (e) => {
      page = parseInt(document.querySelector(".page-prev-number").textContent.trim())
      await updatePostsPage()
    })
    
    document.querySelector(".page-current-number").addEventListener("click", async (e) => {
      page = parseInt(document.querySelector(".page-current-number").textContent.trim())
      await updatePostsPage()
    })
    
    document.querySelector(".page-next-number").addEventListener("click", async (e) => {
      page = parseInt(document.querySelector(".page-next-number").textContent.trim())
      await updatePostsPage()
    })

    document.querySelector(".page-number").addEventListener("change", async (e) => {
      const pageNumber = document.querySelector(".page-number").value.trim()
      if(!pageNumber)
        page = 1
      else 
        page =  Math.min(lastPage, Math.max(1, parseInt(pageNumber)))

      document.querySelector(".page-number").value = page
      await updatePostsPage()
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

    // get all posts to posts section (do not require token)
    async function getPost(sortCondition, filterCondition, searchCondition, page) {
      try {
        // page = 2 to test pagination
        const response = await fetch("http://backend.test/api/posts?per_page=10&filter[status]=completed&include=postImages,favorites.account&sort=" + sortCondition + filterCondition + searchCondition + "&page=" + page + "&filter[trashed]=without", {
          method: "GET",
          headers: {
            "Accept": "application/json"
          }
        })

        const data = await response.json()
        if(response.ok) {
          if(data.data) {
            // console.log(data.data)
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

    async function updatePostsPage() {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      if (account_id != null && token != null) {
        const posts = await getPost(sortCondition, filterCondition, searchCondition, page)

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
          document.querySelector(".newpost-postlist").innerHTML = html

          // update favorite post when client clicked
          document.querySelector(".newpost-postlist").querySelectorAll(".post-favour").forEach(item => {
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
                    console.error(data)
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
                    console.error(data)
                  }
                } catch (err) {
                  console.error(err)
                }
              }
            })
          })

          // console.log(sortCondition)
          // console.log(filterCondition)
          // console.log(searchCondition)
          // console.log(page)
          // console.log(lastPage)

          updatePageNumber()
        } else {
          document.querySelector(".newpost-postlist").textContent = "Không tìm thấy kết quả phù hợp."
        }
      } else {
        // not login yet
        var posts = await getPost(sortCondition, filterCondition, searchCondition, page)
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
                    <h3 class="post-price">${formatPrice(post.price)} VND/tháng</h3>

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

          updatePageNumber()
        } else {
          document.querySelector(".newpost-postlist").textContent = "Không tìm thấy kết quả phù hợp."
        }
      }
    }

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      await Promise.all([autoFillProvince(account_id, token), updatePostsPage()])
    })
  </script>
</html>