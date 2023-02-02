<div class="text-center py-5">

    <div class="mb-4">
        <h4 class="text-success"><strong><?php echo lang('Login.welcome');?></strong></h4>
        <p class="text-muted"><?php echo lang('Login.msgLogin');?></p>
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

    <!-- PASSWORD -->
    <div class="form-floating form-floating-custom">
        <input type="password" id="input-password" class="form-control required focus" placeholder="<?php echo lang('Form.password'); ?>" />
        <label for="input-password"><?php echo lang('Form.password');?></label>
        <div class="form-floating-icon">
            <i class="bi bi-key-fill"></i>
        </div>
    </div>
    <p id="msg-input-password" class="text-danger text-end"></p>
    
    <!-- BTN LOG IN -->
    <div class="mt-3">
        <button id="button-login" class="btn btn-success w-100" type="button">
            <span id="spinner-button-login" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true" hidden></span>
            <?php echo lang('Button.login'); ?>
        </button>
    </div>

    <div class="mt-4">
        <a id="goToRecoverPassword" href="#" class="text-muted"><?php echo lang('Button.recoverPassword');?></a>
    </div>
    <div class="mt-5 text-center text-muted">
        <p><?php echo lang('Login.msgSignUp');?> <a id="goToSignup" style="text-decoration: none;" href="#" class="fw-medium text-success"> <?php echo lang('Login.signup');?> </a></p>
    </div>
</div>
<?php include('javaScript/mainLoginJS.php');?>
