<?php
function render_component($component_name, $props = []) {
    extract($props); 
    
    $path = __DIR__ . "/../components/{$component_name}.php";
    
    if (file_exists($path)) {
        include $path;
    } else {
        echo "Lỗi: Không tìm thấy component {$component_name}";
    }
}
?>