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
    <link rel="stylesheet" href='<?php echo BASE_URL . "/css/client/pages/detail-post.css" ?>'/>

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
    <title>Detail Post Page | RoomRenting</title>
  </head>
  <body>
    <?php include(__DIR__ . "/components/header.php"); ?>

    <div class="image-background">
        <div class="image-block">
            <div class="image-close">x</div>

            <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="image.png" class="image-img">
        </div>
    </div>

    <div class="content">
        <div class="content-left">
            <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img">

            <div class="left-img-list">
                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img-1">

                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img-2">

                <img src='<?php echo BASE_URL . "/assets/img/left-img.png"?>' alt="left-img.png" class="left-img-3">
            </div>

            <div class="left-title">
                <h2 class="left-main-text"></h2>

                <img src='<?php echo BASE_URL . "/assets/img/favour.png" ?>' alt="favourite.png" class="left-favourite">
            </div>

            <div class="left-address">
                <img src='<?php echo BASE_URL . "/assets/img/address.png"?>' alt="left-address-ico.png" class="left-address-ico">

                <div class="left-address-text"></div>
            </div>

            <div class="left-info">
                <h3 class="left-info-money"></h3>

                <div class="left-info-square"></div>
            </div>

            <h3 class="left-deposit"></h3>

            <div class="left-room">
                <h3>Loại phòng: </h3>

                <div class="left-room-info"></div>
            </div>

            <div class="left-occupants">
                <h3>Số người tối đa: </h3>

                <div class="left-occupants-info"></div>
            </div>

            <div class="left-desc">
                <h3>Mô tả chi tiết: </h3>

                <div class="left-desc-info"></div>
            </div>

            <div class="left-map">
                <h3>Xem trên bản đồ</h3>

                <div class="left-map-api">
                    <!-- place map api here -->
                     <img src='<?php echo BASE_URL . "/assets/img/map-api.png"?>' alt="map.png" class="left-map-img">
                </div>
            </div>
        </div>

        <div class="content-right">
            <div class="right-owner">
                <div class="owner-info">
                    <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="owner-avatar.png" class="owner-avatar">

                    <div class="owner-name">Người dùng</div>
                </div>

                <button type="button" class="owner-phone">
                    <img src='<?php echo BASE_URL . "/assets/img/phone-ico.png"?>' alt="phone-ico.png" class="phone-ico">

                    <div class="phone-info">Liên hệ tôi: xxxxxxxxxx</div>
                </button>
            </div>

            <div class="right-comment">
                <h3>Bình luận</h3>

                <!-- using when no comments found -->
                <div class="comment-box-false">
                    <img src='<?php echo BASE_URL . "/assets/img/comment-img.png"?>' alt="comment-img.png" class="comment-img">

                    <p>Chưa có bình luận nào. </br>Hãy để lại bình luận cho người bán.</p>
                </div>

                <!-- using when exsits comments -->
                 <div class="comment-box-true">
                    <div class="comment-section">
                    </div>

                    <div class="more">Xem thêm</div>
                 </div>

                 <div class="comment-line"></div>

                 <div class="comment-input">
                    <div class="comment-input-box">
                        <img src='<?php echo BASE_URL . "/assets/img/avatar-test.png"?>' alt="comment-user-avatar.png" class="comment-user-avatar">

                        <textarea type="text" name="user-input" id="user-input" class="user-input" placeholder="Bình luận..."></textarea>
                    </div>

                    <button type="button" class="user-submit">
                        <img src='<?php echo BASE_URL ."/assets/img/user-submit-ico.png"?>' alt="user-submit-ico.png" class="user-submit-ico">
                    </button>
                 </div>
            </div>
        </div>
    </div>
    
    <?php include(__DIR__ . "/components/footer.php") ?>
  </body>
  <script>
    const params = new URLSearchParams(window.location.search)
    const post_id = params.get("post_id")
    var post_owner_id = null
    var page = 1

    // choose image
    document.querySelector(".left-img").addEventListener("click", (e) => {
        document.querySelector(".image-img").src = document.querySelector(".left-img").src
        document.querySelector(".image-background").style.display = "flex"
    })
    
    document.querySelector(".left-img-1").addEventListener("click", (e) => {
        document.querySelector(".image-img").src = document.querySelector(".left-img-1").src
        document.querySelector(".image-background").style.display = "flex"
    })
    
    document.querySelector(".left-img-2").addEventListener("click", (e) => {
        document.querySelector(".image-img").src = document.querySelector(".left-img-2").src
        document.querySelector(".image-background").style.display = "flex"
    })
    
    document.querySelector(".left-img-3").addEventListener("click", (e) => {
        document.querySelector(".image-img").src = document.querySelector(".left-img-3").src
        document.querySelector(".image-background").style.display = "flex"
    })

    // close image
    document.querySelector(".image-close").addEventListener("click", (e) => {
        document.querySelector(".image-background").style.display = "none"
    })

    async function updateDetailPost(account_id, token) {
        try {
            const [response, comments, personalInfo] = await Promise.all([fetch("http://backend.test/api/posts/" + post_id + "?include=postImages,user.personalInfo,favorites.account", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }), fetch("http://backend.test/api/comments?include=account.user.personalInfo&per_page=5&filter[post.id]=" + post_id + "&page=" + page + "&sort=-createdAt", {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            }), fetch("http://backend.test/api/personalInfos/byAccount/" + account_id, {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + token
                }
            })])

            const data = await response.json()
            if(response.ok) {
                if(data.data && data.data.status === "completed") {
                    // update post image
                    if(data.data.postImages) {
                        if(data.data.postImages[0]) {
                            document.querySelector(".left-img").src = "http://backend.test" + data.data.postImages[0].imagePostUrl
                        }
                        
                        if(data.data.postImages[1]) {
                            document.querySelector(".left-img-1").src = "http://backend.test" + data.data.postImages[1].imagePostUrl
                        }

                        
                        if(data.data.postImages[2]) {
                            document.querySelector(".left-img-2").src = "http://backend.test" + data.data.postImages[2].imagePostUrl
                        }

                        
                        if(data.data.postImages[3]) {
                            document.querySelector(".left-img-3").src = "http://backend.test" + data.data.postImages[3].imagePostUrl
                        }
                    }

                    // update post info
                    // console.log(data.data)
                    document.querySelector(".left-main-text").textContent = data.data.title
                    document.querySelector(".left-address-text").textContent = data.data.houseNumber + ", " + data.data.ward + ", " + data.data.province
                    document.querySelector(".left-info-money").textContent = Number(data.data.price).toLocaleString("vi-VN") + " VND/tháng"
                    document.querySelector(".left-info-square").textContent = Number(data.data.area).toLocaleString("vi-VN") + " m2"
                    document.querySelector(".left-deposit").textContent = "Số tiền cọc: " + Number(data.data.deposit).toLocaleString("vi-VN") + " VND"
                    if(data.data.roomType === "room")
                        document.querySelector(".left-room-info").textContent = "Phòng đơn"
                    if(data.data.roomType === "apartment")
                        document.querySelector(".left-room-info").textContent = "Căn hộ"
                    if(data.data.roomType === "dorm")
                        document.querySelector(".left-room-info").textContent = "Ký túc xá"
                    document.querySelector(".left-occupants-info").textContent = data.data.maxOccupants + " người"
                    document.querySelector(".left-desc-info").textContent = data.data.description

                    // update favorite ico
                    // check isFav or not
                    var isFav = false
                    var favId = ""
                    data.data.favorites.forEach(favorite => {
                        // console.log(favorite)
                        if(favorite.account.id == account_id) {
                            isFav = true
                            favId = favorite.id
                        }
                    })
                    var favIco = isFav ? "favour" : "unfavour"

                    document.querySelector(".left-favourite").classList.add("post-id-" + post_id)
                    document.querySelector(".left-favourite").classList.add("favourite-id-" + favId)
                    document.querySelector(".left-favourite").classList.add(favIco)
                    document.querySelector(".left-favourite").src = "<?php echo BASE_URL ?>/assets/img/" + favIco + ".png"

                    document.querySelector(".left-favourite").addEventListener("click", async (e) => {
                        var favIco = document.querySelector(".left-favourite").classList.contains("favour")
                        const postClass = [...document.querySelector(".left-favourite").classList].find(c => c.startsWith("post-id-"))
                        var post_id = postClass.replace("post-id-", "")

                        // create new favorite
                        if(!favIco) {
                        document.querySelector(".left-favourite").classList.remove("unfavour")
                        document.querySelector(".left-favourite").classList.add("favour")
                        document.querySelector(".left-favourite").setAttribute("src", '<?php echo BASE_URL ?>/assets/img/favour.png')

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
                                const favClass = [...document.querySelector(".left-favourite").classList].find(c => c.startsWith("favourite-id-"))
                                if(favClass) {
                                document.querySelector(".left-favourite").classList.remove(favClass)
                                document.querySelector(".left-favourite").classList.add("favourite-id-" + data.favorite.id)
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
                        document.querySelector(".left-favourite").classList.remove("favour")
                        document.querySelector(".left-favourite").classList.add("unfavour")
                        document.querySelector(".left-favourite").setAttribute("src", '<?php echo BASE_URL ?>/assets/img/unfavour.png')
                        const favClass = [...document.querySelector(".left-favourite").classList].find(c => c.startsWith("favourite-id-"))
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

                    // update post owner
                    document.querySelector(".owner-avatar").src = data.data.user.personalInfo.profileUrl
                    document.querySelector(".owner-name").textContent = data.data.user.personalInfo.name
                    document.querySelector(".phone-info").textContent = "Liên hệ tôi: " + data.data.user.personalInfo.phoneNumber
                    post_owner_id = data.data.user.id

                    // update comment section
                    const commentList = await comments.json()
                    if(comments.ok) {
                        if(commentList) {
                            if(commentList.data != null && commentList.data.length > 0) {
                                document.querySelector(".comment-box-false").style.display = "none"
                                document.querySelector(".comment-box-true").style.display = "flex"

                                // comment list
                                let html = ""

                                commentList.data.forEach(comment => {
                                    var date = new Date(comment.createdAt).toLocaleString()
                                    var author = data.data.user.id === comment.account.user.id ? " - tác giả" : ""
                                    html += `
                                        <div class="user-comment">
                                            <img src=${comment.account.user.personalInfo.profileUrl} alt="other-avatar.png" class="other-avatar">

                                            <div class="other-comment">
                                                <div class="other-name">${comment.account.username}${author}</div>

                                                <div class="other-comment-text">${comment.content}</div>

                                                <div class="other-comment-time">${date}</div>
                                            </div>
                                        </div>
                                    `
                                })

                                document.querySelector(".comment-section").innerHTML = html
                            } else {
                                document.querySelector(".comment-box-false").style.display = "flex"
                                document.querySelector(".comment-box-true").style.display = "none"
                            }
                        }
                    } else {
                        console.error(comments)
                    }

                    // update comment input
                    const info = await personalInfo.json()
                    if(personalInfo.ok) {
                        if(info.data) {
                            document.querySelector(".comment-user-avatar").src = info.data.profileUrl
                        }
                    } else {
                        console.error(info)
                    }
                } else {
                    alert("Bài đăng không tồn tại.")
                    window.location.href = "index.php"
                }
            } else {
                console.error(data)
            }
        } catch (err) {
            console.error(err)
        }
    }

    // more comment button
    document.querySelector(".more").addEventListener("click", async (e) => {
        var account_id = localStorage.getItem("account_id")
        var token = localStorage.getItem("token")

        if (account_id != null && token != null) {
            page++

            try {
                const response = await fetch("http://backend.test/api/comments?include=account.user.personalInfo&per_page=5&filter[post.id]=" + post_id + "&page=" + page + "&sort=-createdAt", {
                    method: "GET",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    }
                })

                const data = await response.json()
                if(response.ok) {
                    if(data) {
                        // console.log(data)
                        if(data.data != null && data.data.length > 0) {
                            if(page === data.meta.last_page) {
                                document.querySelector(".more").style.display = "none"
                            }

                            // comment list
                            let html = ""

                            data.data.forEach(comment => {
                                var date = new Date(comment.createdAt).toLocaleString()
                                var author = post_owner_id === comment.account.user.id ? " - tác giả" : ""
                                html += `
                                    <div class="user-comment">
                                        <img src=${comment.account.user.personalInfo.profileUrl} alt="other-avatar.png" class="other-avatar">

                                        <div class="other-comment">
                                            <div class="other-name">${comment.account.username}${author}</div>

                                            <div class="other-comment-text">${comment.content}</div>

                                            <div class="other-comment-time">${date}</div>
                                        </div>
                                    </div>
                                `
                            })

                            document.querySelector(".comment-section").innerHTML += html
                        } else {
                            document.querySelector(".more").style.display = "none"
                        }
                    }
                } else {
                    console.error(response)
                }
            } catch (err) {
                console.error(err)
            }
        } else {
            alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
            window.location.href = "login.php"
        }
    })

    const badWords = [
        // Chửi thề tiếng Việt phổ biến
        "đ.m", "đmm", "đm", "vkl", "vcl", "clm", "đcm", "đcmm",
        "mẹ mày", "mẹ m", "con chó", "thằng chó", "đồ chó",
        "thằng khốn", "đồ khốn", "khốn nạn", "đồ ngu", "thằng ngu",
        "con ngu", "ngu vl", "ngu vcl", "óc chó", "não cá vàng",
        "đồ điên", "thằng điên", "con điên", "mày điên",
        "thằng lồn", "con lồn", "cái lồn", "con cặc",
        "địt mẹ", "địt con", "đụ mẹ", "đụ má",
        "má mày", "bố mày", "tổ cha mày",
        "thằng chết", "con chết", "đồ chết tiệt",
        "đồ súc vật", "súc sinh", "đồ súc sinh",
        "thằng súc vật", "con súc vật",
        "mặt l", "mặt c", "thằng mặt l",
        "đồ phản bội", "thằng hèn", "con hèn", "đồ hèn",
        "thằng bần tiện", "đồ bần tiện", "bần tiện",
        "thằng vô học", "đồ vô học", "vô học",
        "thằng vô liêm sỉ", "đồ vô liêm sỉ", "vô liêm sỉ",
        "đồ mất dạy", "thằng mất dạy", "con mất dạy", "mất dạy",
        "đồ láo", "thằng láo", "con láo",
        "đồ lưu manh", "thằng lưu manh", "lưu manh",
        "đồ đểu", "thằng đểu", "con đểu", "đểu cáng",
        "thằng ăn cướp", "đồ ăn cướp",
        "thằng ăn trộm", "đồ ăn trộm",
        "thằng lừa đảo", "đồ lừa đảo",
        "thằng phản động", "đồ phản động",
        "nói láo", "nói dối", "kẻ dối trá",
        "thằng bẩn", "con bẩn", "đồ bẩn thỉu",
        "thằng khùng", "con khùng", "đồ khùng",
        "thằng dở hơi", "con dở hơi", "dở hơi",
        "thằng đần", "con đần", "đồ đần độn", "đần độn",
        "thằng tâm thần", "con tâm thần",
        "thằng điên khùng", "con điên khùng",
        "đồ vô dụng", "thằng vô dụng", "vô dụng",
        "thằng ăn hại", "đồ ăn hại", "ăn hại",
        "thằng phá hoại", "đồ phá hoại",
        "đồ cặn bã", "cặn bã xã hội",
        "thằng rác rưởi", "đồ rác rưởi", "rác rưởi",
        "đồ thối nát", "thối nát",
        "thằng hèn mọn", "đồ hèn mọn", "hèn mọn",
        "thằng ti tiện", "đồ ti tiện", "ti tiện",
        "đồ đê tiện", "thằng đê tiện", "đê tiện",
        "thằng bịp bợm", "đồ bịp bợm", "bịp bợm",
        "thằng lố bịch", "đồ lố bịch", "lố bịch",
        "thằng tởm", "con tởm", "đồ tởm",
        "ghê tởm", "kinh tởm",
        "thằng bệnh hoạn", "đồ bệnh hoạn", "bệnh hoạn",
        "thằng biến thái", "đồ biến thái", "biến thái",
        "thằng biến chất", "đồ biến chất",
        "thằng tồi tệ", "đồ tồi tệ", "tồi tệ",
        "đồ đáng khinh", "kẻ đáng khinh",
        "thằng hạ tiện", "đồ hạ tiện", "hạ tiện",
        "đồ bỉ ổi", "thằng bỉ ổi", "bỉ ổi",
        "đồ xấu xa", "thằng xấu xa", "xấu xa",
        "thằng nhơ bẩn", "đồ nhơ bẩn", "nhơ bẩn",
        "thằng tanh hôi", "đồ tanh hôi",
        "đồ chó đẻ", "chó đẻ",
        "đồ dơ bẩn", "dơ bẩn",
        "thằng ký sinh", "đồ ký sinh", "ký sinh",
        "kẻ thù", "quân thù",
        "tên tội phạm", "tên cướp", "tên trộm",
        "mày", "tao", "ngu", "cút", "xéo",
        "dốt", "gà vcl", "chết",

        // Tiếng Anh
        "fuck", "shit", "bitch", "asshole", "bastard",
        "idiot", "stupid", "moron", "dumb", "loser",
        "wtf", "stfu", "gtfo", "kys",
        "retard", "faggot", "nigger", "whore", "slut",
        "cunt", "dick", "cock", "pussy", "ass",
        "motherfucker", "fucker", "bullshit",
        "dumbass", "jackass", "dipshit",
        "scumbag", "trash", "garbage", "worthless",
        "piece of shit", "son of a bitch",
        "go to hell", "drop dead",
    ]

    function containsBadWords(text) {
        const lowerText = text.toLowerCase()
        return badWords.some(word => lowerText.includes(word.toLowerCase()))
    }

    // send comment
    document.querySelector(".user-submit-ico").addEventListener("click", async (e) => {
        var account_id = localStorage.getItem("account_id")
        var token = localStorage.getItem("token")

        if (account_id != null && token != null) {
            const content = document.querySelector(".user-input").value.trim()
            if(!content) {
                alert("Vui lòng nhập bình luận!")
                return
            }

            if(containsBadWords(content)) {
                alert("Bình luận chứa nội dung không phù hợp. Vui lòng chỉnh sửa lại!!")
                return
            }

            try {
                const response = await fetch("http://backend.test/api/comments", {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "Authorization": "Bearer " + token
                    },
                    body: JSON.stringify({
                        "content": content,
                        "account_id": account_id,
                        "post_id": post_id
                    })
                })

                const data = await response.json()
                if(response.ok) {
                    if(data.message === "Comment created successfully") {
                        document.querySelector(".user-input").value = ""

                        // add new comment into the comment section
                        let html = ""
                        html = `
                            <div class="user-comment">
                                <img src=${document.querySelector(".comment-user-avatar").src} alt="other-avatar.png" class="other-avatar">

                                <div class="other-comment">
                                    <div class="other-name">${document.querySelector(".user-name").textContent}</div>

                                    <div class="other-comment-text">${content}</div>

                                    <div class="other-comment-time">${new Date().toLocaleString()}</div>
                                </div>
                            </div>
                        `
                        document.querySelector(".comment-section").innerHTML = html + document.querySelector(".comment-section").innerHTML
                    }
                } else {
                    console.error(response)
                }
            } catch (err) {
                console.error(err)
            }
        } else {
            alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
            window.location.href = "login.php"
        }
    })

    // run once time every reload or load page
    document.addEventListener("DOMContentLoaded", async (e) => {
      var account_id = localStorage.getItem("account_id")
      var token = localStorage.getItem("token")

      if (account_id != null && token != null) {
        await updateDetailPost(account_id, token)
      } else {
        alert("Bạn chưa đăng nhập. Đang chuyển hướng sang trang đăng nhập.")
        window.location.href = "login.php"
      }
    })
  </script>
</html>
