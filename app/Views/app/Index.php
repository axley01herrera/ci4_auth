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
<body style="background-color: #f7f8fa;">
    <div id="main-modal"></div>
    <?php include('menu/navBar.php');?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="margin-top: 70px;">
                <div id="main-container">
                    <?php include('home/mainHome.php')?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>