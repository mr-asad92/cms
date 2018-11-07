<form action="<?php echo base_url(); ?>users/update_profile" class="form-horizontal" enctype="multipart/form-data"
      method="post">
    <input name="__RequestVerificationToken" value="0_aw6v4_jd42XIkF2QstUktxwhMD71Wh0kpOp4PDKR6EQzphYF4H_3PpOad2tHFxxZK2LrmhAtg7wBkJSBVB60f6nRODN4qmI7ZPwJiCoJk1" type="hidden">        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-midnightblue">
                <h4><img src="<?php echo base_url(); ?>assets/img/enrollment.png" style="height:30px;width:30px;
                float:left;margin-right:5px;">Edit Profile</h4>
                <div class="panel-body" style="border-radius: 0px;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <?php echo form_hidden('id',$user->id); ?>
                                <label class="col-sm-3 control-label" for="first_name">First Name</label>
                                <div class="col-sm-3">

                                    <input value="<?php echo $user->first_name ;?>" class="form-control"
                                    name="first_name"
                                    type="text">

                                </div>

                                <label class="col-sm-3 control-label" for="last_name">Last Name</label>
                                <div class="col-sm-3">

                                    <input value="<?php echo $user->last_name ;?>" class="form-control" name="last_name" type="text">

                                </div>

                            </div>
                            <div class="form-group">

                                <label class="col-sm-3 control-label" for="email">Email</label>
                                <div class="col-sm-3">

                                    <input value="<?php echo $user->email ;?>" class="form-control" name="email",
                                           type="email" readonly>

                                </div>

                                <label class="col-sm-3 control-label" for="Student_RollNo">Gender</label>
                                <div class="col-sm-3">

                                    <?php
                                        $options = ['male' => 'Male', 'female' => 'Female'];
                                   echo form_dropdown('gender', $options, set_value('gender', $user->gender),'class="form-control"');?>


<!--                                    <input class="form-control" name="gender" value="--><?php //echo $user->gender ; ?><!--"-->
<!--                                           type="text">-->

                                </div>
                            </div>
                            <div class="form-group">

                                <label class="col-sm-3 control-label" for="qualification">Qualification</label>
                                <div class="col-sm-3">

                                    <input class="form-control" name="qualification" value="<?php echo $user->qualification ;?>" type="text">

                                </div>

                                <label class="col-sm-3 control-label" for="Student_EnrollmentDate">D.O.B</label>
                                <div class="col-sm-3">
                                    <div class="input-group date">
                                        <input value="<?php echo $user->dob ;?>" class="form-control" name="dob"
                                               type="date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="phone_no">Mobile No</label>
                                <div class="col-sm-3">

                                    <input value="<?php echo $user->phone_no ;?>" class="form-control"
                                           name="phone_no" type="tel">

                                </div>

                                <label class="col-sm-3 control-label" for="cnic">CNIC No</label>
                                <div class="col-sm-3">

                                    <input value="<?php echo $user->cnic ;?>" class="form-control" name="cnic"
                                           type="text">

                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="mobile_no">Address</label>
                                <div class="col-sm-9">

                                    <textarea name="address" id="" cols="63" rows="2"><?php echo $user->address ; ?></textarea>

                                </div>

                               

                            </div>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <?php echo form_submit(array('name' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Update')); ?>
                                </div>

                            </div>

                        </div>




                        <div class="col-md-4">

                            <div class="fileinput fileinput-new col-sm-offset-2" data-provides="fileinput">
                                <input type="hidden">
                                <?php if ($user->image_url != NULL) : ?>

                                <div id="img-holder" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;margin-left:80px"><img src="<?php echo base_url(). $user->image_url ; ?>" style="width: 200px; height: 150px;"></div>
                                <div class="text-center" style="margin-left: 80px;">

                                <?php else: ?>

                                    <div id="img-holder" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;margin-left:80px"><img src="<?php echo base_url(); ?>assets/img/profile picture.png" style="width: 200px; height: 150px;"></div>
                                    <div class="text-center" style="margin-left: 80px;">

                                <?php endif; ?>

                                    <!--<span class="btn btn-default btn-file"><span class="fileinput-new">Select
                                                image</span><span class="fileinput-exists">Change</span><input name="img_url" type="file"></span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                    data-dismiss="fileinput">Remove</a>-->
                                    <?php echo form_input(array('name' => 'image', 'type' => 'file', 'class'
                                         =>'')); ?>


                                        <!--<div class="btn btn-default btn-sm">
                                            <span>Text</span> <input type="file" hidden = "true">
                                        </div>-->
                                    <?php //echo form_button(array('name' => 'image',
                                    //'type' => 'file', 'class' =>'', 'value' => 'add')) ; ?>

                                </div>



                           <!-- <div id="img-holder" class="fileinput-preview thumbnail" data-trigger="fileinput"
                                 style="width: 200px; height: 150px; line-height: 150px;margin-left:80px"><img
                                        src="<?php echo base_url(); ?>assets/img/profile picture.png" style="width: 200px; height: 150px;"></div>

                            <?php// echo form_input(array('name' => 'image', 'type' => 'file')); ?>

                            </div>-->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>