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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/my-profile.css" ?>'/>

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
    <title>Profile Page | RoomRenting</title>
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

    <div class="profile-block">
        <div class="profile">
            <div class="user-profile">
              <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="avatar.png" class="user-avatar">

              <div class="user-name">Người dùng</div>

              <a href='<?php echo BASE_URL . "/pages/client/setting-profile.php"?>' class="profile-user-link">
                <img src='<?php echo BASE_URL . "/assets/img/modify.png"?>' alt="modify.png" class="profile-user-link-img">

                <div class="profile-user-link-text">Chỉnh sửa thông tin cá nhân</div>
              </a>

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
            </div>

            <div class="my-post">
                <h2 class="my-post-title">Bài đăng của bạn</h2>

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

                <div class="newpost-postlist">
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

                <!-- using when there is no post -->
                <div class="no-post">
                    <h2 class="no-post-main">Bạn chưa có bài đăng nào</h2>

                    <a href="" class="no-post-btn">Đăng bài ngay</a>
                </div>
            </div>
        </div>
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
                alert("Tải thông tin tỉnh thành thất bại.")
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
                alert("Tải thông tin phường xã thất bại.")
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
      // document.querySelector(".filter-province-lb-text").textContent = "Chọn tỉnh thành"
      // document.querySelector(".filter-district-lb-text").textContent = "Chọn phường xã"
      // document.querySelector(".filter-room-lb-text").textContent = "Chọn loại phòng"
      // document.querySelector(".filter-min-price").value = 0
      // document.querySelector(".filter-max-price").value = 0
      // document.querySelector(".filter-square-number").value = 0
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
    async function getPost(sortCondition, filterCondition, searchCondition, page, account_id, token) {
      try {
        // page = 2 to test pagination
        const response = await fetch("http://backend.test/api/posts?per_page=10&filter[status]=completed&include=postImages&sort=" + sortCondition + filterCondition + searchCondition + "&page=" + page + "&filter[user.account_id]=" + account_id, {
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
            lastPage = data.meta.last_page
            return data.data
          }
        } else {
          console.error(data)
          alert("Tải danh sách bài đăng thất bại.")
        }
      } catch (err) {
        console.error(err)
      }
    }

    async function updatePostsPage() {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")
      // console.log(sortCondition)
      // console.log(filterCondition)
      // console.log(searchCondition)
      // console.log(page)
      // console.log(lastPage)

      if (account_id != null && token != null) {
        const posts = await getPost(sortCondition, filterCondition, searchCondition, page, account_id, token)

        if(posts != null && posts.length > 0) {
          let html = ""

          posts.forEach(post => {
            var money = Number(post.price).toLocaleString("vi-VN")

            html += `
              <div class="post">
                <a href='<?php echo BASE_URL ?>/pages/client/detail-post.php?post_id=${post.id}' class="post-body">
                    <img
                        src='http://backend.test${post.postImages[0].imagePostUrl}'
                        alt="post.png"
                        class="post-img"
                    />

                    <div class="post-profile-info">
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
                    </div>
                </a>
              </div>
            `
          });
          
          document.querySelector(".newpost-postlist").innerHTML = html

          updatePageNumber()
        } else if (filterCondition == null && searchCondition == null) {
          document.querySelector(".newpost-postlist").style.display = "none"
          document.querySelector(".pagination").style.display = "none"
          document.querySelector(".no-post").style.display = "flex"
        } else {
          document.querySelector(".newpost-postlist").textContent = "Không tìm thấy kết quả phù hợp."
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

      await Promise.all([autoFillProvince(account_id, token), updatePostsPage()])
    })
  </script>
</html>