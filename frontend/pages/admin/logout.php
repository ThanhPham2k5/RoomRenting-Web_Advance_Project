<?php
session_start();
require_once __DIR__ . '/core/function.php';
if (isset($_SESSION['api_token'])) {
    $apiUrl = "http://backend.test/api/logout";
    call_api($apiUrl, 'POST', []); 
}
$_SESSION = []; // Xóa trắng mảng session
session_unset(); // Xóa các biến session
session_destroy(); // Hủy hoàn toàn phiên làm việc
header('Location: login.php');
exit;