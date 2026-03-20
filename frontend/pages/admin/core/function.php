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
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer 3|0cd07p7fJ57Vz5ARwF4S1bXy4cgiUT191TTLZDtO3d06dccf"
        ],
    ];

    if (($method == 'POST' || $method == 'PUT') && !empty($data)) {
        $options[CURLOPT_POSTFIELDS] = json_encode($data);
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