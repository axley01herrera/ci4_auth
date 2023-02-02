<script>
    function validateEmailFormat() {

        let inputValue = '', response = 1, validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/, msg = '';

        $('.email').each(function() {

            inputValue = $(this).val();

            if(inputValue != '') {

                msg = $(this).attr('id');

                if(validEmail.test(inputValue)) {

                    $(this).removeClass('is-invalid');
                    $('#msg-' + msg).html('');
                    response = 0;
                    
                } else {

                    $(this).addClass('is-invalid');
                    $('#msg-' + msg).html("<?php echo lang('Form.invalidEmail');?>");
                }
            }
        });

        return response;
    }

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
</script>