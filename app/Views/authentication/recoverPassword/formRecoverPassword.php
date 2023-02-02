<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maitre - <?php echo $pageTitle;?></title>

    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('custom/css/app.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/icons/font/bootstrap-icons.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('animate/animate.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('sweetalert/sweetalert2.css');?>">

    <script src="<?php echo base_url('jquery/jquery.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap.js');?>"></script>
    <script src="<?php echo base_url('sweetalert/sweetalert2.js');?>"></script>

</head>
<body>
    <div class="authentication-bg min-vh-100">
        <div class="container">
            <div class="d-flex flex-column min-vh-90 px-3 pt-4">
                <div class="d-flex flex-column min-vh-90 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div id="main-authentication" class="col-md-8 col-lg-6 col-xl-4">
                            <div class="text-center  py-5">
                                <div class="mb-4">
                                    <h4 class="text-success"><strong><?php echo lang('Signup.signup'); ?></strong></h4>
                                    <p class="text-muted"><?php echo lang('Signup.fillForm'); ?></p>
                                </div>

                                <!-- EMAIL -->
                                <div class="form-floating form-floating-custom">
                                    <input type="text" id="input-email" class="form-control email required focus" placeholder="<?php echo lang('Form.email');?>" value="<?php echo $email;?>" readonly />
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

                                <!-- BTN SAVE -->
                                <div class="mt-3">
                                    <button id="button-save" class="btn btn-success w-100" type="button">
                                        <span id="spinner-button-save" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true" hidden></span>
                                        <?php echo lang('Button.save'); ?>
                                    </button>
                                </div>

                                <!-- BACK BUTTON -->
                                <div id="main-goToLogin" class="mt-4" hidden>
                                    <a style="text-decoration: none;" href="<?php echo base_url('Authentication/index').'?lang='.$locale;?>" class="text-muted"><?php echo lang('Button.goToLogin'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function () {
        
        $('#button-save').on('click', function () {

            let formValidateRequiredFieldValues = requiredFieldValues();

            if(formValidateRequiredFieldValues == 0) {

                let password = $('#input-password').val();
                let passwordc = $('#input-passwordc').val();

                if(password === passwordc) {

                    $('#button-save').attr('disabled', true);
                    $('#spinner-button-save').removeAttr('hidden');

                    let post = {
                        clientID: "<?php echo $clientID;?>",
                        password: password,
                        lang: "<?php echo $locale;?>"
                    }

                    $.ajax({

                        type: "post",
                        url: "<?php echo base_url('Authentication/newPassword');?>",
                        data: {post},
                        dataType: "json",
                        
                    }).done(function(jsonResponse) {

                        switch(jsonResponse.error) {

                            case 0:
                                Swal.fire({
                                    title: jsonResponse.msg,
                                    showClass: {popup: 'animate__animated animate__fadeInDown'},
                                    hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                                    icon: 'success',
                                    showConfirmButton: true,
                                    confirmButtonText: "<?php echo lang('Button.close')?>",
                                    confirmButtonColor: '#6c757d',
                                });

                                $('#main-goToLogin').removeAttr('hidden');
                            break

                            case 1:
                                Swal.fire({
                                    title: jsonResponse.msg,
                                    showClass: {popup: 'animate__animated animate__fadeInDown'},
                                    hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                                    position: 'top-end',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            break
                        }

                        $('#button-save').removeAttr('disabled');
                        $('#spinner-button-save').attr('hidden', true);

                    }).fail(function(error) {

                        Swal.fire({
                                title: "<?php echo lang('Error.title'); ?>",
                                showClass: {popup: 'animate__animated animate__fadeInDown'},
                                hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('#button-save').removeAttr('disabled');
                            $('#spinner-button-save').attr('hidden', true);
                    });

                } else {

                    $('#input-passwordc').addClass('is-invalid');
                    $('#msg-' + $('#input-passwordc').attr('id')).html("<?php echo lang('Form.notMatchP');?>");
                }
            }
        });

        function requiredFieldValues() {

            let inputValue = '', response = 0, msg = '';

            $('.required').each(function() {

                inputValue = $(this).val();
                msg = $(this).attr('id');

                if(inputValue === '') {

                    $(this).addClass('is-invalid');
                    $('#msg-' + msg).html("<?php echo lang('Form.requiredField');?>");
                    response = 1;
                } 
            });

            return response;
        }

        $('.focus').on('focus', function () {

            $(this).removeClass('is-invalid');
            $('#msg-' + $(this).attr('id')).html('');
        });
    });
</script>