<script>

    $(document).ready(function () {

        $('#button-signup').on('click', function () {

            let formValidateEmailFormat = validateEmailFormat();
            let formValidateRequiredFieldValues = requiredFieldValues();

            if(formValidateEmailFormat == 0 && formValidateRequiredFieldValues == 0) {

                let password = $('#input-password').val();
                let passwordc = $('#input-passwordc').val();

                if(password === passwordc) {

                    if($('#cbx-term').prop('checked') ) {

                        $('#button-signup').attr('disabled', true);
                        $('#spinner-button-signup').removeAttr('hidden');

                        let post = {
                            email: $('#input-email').val(),
                            password: password,
                            lang: "<?php echo $locale;?>"
                        }

                        $.ajax({

                            type: "post",
                            url: "<?php echo base_url('Authentication/signup');?>",
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

                            $('#button-signup').removeAttr('disabled');
                            $('#spinner-button-signup').attr('hidden', true);

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

                            $('#button-signup').removeAttr('disabled');
                            $('#spinner-button-signup').attr('hidden', true);
                        });
                    } else 
                        $('#msg-cbx-term').html("<?php echo lang('Form.notTerm');?>");
                } else {
                    $('#input-passwordc').addClass('is-invalid');
                    $('#msg-' + $('#input-passwordc').attr('id')).html("<?php echo lang('Form.notMatchP');?>");
                }
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

        $('#cbx-term').on('click', function () {

            if($('#cbx-term').prop('checked')) 

                $('#msg-cbx-term').html("");
            else 
                $('#msg-cbx-term').html("<?php echo lang('Form.notTerm');?>");
        });

        $('#link-term').on('click', function (event) {

            event.preventDefault();

            let post = {
                lang: "<?php echo $locale;?>"
            }

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/modalTerm');?>",
                data: {post},
                dataType: "html",
                
            }).done(function(htmlResponse) {

                $('#main-modal').html(htmlResponse);

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

        $('#link-privacyPolicy').on('click', function (event) {
            
            event.preventDefault();

            let post = {
                lang: "<?php echo $locale;?>"
            }

            $.ajax({

                type: "post",
                url: "<?php echo base_url('Authentication/modalPrivacyPolicy');?>",
                data: {post},
                dataType: "html",
                
            }).done(function(htmlResponse) {

                $('#main-modal').html(htmlResponse);

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
    });
</script>