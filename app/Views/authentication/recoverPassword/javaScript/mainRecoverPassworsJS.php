<script>
    $(document).ready(function () {

        $('#button-sendInstructions').on('click', function () {

            let formValidateEmailFormat = validateEmailFormat();
            let formValidateRequiredFieldValues = requiredFieldValues();

            if(formValidateEmailFormat == 0 && formValidateRequiredFieldValues == 0) {

                $('#button-sendInstructions').attr('disabled', true);
                $('#spinner-button-sendInstructions').removeAttr('hidden');

                let post = {
                    email: $('#input-email').val(),
                    lang: "<?php echo $locale;?>"
                }

                $.ajax({

                    type: "post",
                    url: "<?php echo base_url('Authentication/recoverPassword');?>",
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

                    $('#button-sendInstructions').removeAttr('disabled');
                    $('#spinner-button-sendInstructions').attr('hidden', true);

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

                    $('#button-sendInstructions').removeAttr('disabled');
                    $('#spinner-button-sendInstructions').attr('hidden', true);
                });
            }
        });

        $('#button-backToLogin').on('click', function (event) {
    
            event.preventDefault();
            window.location.reload();
        });

        $('.focus').on('focus', function () {

            $(this).removeClass('is-invalid');
            $('#msg-' + $(this).attr('id')).html('');
        });
    });
</script>