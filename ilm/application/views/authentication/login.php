<div class="verticalcenter">
    <a href="<?php echo base_url();?>authentication/index"><img style="width: 400px; padding-bottom: 25px;" src="<?php echo base_url();?>assets/img/logo-big.png" alt="Logo" class="brand" /></a>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Log in to get started or <a href="<?php echo base_url();?>authentication/register">Sign Up</a></h4>
            <form action="<?php echo base_url();?>authentication/init_login" class="form-horizontal" style="margin-bottom: 0px !important;" method="post">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 20px" checked=""> Remember Me</label></div>
                </div>


        </div>
        <div class="panel-footer">
            <a href="<?php echo base_url();?>authentication/forgot_password" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>

            <div class="pull-right">
                <input type="reset" class="btn btn-default" value="Reset">
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </div>
        </form>
</div>
</div>