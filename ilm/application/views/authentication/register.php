<div class="siginup verticalcenter">
    <a href="<?php echo base_url();?>authentication"><img src="<?php echo base_url();?>assets/img/logo-big.png" alt="Logo" class="brand" /></a>
    <div class="panel panel-primary">
        <div class="panel-body">
            <h4 class="text-center" style="margin-bottom: 25px;">Sign Up</h4>
            <form action="<?php echo base_url();?>authentication/init_register" method="post" class="form-horizontal" style="margin-bottom: 0px !important;">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="Email" required>
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Repeat password" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="">
                            <select class="form-control" name="role_id" required>
                                <option disabled selected>Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Clerk</option>
                                <option value="2">Accountant</option>

                            </select>
                        </div>
                    </div>
                </div>



        </div>
        <?php
        $label='Login';
        if($this->session->userdata('logged_in')){
            $label = 'Back';
        }
        ?>
        <div class="panel-footer">
            <div class="pull-left">
                <a href="<?php echo base_url();?>authentication" class="btn btn-default"><?php echo $label;?></a>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-success">Sign up</button>
            </div>
        </div>
        </form>

    </div>
</div>