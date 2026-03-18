<?php
    $title = $title ?? "";
    $idModal = $idModal ?? "default-modal";
?>

<div class="modal-overlay" id="<?php echo $idModal; ?>">
    <div class="modal-content">
        <div class="modal-header">
            <p><?php echo $title; ?></p>
        </div>
        <form action="" method="POST">
            
            <div class="modal-body">
                <input type="hidden" name="action" value="add_room">
    
                <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Trạng thái</label>
                    <select name="status">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                    </select>
                </div>    
                <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Trạng thái</label>
                    <select name="status">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                    </select>
                </div>   <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Tên phòng</label>
                    <input type="text" name="name" placeholder="Nhập tên phòng...">
                </div>
                <div class="input-group">
                    <label>Trạng thái</label>
                    <select name="status">
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="">-- Chọn trạng thái --</option>
                    </select>
                </div>   
            </div>

            <div class="modal-footer">
                <button class="submit" type="submit">Lưu</button>
                <button class="cancel" type="button" onclick="closeModal('<?php echo $currentPage; ?>')">Hủy</button>                
            </div>
        </form>
    </div>
</div>