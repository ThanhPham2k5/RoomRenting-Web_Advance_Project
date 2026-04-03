<?php
function renderComponent($componentName, $isPage, $props = []) {
    extract($props); 
    
    if($isPage){
        $path = __DIR__ . "/../pages/{$componentName}.php";
    } else{
        $path = __DIR__ . "/../components/{$componentName}.php";
    }
    
    if (file_exists($path)) {
        include $path;
    } else {
        echo "Lỗi: Không tìm thấy component {$componentName}";
    }
}
function call_api($url, $method = 'GET', $data = []) {
    $curl = curl_init();
    $token = $_SESSION['api_token'] ?? '';
    // 1. Kiểm tra xem trong dữ liệu có File (CURLFile) không
    $hasFile = false;
    if (is_array($data) || is_object($data)) {
        foreach ($data as $key => $value) {
            if ($value instanceof CURLFile) {
                $hasFile = true;
                break;
            }
        }
    }

    $headers = [
        "Accept: application/json",
        "Authorization: Bearer " . $token
    ];

    // 2. NẾU KHÔNG CÓ FILE -> GỬI DƯỚI DẠNG JSON
    // Điều này giúp giữ nguyên cấu trúc mảng roles: ["admin", "user"] hoặc roles: []
    if (!$hasFile && !empty($data) && $method !== 'GET') {
        $headers[] = "Content-Type: application/json";
        $data = json_encode($data); 
    }

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ];

    // 3. Đưa dữ liệu vào Body (cho POST, PUT, PATCH...)
    if ($method !== 'GET' && !empty($data)) {
        $options[CURLOPT_POSTFIELDS] = $data;
    }

    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return [
            'status' => 'error',
            'message' => 'CURL Error: ' . $err
        ];
    } else {
        $decoded = json_decode($response, true);
        return $decoded ?? [];
    }
}
?>