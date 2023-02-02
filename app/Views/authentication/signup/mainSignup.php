<div class="text-center  py-5">
    <div class="mb-4">
        <h4 class="text-success"><strong><?php echo lang('Signup.signup'); ?></strong></h4>
        <p class="text-muted"><?php echo lang('Signup.fillForm'); ?></p>
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

    <!-- PASSWORD C -->
    <div class="form-floating form-floating-custom">
        <input type="password" id="input-passwordc" class="form-control required focus" placeholder="<?php echo lang('Form.confirmation');?>" />
        <label for="input-passwordc"><?php echo lang('Form.confirmation');?></label>
        <div class="form-floating-icon">
            <i class="bi bi-key-fill"></i>
        </div>
    </div>
    <p id="msg-input-passwordc" class="text-danger text-end"></p>

    <!-- CBX TERM -->
    <div class="row">
        <div class="col-12">
            <input id="cbx-term" type="checkbox" /> <?php echo lang('Signup.acceptTerm'); ?> <a id="link-term" href="#"><?php echo lang('Signup.term'); ?></a> <?php echo lang('Signup.and'); ?> <a id="link-privacyPolicy" href="#"><?php echo lang('Signup.privacyPolicy'); ?></a>
        </div>
    </div>
    <p id="msg-cbx-term" class="text-center text-danger"></p>

    <!-- BTN SIGNUP -->
    <div class="mt-3">
        <button id="button-signup" class="btn btn-success w-100" type="button">
            <span id="spinner-button-signup" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true" hidden></span>
            <?php echo lang('Button.signup'); ?>
        </button>
    </div>
    
    <!-- BACK BUTTON -->
    <div class="mt-4">
        <a id="button-backToLogin" style="text-decoration: none;" href="#" class="text-muted"><i class="bi bi-backspace"></i> <?php echo lang('Button.back'); ?></a>
    </div>
</div>
<?php include('javaScript/mainSignupJS.php'); ?>