<?php
session_start();
require_once __DIR__ . '/function.php';

header('Content-Type: application/json');

// 1. Kiểm tra xem Request gửi lên có phải là JSON không
$contentType = $_SERVER["CONTENT_TYPE"] ?? '';
$isJson = (stripos($contentType, 'application/json') !== false);

$payload = [];
$targetEndpoint = '';

if ($isJson) {
    // --- LUỒNG XỬ LÝ JSON (Dùng cho Tước quyền/Assign Permissions) ---
    $rawInput = file_get_contents('php://input');
    $payload = json_decode($rawInput, true);
    
    $targetEndpoint = $payload['target_endpoint'] ?? '';
    unset($payload['target_endpoint']);
    
    // Lưu ý: Với JSON, ta gửi nguyên cục $payload (mảng) sang call_api 
    // chứ không làm phẳng (flatten) vì Laravel đọc JSON mảng cực tốt.
} else {
    // --- LUỒNG XỬ LÝ TRUYỀN THỐNG (Giữ nguyên logic cũ của bạn) ---
    $targetEndpoint = $_REQUEST['target_endpoint'] ?? '';
    $method = $_SERVER['REQUEST_METHOD']; 
    $rawData = ($method === 'GET') ? $_GET : $_POST;
    
    // Kiểm tra xem có file nào được gửi lên không
    $hasFiles = !empty($_FILES);

    if ($hasFiles) {
        // CÓ FILE: Phải làm phẳng mảng để cURL gửi dạng multipart/form-data
        foreach ($rawData as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subKey => $subValue) {
                    $payload["{$key}[{$subKey}]"] = $subValue;
                }
            } else {
                $payload[$key] = $value;
            }
        }
    } else {
        // KHÔNG CÓ FILE: Giữ nguyên mảng để hàm call_api chuyển thành JSON chuẩn
        $payload = $rawData;
    }
    
    unset($payload['target_endpoint']);

    // Xử lý file (Giữ nguyên logic $_FILES của bạn)
    if ($hasFiles) {
        foreach ($_FILES as $key => $fileInfo) {
            if (is_array($fileInfo['name'])) {
                foreach ($fileInfo['name'] as $subKey => $name) {
                    if ($fileInfo['error'][$subKey] === UPLOAD_ERR_OK) {
                        $curlKey = $key . '[' . $subKey . ']'; 
                        $payload[$curlKey] = new CURLFile(
                            $fileInfo['tmp_name'][$subKey], 
                            $fileInfo['type'][$subKey], 
                            $name
                        );
                    }
                }
            } else {
                if ($fileInfo['error'] === UPLOAD_ERR_OK) {
                    $payload[$key] = new CURLFile(
                        $fileInfo['tmp_name'], 
                        $fileInfo['type'], 
                        $fileInfo['name']
                    );
                }
            }
        }
    }
}

if (empty($targetEndpoint)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Thiếu đích đến (target_endpoint).']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD']; 
$apiUrl = "http://127.0.0.1:8000/api/" . $targetEndpoint;
// GỌI API: Bạn cần đảm bảo hàm call_api trong function.php 
// có thể nhận diện nếu $payload là mảng JSON thì set Header Content-Type tương ứng.
$apiResponse = call_api($apiUrl, $method, $payload);

if ($targetEndpoint === 'login' && isset($apiResponse['token'])) {
    // 1. Lưu Token vào Session để các API sau sử dụng
    $_SESSION['api_token'] = $apiResponse['token'];
    
    // 2. Lưu thêm thông tin Admin để hiển thị ở trang Index (nếu muốn)
    $_SESSION['admin_id'] = $apiResponse['account']['id'];
    $_SESSION['admin_user'] = $apiResponse['account']['username'];
    $_SESSION['admin_role'] = $apiResponse['account']['role'];

    // 3. Xóa token và password (nếu có) trước khi trả về cho JS (bảo mật)
    unset($apiResponse['token']);
    if(isset($apiResponse['account']['password'])) {
        unset($apiResponse['account']['password']);
    }
    
    // Gán thêm status để JS dễ kiểm tra
    $apiResponse['status'] = 'success';
    $apiResponse['message'] = "Đăng nhập thành công!";
}

echo json_encode($apiResponse);
exit;