<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maitre - <?php echo lang('ActivatedAccount.pageTitle')?></title>

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
                        <div id="main-authentication" class="col-12 col-md-10 col-lg-10">
                            <h1><?php echo lang('ActivatedAccount.h1')?></h1>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4 text-center">
                                    <!-- BTN SIGNUP -->
                                    <div class="mt-3">
                                        <a href="<?php echo base_url('Authentication/index').'?lang='.$lang;?>" class="btn btn-success w-100" type="button"><?php echo lang('Button.goToLogin'); ?></a>
                                    </div>
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