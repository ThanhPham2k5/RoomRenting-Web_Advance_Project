<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản trị viên | Đăng nhập</title>
    <link rel="stylesheet" href="../../css/admin/reset.css" />
    <link rel="stylesheet" href="../../css/admin/main.css" />
    <link rel="stylesheet" href="../../css/admin/login.css" />
</head>
<body>
    <div class="admin-login-layout">
        <div class="login-box">
            <div class="login-brand">
                <div class="logo-wrapper">
                    <img src="../../assets/admin/images/logoadmin.jpg" alt="Admin Logo" class="admin-logo">
                </div>
            </div>
            
            <div class="login-title">
                <h1>Admin System</h1>
                <p>Chào mừng trở lại! Vui lòng đăng nhập.</p>
            </div>

            <form id="adminLoginForm" onsubmit="handleAdminLogin(event)">
                <div class="input-field">
                    <label>Tên đăng nhập</label>
                    <div class="input-control">
                        <input type="text" name="username" required placeholder="Nhập tài khoản...">
                    </div>
                </div>

                <div class="input-field">
                    <label>Mật khẩu</label>
                    <div class="input-control">
                        <input type="password" name="password" id="adminPassword" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="btn-admin-submit">
                    <span>Đăng nhập</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </form>
        </div>
    </div>
    </div>
</body>
</html>
<script>
    function handleAdminLogin(event) {
    event.preventDefault();
    
    // Lấy dữ liệu từ form
    const form = event.target;
    const payload = {
        login: form.username.value,
        password: form.password.value,
        target_endpoint: 'login'
    };

    fetch('core/api_proxy.php', {
        method: 'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success' || data.token || data.message === "Đăng nhập thành công!") {
            // Đăng nhập xong rồi, Proxy đã giữ Token, giờ chỉ việc đi thôi!
            window.location.href = 'index.php';
        } else {
            alert(data.message || 'Tài khoản hoặc mật khẩu không đúng!');
        }
    })
    .catch(err => {
        console.error("Login Error:", err);
        alert("Lỗi hệ thống, vui lòng thử lại!");
    });
}
</script>