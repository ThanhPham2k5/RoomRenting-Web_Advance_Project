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
?>