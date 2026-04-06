<?php
    $title = $title ?? "";
    $idModal = $idModal ?? "default-modal";
    $formData = $formData ?? "";
    $save = $save ?? true;
?>

<div class="modal-overlay" id="<?php echo $idModal; ?>" onclick="event.stopPropagation(); closeModal('<?php echo $idModal; ?>')">
    <div class="modal-content" onclick="event.stopPropagation();">
        <div class="modal-header">
            <p><?php echo $title; ?></p>
        </div>
        <form onsubmit="handleSave(event, this)" action="" method="POST" id="form-<?php echo $idModal; ?>">
            
            <div class="modal-body">
                <?php echo $formData; ?>   
            </div>

            <?php if($save){ 
            ?>
                <div class="modal-footer">
                <button class="submit" type="submit">Lưu</button>
                <button class="cancel" type="button" onclick="event.stopPropagation(); closeModal('<?php echo $idModal; ?>')">Hủy</button>                
            </div>
            <?php } ?>
        </form>
    </div>
</div>