<?php 
    $titleContent = $titleContent ?? "";
    $group = $group ?? false;
?>

<div class="title-component">
    <p class="content"><?php echo $titleContent ?></p>
    <?php  
    if($group){
    ?>
        <div class="group">
            <div class="item">
                <div class="info">
                    <p class="sub-info">Tổng lượt truy cập</p>
                    <p>40,689</p>
                </div>
                <div class="icon">
                    <svg width="45" height="48" viewBox="0 0 45 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.25 11.25C11.25 17.4525 16.2975 22.5 22.5 22.5C28.7025 22.5 33.75 17.4525 33.75 11.25C33.75 5.0475 28.7025 0 22.5 0C16.2975 0 11.25 5.0475 11.25 11.25ZM42.5 47.5H45V45C45 35.3525 37.1475 27.5 27.5 27.5H17.5C7.85 27.5 0 35.3525 0 45V47.5H42.5Z" fill="currentColor"/>
                    </svg>
                </div>
            </div>
            <div class="item">
                <div class="info">
                    <p class="sub-info">Tổng số tin đăng</p>
                    <p>40,689</p>
                </div>
                <div class="icon">
                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M40 45H5C3.625 45 2.44833 44.5108 1.47 43.5325C0.491667 42.5542 0.00166667 41.3767 0 40V5C0 3.625 0.49 2.44833 1.47 1.47C2.45 0.491667 3.62667 0.00166667 5 0H40C41.375 0 42.5525 0.49 43.5325 1.47C44.5125 2.45 45.0017 3.62667 45 5V40C45 41.375 44.5108 42.5525 43.5325 43.5325C42.5542 44.5125 41.3767 45.0017 40 45ZM37.5 35H7.5V38.75H37.5V35ZM7.5 31.25H37.5V27.5H7.5V31.25ZM7.5 22.5H37.5V7.5H7.5V22.5Z" fill="currentColor"/>
                    </svg>
                </div>
            </div>
            <div class="item">
                <div class="info">
                    <p class="sub-info">Tổng doanh thu</p>
                    <p>40,689</p>
                </div>
                <div class="icon">
                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 2.5V42.5C2.5 43.8261 3.02678 45.0979 3.96447 46.0355C4.90215 46.9732 6.17392 47.5 7.5 47.5H47.5" stroke="currentColor" stroke-width="5" stroke-miterlimit="5.759" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg class="part2" width="40" height="20" viewBox="0 0 40 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 17.5L12.5 7.5L22.5 17.5L37.5 2.5" stroke="currentColor" stroke-width="5" stroke-miterlimit="5.759" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg class="part3" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 2.5H10V10" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    <?php
    }
    ?>    
</div>