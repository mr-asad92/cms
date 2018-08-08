<section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo base_url();?>/assets/images/codeigniter_logo.png" alt="CI Logo" height="40" width="130">
                    </div>
                    <br />
                    <h4 class="text-center mb5">Already a Member?</h4>
                    <p class="text-center">Sign in to your account</p>
                    
                    <div class="mb30"></div>
                    
                    <?php
    $attr=array(
        'class'=>'form-horizontal'
        );

    echo form_open('home_cont/login',$attr);
    ?>
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <?php
                    $attr=array(
                        'class'=>'form-control',
                        'name'=>'username',
                        'placeholder'=>'Username'
                        );
                     echo form_input($attr);?>
                        </div><!-- input-group -->
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?php
                    $attr=array(
                        'class'=>'form-control',
                        'name'=>'password',
                        'placeholder'=>'Password'
                        );
                     echo form_password($attr);?>
                        </div><!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="ckbox ckbox-primary mt10">
                                <?php
                    $attr=array(
                        
                        'name'=>'remember_me',
                        'id'=>'rememberMe',
                        'value'=>'1'
                        );
                     echo form_checkbox($attr);?>
                                    
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="pull-right">
                            <?php
                    $attr=array(
                        'class'=>'btn btn-success',
                        'name'=>'submit',
                        'value'=>'Login'
                        );
                     echo form_submit($attr);?>
                               
                            </div>
                        </div>                      
                    </form>
                    
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <a href="<?php echo base_url();?>home_cont/register_view" class="btn btn-primary btn-block">Not yet a Member? Create Account Now</a>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>

        <?php
            if ($this->session->flashdata('register_msg')) {
                echo $this->session->flashdata('register_msg');
            }
        ?>