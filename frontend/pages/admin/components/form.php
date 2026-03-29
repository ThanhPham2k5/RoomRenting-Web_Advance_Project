<?php
    $title = $title ?? "";
    $idModal = $idModal ?? "default-modal";
    $formData = $formData ?? "";
?>

<div class="modal-overlay" id="<?php echo $idModal; ?>">
    <div class="modal-content">
        <div class="modal-header">
            <p><?php echo $title; ?></p>
        </div>
        <form action="" method="POST" id="form-<?php echo $idModal; ?>">
            
            <div class="modal-body">
                <?php echo $formData; ?>   
            </div>

            <div class="modal-footer">
                <button class="submit" type="submit">Lưu</button>
                <button class="cancel" type="button" onclick="closeModal('<?php echo $idModal; ?>')">Hủy</button>                
            </div>
        </form>
    </div>
</div>