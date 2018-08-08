<div class="siginup-verticalcenter">
    <a href="<?php echo base_url();?>authentication"><img src="<?php echo base_url();?>assets/img/logo-big.png" alt="Logo" class="brand" /></a>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Sign Up</h4>
            <form action="<?php echo base_url();?>authentication/init_register" method="post" class="form-horizontal" style="margin-bottom: 0px !important;">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Repeat password">
                        </div>
                    </div>
                </div>



        </div>
        <div class="panel-footer">
            <div class="pull-left">
                <a href="<?php echo base_url();?>authentication" class="btn btn-default">Login</a>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-success">Sign up</button>
            </div>
        </div>
        </form>

    </div>
</div>