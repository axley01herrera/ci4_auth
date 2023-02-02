<div class="text-center  py-5">

    <div class="mb-4">
        <h4 class="text-success"><strong><?php echo lang('RecoverPassword.recoverPassword'); ?></strong></h4>
        <p class="text-muted"><?php echo lang('RecoverPassword.msg'); ?></p>
    </div>

    <!-- EMAIL -->
    <div class="form-floating form-floating-custom">
        <input type="text" id="input-email" class="form-control email required focus" placeholder="<?php echo lang('Form.email');?>" />
        <label for="input-email"><?php echo lang('Form.email');?></label>
        <div class="form-floating-icon">
            <i class="bi bi-envelope"></i>
        </div>
    </div>
    <p id="msg-input-email" class="text-danger text-end"></p>

    <!-- BTN SIGNUP -->
    <div class="mt-3">
        <button id="button-sendInstructions" class="btn btn-success w-100" type="button">
            <span id="spinner-button-sendInstructions" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true" hidden></span>
            <?php echo lang('Button.sendInstructions'); ?>
        </button>
    </div>

    <!-- BACK BUTTON -->
    <div class="mt-4">
        <a id="button-backToLogin" style="text-decoration: none;" href="#" class="text-muted"><i class="bi bi-backspace"></i> <?php echo lang('Button.back'); ?></a>
    </div>
    
</div>
<?php include('javaScript/mainRecoverPassworsJS.php');?>