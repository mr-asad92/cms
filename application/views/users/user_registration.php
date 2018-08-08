<section>
            
            <div class="panel panel-signup">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo base_url();?>/assets/images/codeigniter_logo.png" alt="CI Logo" height="40" width="130">
                    </div>
                    <br />
                    <h4 class="text-center mb5">Create a new account</h4>
                    <p class="text-center">Please enter your credentials below</p>
                    
                    <div class="mb30"></div>
                    
                    <?php
                        $attr=array(
                            'class'=>'form-horizontal'
                            );

                        echo form_open('home_cont/register',$attr);
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <?php
        
                                        $attr=array(
                                            'class'=>'form-control',
                                            'name'=>'username',
                                            'placeholder'=>'Enter Username',
                                            'value' => set_value('username')
                                            );

                                        echo form_input($attr);

                                    ?>
                                </div><!-- input-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <?php
                                        $attr=array(
                                                'class'=>'form-control',
                                                'name'=>'password',
                                                'placeholder'=>'Enter Password'
                                            );
                                        
                                        echo form_password($attr);

                                    ?>
                                </div><!-- input-group -->
                            </div>
                        </div><!-- row -->
                        <br />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <?php
        
                                        $attr=array(
                                            'class'=>'form-control',
                                            'name'=>'email',
                                            'placeholder'=>'Enter Email Address',
                                            'value'=>set_value('email')
                                            );

                                        echo form_input($attr);

                                    ?>
                                </div><!-- input-group -->
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <?php
            $gender=array(
                    
                    'male'=>'Male',
                    'female'=>'Female',
                    
                );
            $attr="class='form-control'";
            echo form_dropdown('gender',$gender,'male',$attr);
            

        ?>
                                </div><!-- input-group -->
                            </div>
                        </div><!-- row -->
                        <br />
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="ckbox ckbox-primary mt5">
                                    <?php
                    $attr=array(
                        
                        'name'=>'remember_me',
                        'id'=>'agree',
                        'value'=>'1'
                        );
                     echo form_checkbox($attr);?>
                                    <label for="agree">I agree with <a href="#">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <div class="pull-right">
                                <?php
                    $attr=array(
                        'class'=>'btn btn-success',
                        'name'=>'submit',
                        'value'=>'Create New Account'
                        );
                     echo form_submit($attr);?>
                            </div>
                        </div>
                    </form>
                    
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <a href="<?php echo base_url();?>home_cont/index" class="btn btn-primary btn-block">Already a Member? Sign In</a>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>