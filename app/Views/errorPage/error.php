<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maitre - Error</title>

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
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-12 mt-5">
                <section id="wrapper" class="error-page">
                    <div class="error-box">
                        <div class="error-body text-center">
                            <h3 class="text-uppercase"><?php echo $error;?></h3>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>