<script>
    $(document).ready(function () {

        $('#button-login').on('click', function () { // LOGIN

            let formValidateEmailFormat = validateEmailFormat();
            let formValidateRequiredFieldValues = requiredFieldValues();

            if(formValidateEmailFormat == 0 && formValidateRequiredFieldValues == 0) {

                $('#button-login').attr('disabled', true);
                $('#spinner-button-login').removeAttr('hidden');

                let post = {
                    email: $('#input-email').val(),
                    password: $('#input-password').val(),
                    lang: "<?php echo $locale;?>"
                }

                $.ajax({

                    type: "post",
                    url: "<?php echo base_url('Authentication/login')?>",
                    data: {post},
                    dataType: "json",

                }).done(function(jsonResponse) {

                    switch(jsonResponse.error) {

                        case 0:
                            window.location.href = "<?php echo base_url('Dashboard');?>";
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

                            $('#button-login').removeAttr('disabled');
                            $('#spinner-button-login').attr('hidden', true);

                        break
                    }

                }).fail(function(error) {

                    Swal.fire({
                        title: "<?php echo lang('Error.title'); ?>",
                        showClass: {popup: 'animate__animated animate__fadeInDown'},
                        hideClass: {popup: 'animate__animated animate__fadeOutUp'},
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 3500
                    });

                    $('#button-login').removeAttr('disabled');
                    $('#spinner-button-login').attr('hidden', true);

                });
            }
        });
        
        $('#goToSignup').on('click', function (event) { // GO TO SIGNUP
            
            event.preventDefault();

            let post = {
                view: 'authentication/signup/mainSignup',
                lang: "<?php echo $locale; ?>"
            }

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/returnView');?>",
                data: {post},
                dataType: "html",
                
            }).done(function(htmlResponse) {

                $('#main-authentication').html(htmlResponse);

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
            });
        });

        $('#goToRecoverPassword').on('click', function (event) { // GO TO RECOVER PASSWORD
            
            event.preventDefault();

            let post = {
                view: 'authentication/recoverPassword/mainRecoverPassword',
                lang: "<?php echo $locale; ?>"
            }

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/returnView');?>",
                data: {post},
                dataType: "html",

            }).done(function(htmlResponse) {

                $('#main-authentication').html(htmlResponse);

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
            });
        });

        $('.focus').on('focus', function () {

            $(this).removeClass('is-invalid');
            $('#msg-' + $(this).attr('id')).html('');
        });
    });
</script>