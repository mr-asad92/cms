<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from avant.redteamux.com/extras-forgotpassword.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jan 2017 07:36:25 GMT -->
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="icon" href="<?php echo base_url();?>assets/img/favicon.jpeg" type="image/jpeg" sizes="16x16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ILM College GRW">
    <meta name="author" content="ILM College GRW">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.minc726.css?=140">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

</head>
<body class="focusedform">

<div class="verticalcenter">
    <a href="<?php echo base_url();?>authentication/index"><img style="width: 400px; padding-bottom: 25px;" src="<?php echo base_url();?>assets/img/logo-big.png" alt="Logo" class="brand" /></a>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Reset Password</h4>
            <form action="<?php echo base_url();?>authentication/updatePassword" method="post" id="change_password_form" class="form-horizontal" style="margin-bottom: 0px !important;">

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="opassword" id="password" placeholder="Old Password" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="npassword" placeholder="New Password" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            <div class="pull-left">
                <a href="<?php echo base_url().'admin';?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
            </div>

            <div class="pull-right">
                <a href="#" id="change_password_btn" class="btn btn-success">Update <i class="fa fa-arrow-right"></i></a>
            </div>

        </div>
    </div>
</div>

</body>

<!-- Mirrored from avant.redteamux.com/extras-forgotpassword.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jan 2017 07:36:25 GMT -->
</html>