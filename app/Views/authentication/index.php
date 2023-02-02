<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maitre</title>

    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('custom/css/app.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/icons/font/bootstrap-icons.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('animate/animate.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('sweetalert/sweetalert2.css');?>">

    <script src="<?php echo base_url('jquery/jquery.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap.js');?>"></script>
    <script src="<?php echo base_url('sweetalert/sweetalert2.js');?>"></script>

    <?php include('formValidation.php');?>
</head>
<body>
    <div id="main-modal"></div>
    <div style="position: fixed; width: 100%;">
        <nav class="navbar navbar-expand-lg bg-dark" style="position: top;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php 
                                if($locale == 'es')
                                {
                            ?>
                                    <img src="<?php echo base_url('custom/images/flags/spain.jpg');?>" alt="ES" class="img-fluid" width="25px">
                            <?php 
                                }
                                else
                                {
                            ?>
                                    <img src="<?php echo base_url('custom/images/flags/us.jpg');?>" alt="EN" class="img-fluid" width="25px">
                            <?php
                                }
                            ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item locale" href="#" lang="es"><img src="<?php echo base_url('custom/images/flags/spain.jpg');?>" alt="ES" class="img-fluid" width="25px"> <?php echo lang('AuthNav.es');?></a></li>
                            <li><a class="dropdown-item locale" href="#" lang="en"><img src="<?php echo base_url('custom/images/flags/us.jpg');?>" alt="EN" class="img-fluid" width="25px"> <?php echo lang('AuthNav.en');?></a></li>
                        </ul>
                    </li>
                </ul>
            </div> 
        </nav>
    </div>
    <div class="authentication-bg min-vh-100">
        <div class="container">
            <div class="d-flex flex-column min-vh-90 px-3 pt-4">
                <div class="d-flex flex-column min-vh-90 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div id="main-authentication" class="col-md-8 col-lg-6 col-xl-4">
                            <?php include('login/mainLogin.php');?>
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
        
        $('.locale').on('click', function (event) {
            
            event.preventDefault();
            window.location.href = "<?php echo base_url('Authentication').'?lang=';?>" + $(this).attr('lang');
        });
    });
</script>