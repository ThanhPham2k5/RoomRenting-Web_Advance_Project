<?php
session_start();
require_once __DIR__ . '/function.php';

header('Content-Type: application/json');

// if (!isset($_SESSION['api_token'])) {
//     http_response_code(401);
//     echo json_encode(['status' => 'error', 'message' => 'Lỗi bảo mật: Chưa có Token.']);
//     exit;
// }

$targetEndpoint = $_REQUEST['target_endpoint'] ?? '';
if (empty($targetEndpoint)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Thiếu đích đến (target_endpoint).']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD']; 

$payload = $_POST;
if ($method === 'GET') {
    $payload = $_GET;
}

unset($payload['target_endpoint']);

if (!empty($_FILES)) {
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
        } 
        else {
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

$apiUrl = "http://127.0.0.1:8000/api/" . $targetEndpoint;
$apiResponse = call_api($apiUrl, $method, $payload);

echo json_encode($apiResponse);
exit;