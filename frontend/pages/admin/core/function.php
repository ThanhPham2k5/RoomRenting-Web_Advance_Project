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
        "Authorization: Bearer 1|WR9Zqt9bzZevvMzRR9YW5aED1t2OGePlxFtaVbqw5a9dea03"
    ];
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ];
    if (($method == 'POST') && !empty($data)) {
        $options[CURLOPT_POSTFIELDS] = $data;
    }
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return [];
    } else {
        $decoded = json_decode($response, true);
        return $decoded ?? [];
    }
}
?>