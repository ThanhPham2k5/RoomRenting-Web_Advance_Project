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
        "Authorization: Bearer 1|Vi64JEleBS7aReqe56i3ezDvUza24h1y7h1zZm8Z1086099c"
    ];
    if (!$hasFile) {
        $headers[] = "Content-Type: application/json";
    }
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ];
    if (($method == 'POST' || $method == 'PUT' || $method == 'PATCH') && !empty($data)) {
        if ($hasFile) {
            $options[CURLOPT_POSTFIELDS] = $data;
        } else {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }
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