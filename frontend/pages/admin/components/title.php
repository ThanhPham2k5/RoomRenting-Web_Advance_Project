<?php 
    $titleContent = $titleContent ?? "";
    $group = $group ?? false;
    $insert = $insert ?? false;
    $edit = $edit ?? false;
    $delete = $delete ?? false;
    $handle = $handle ?? false;
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
    <div class="cta">
        <?php 
            if($insert){        
        ?> 
            <div class="btn_insert">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18ZM10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C3.85752 17.9997 4.95991 18.7362 6.17317 19.2388C7.38642 19.7413 8.68678 20 10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0ZM11 5H9V9H5V11H9V15H11V11H15V9H11V5Z" fill="currentColor"/>
                </svg>
                <p>Thêm</p>
            </div>
        <?php 
        }
        ?>
        <?php 
            if($edit || $handle){        
        ?> 
           <div class="btn_edit">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 3.00011L11 6.00011M12.385 4.58511C12.7788 4.19126 13.0001 3.65709 13.0001 3.10011C13.0001 2.54312 12.7788 2.00895 12.385 1.61511C11.9912 1.22126 11.457 1 10.9 1C10.343 1 9.80885 1.22126 9.415 1.61511L1 10.0001V13.0001H4L12.385 4.58511Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p><?php if($edit) {
                    echo "Sửa";
                }else{
                    echo "Xử lý";
                } ?></p>
            </div>
        <?php 
        }
        ?>
        <?php 
            if($delete){        
        ?> 
            <div class="btn_delete">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 2C5 1.46957 5.21071 0.960859 5.58579 0.585786C5.96086 0.210714 6.46957 0 7 0H13C13.5304 0 14.0391 0.210714 14.4142 0.585786C14.7893 0.960859 15 1.46957 15 2V4H19C19.2652 4 19.5196 4.10536 19.7071 4.29289C19.8946 4.48043 20 4.73478 20 5C20 5.26522 19.8946 5.51957 19.7071 5.70711C19.5196 5.89464 19.2652 6 19 6H17.931L17.064 18.142C17.0281 18.6466 16.8023 19.1188 16.4321 19.4636C16.0619 19.8083 15.5749 20 15.069 20H4.93C4.42414 20 3.93707 19.8083 3.56688 19.4636C3.1967 19.1188 2.97092 18.6466 2.935 18.142L2.07 6H1C0.734784 6 0.48043 5.89464 0.292893 5.70711C0.105357 5.51957 0 5.26522 0 5C0 4.73478 0.105357 4.48043 0.292893 4.29289C0.48043 4.10536 0.734784 4 1 4H5V2ZM7 4H13V2H7V4ZM4.074 6L4.931 18H15.07L15.927 6H4.074ZM8 8C8.26522 8 8.51957 8.10536 8.70711 8.29289C8.89464 8.48043 9 8.73478 9 9V15C9 15.2652 8.89464 15.5196 8.70711 15.7071C8.51957 15.8946 8.26522 16 8 16C7.73478 16 7.48043 15.8946 7.29289 15.7071C7.10536 15.5196 7 15.2652 7 15V9C7 8.73478 7.10536 8.48043 7.29289 8.29289C7.48043 8.10536 7.73478 8 8 8ZM12 8C12.2652 8 12.5196 8.10536 12.7071 8.29289C12.8946 8.48043 13 8.73478 13 9V15C13 15.2652 12.8946 15.5196 12.7071 15.7071C12.5196 15.8946 12.2652 16 12 16C11.7348 16 11.4804 15.8946 11.2929 15.7071C11.1054 15.5196 11 15.2652 11 15V9C11 8.73478 11.1054 8.48043 11.2929 8.29289C11.4804 8.10536 11.7348 8 12 8Z" fill="currentColor"/>
                </svg>
                <p>Xóa</p>
            </div>
        <?php 
        }
        ?>
    </div>    
</div>