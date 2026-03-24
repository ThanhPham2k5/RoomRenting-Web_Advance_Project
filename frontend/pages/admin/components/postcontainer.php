<?php 
    $posts = $posts ?? [];
?>

<div class="postcontainer-component">
    <div class="main-content">
        <?php if(empty($posts)){
                echo '<div style="grid-column: 1 / -1; width: 100%; text-align: center; padding: 50px 20px;">
                Không có bài đăng nào hoặc lỗi kết nối máy chủ
              </div>';
            }else{
                foreach ($posts as $post){
                    renderComponent("card",false,['cardData' => $post]);
                }
            }
        ?>
    </div>
</div>