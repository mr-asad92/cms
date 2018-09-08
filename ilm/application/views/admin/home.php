<div class="container">
    <form action="<?php echo base_url().'Admin/enrollment_save';?>" class="form-horizontal" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($this->session->flashdata('errors')) {
                    echo "<span class=\"glyphicon glyphicon-remove\"></span><span class='text-danger'>there are some errors, please see bottom of the page for details.</span>";
                }

                ?>
                <div class="panel panel-midnightblue">
                    <h4><img src="<?php echo base_url();?>assets/img/enrollment.png" style="height:30px;width:30px;float:left;margin-right:5px;">Enrollment</h4>
                    <div class="panel-body" style="border-radius: 0px;">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="Student_EnrollmentNo">Enrollment Number</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" id="Student_EnrollmentNo" name="enrollmentNo" value="<?php echo set_value('enrollmentNo', $enrollment_id);?>" type="text" readonly>
                                    </div>
                                    <label class="col-sm-3 control-label" for="Student_EnrollmentDate">Enrollment Date</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <input class="form-control" data-val="true" data-val-date="The field Enrollment Date must be a date." data-val-required="This field is requried." id="Student_EnrollmentDate" name="enrollmentDate" type="text" value="<?php echo set_value('enrollmentDate', date('Y-m-d'));?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.EnrollmentDate" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="ddlClass">Class</label>
                                    <div class="col-sm-3">
                                        <select value="<?php echo set_value('classId');?>" class="form-control" data-val="true" data-val-number="The field Class must be a number." data-val-required="This field is requried." id="ddlClass" name="classId">
                                            <option value="">Select Program</option>
                                            <?php echo $classes;?>
                                        </select>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.ClassId" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-3 control-label" for="ddlSection">Section</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" data-val="true" data-val-number="The field Section must be a number." data-val-required="Choose an Option" id="ddlSection" name="sectionId">
                                            <option value="">Select Section</option>
                                            <?php echo $sections;?>
                                        </select>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.SectionId" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="Student_Medium">Medium of Study</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" data-val="true" data-val-number="The field Medium of Study must be a number." data-val-required="This field is requried." id="Student_Medium" name="studyMedium">
                                            <option value="1">English</option>
                                            <option value="2">Urdu</option>
                                        </select>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.Medium" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-3 control-label" for="Student_RollNo">Roll No</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" id="Student_RollNo" name="roll_no" value="<?php echo set_value('roll_no');?>" type="text" >
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.RollNo" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new col-sm-offset-2" data-provides="fileinput">

                                    <div id="img-holder" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;margin-left:80px"><img src="<?php echo base_url();?>assets/img/profile picture.png" style="width: 200px; height: 160px;"></div>
                                    <div class="text-center" style="margin-left: 80px;">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input name="img_url" type="file"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-midnightblue">
                    <h4><img src="<?php echo base_url();?>assets/img/personal-information.png" style="height:30px;width:30px;float:left;margin-right:5px;"> Personal Detail</h4>
                    <div class="panel-body" style="border-radius: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Student_FirstName">First Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="Student_FirstName" name="firstName" type="text" value="<?php echo set_value('firstName');?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.FirstName" data-valmsg-replace="true"></span>
                                    </div>

                                    <label class="col-sm-2 control-label" for="Student_LastName">Last Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="Student_LastName" name="lastName" type="text" value="<?php echo set_value('lastName');?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.LastName" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Student_Gender">Gender</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" data-val="true" data-val-number="The field Gender must be a number." data-val-required="Choose an Option" id="Student_Gender" name="gender">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.Gender" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Student_DOB">D.O.B</label>
                                    <div class="col-sm-2">
                                        <div class="input-group date">
                                            <input class="form-control" data-val="true" data-val-date="The field D.O.B must be a date." data-val-required="This field is requried." id="Student_DOB" name="DOB" type="text" value="<?php echo set_value('DOB');?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.DOB" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Student_Religion">Religion</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" data-val="true" data-val-number="The field Religion must be a number." data-val-required="Choose an Option" id="Student_Religion" name="religion">
                                            <option value="1">Muslim</option>
                                            <option value="2">Non-Muslim</option>
                                        </select>
                                        <span class="field-validation-valid Text-danger" data-valmsg-for="Student.Religion" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none;" id="advancedetail">
                                    <label class="col-sm-2 control-label" for="Student_BloodGroup">Blood Group</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" data-val="true" data-val-number="The field Blood Group must be a number." id="Student_BloodGroup" name="bloodGroup">
                                            <option value="">Blood Group</option>
                                            <option value="1">A+</option>
                                            <option value="2">A-</option>
                                            <option value="3">B+</option>
                                            <option value="4">B-</option>
                                            <option value="5">AB+</option>
                                            <option value="6">AB-</option>
                                            <option value="7">O+</option>
                                            <option value="8">O-</option>
                                        </select>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.BloodGroup" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Student_Cast">Caste</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="Student_Cast" name="cast" type="text" value="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 pull-right">
                                        <a href="javascript:;" id="studentinfoadd" class="pull-right btn btn-primary">Add more Info</a>
                                        <a href="javascript:;" id="studentinfohide" class="pull-right" style="display:none">Hide more Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="pervinstitute" style="">
            <div class="col-md-12">
                <div class="panel panel-midnightblue">

                    <h4>Previous Institution Detail</h4>
                    <div class="panel-body" style="border-radius: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="PreviousInstitutes_0__InstituteName">InstituteName</label>
                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <div class="col-sm-4 pull-right">
                                                <a href="javascript:;" id="InstituteHistory" class="pull-right btn btn-primary" data-toggle="modal" data-target="#myModal">Add Previous Institute Name</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-midnightblue">

                    <h4 class="teacher" style="display:none">Employee Info</h4>
                    <div class="panel-body teacher" style="display:none">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Employee_s_Name">Employee's Name</label>
                                    <div class="col-sm-3">
                                        <input class="form-control txtname ui-autocomplete-input" id="Name" name="Name" value="" autocomplete="off" type="text">
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row stdpresentadress">
                        <div class="col-md-12">
                            <div class="panel panel-midnightblue">
                                <h4><img src="assets/img/address.png" style="height:30px; width:30px; float:left;margin-right:5px;"> Present Address</h4>
                                <div class="panel-body" style="border-radius: 0px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="presentadress">Address</label>
                                                <div class="col-sm-10">

                                                    <textarea class="form-control" cols="20" data-val="true" data-val-required="This field is requried." id="presentadress" name="presentAddress" rows="2"> <?php echo set_value('presentAddress');?></textarea>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="presentcity">City</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="presentcity" name="presentCity" type="text"  value="<?php echo set_value('presentCity');?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[0].City" data-valmsg-replace="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label" for="presentdstrct">District</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="presentdstrct" name="presentDistrict" type="text" value="<?php echo set_value('presentDistrict');?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[0].District" data-valmsg-replace="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label" for="presentcntry">Country</label>
                                                <div class="col-sm-2">
                                                    <input value="Pakistan" class="form-control" data-val="true" data-val-required="This field is requried." id="presentcntry" name="presentCountry" type="text" value="<?php echo set_value('presentCountry');?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[0].Country" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4 pull-right">
                                                    <a href="javascript:;" id="addpmadress" class="pull-right btn btn-primary">Add Permanent Address</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row stdpermanentadress" id="stdpermanentadress" style="display:none">
                        <div class="col-md-12">
                            <div class="panel panel-midnightblue">
                                <h4><img src="<?php echo base_url();?>assets/img/address.png" style="height:30px; width:30px; float:left;margin-right:5px;"> Permanent Address</h4>
                                <div class="panel-body" style="border-radius: 0px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="permanentadress">Address</label>
                                                <div class="col-sm-10">

                                                    <textarea class="form-control" cols="20" data-val="true" data-val-required="This field is requried." id="permanentadress" name="permenentAddress" rows="2"><?php echo set_value('permenentAddress');?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="permanentcity">City</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="permanentcity" name="permenentCity" type="text" value="<?php echo set_value('permenentCity');?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[1].City" data-valmsg-replace="true"></span>
                                                </div>
                                                <label class="control-label col-sm-2" for="permanentdstrct">District</label>
                                                <div class="col-sm-2">
                                                    <input value="Gujranwala" class="form-control" data-val="true" data-val-required="This field is requried." id="permanentdstrct" name="permenentDistrict" type="text"  value="<?php echo set_value('permenentDistrict');?>">
                                                </div>
                                                <label class="control-label col-sm-2" for="permanentcntry">Country</label>
                                                <div class="col-sm-2">
                                                    <input value="Pakistan" class="form-control" data-val="true" data-val-required="This field is requried." id="permanentcntry" name="permenentCountry" type="text"  value="<?php echo set_value('permenentCountry');?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[1].Country" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary" id="btnadress">Same as above</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="parent"><img src="<?php echo base_url();?>assets/img/family info.png" style="height:30px;width:30px;float:left;margin-right:5px;"> Family Information</h4>
                    <div class="panel-body parent" style="border-radius: 0px;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>
                                        <span class="col-md-2">Guardian Detail</span>
                                    </h4>
                                    <span class="col-md-6">
                                                            <label class="col-sm-3 radiofive">
                                                                <input checked="True" id="father" name="guardian" type="radio" value="0"> <label for="father"></label> <span>Father</span>
                                                            </label>
                                                            <label class="col-sm-3 radiofive">
                                                                <input id="mother" name="guardian" type="radio" value="1"> <label for="mother"></label> <span>Mother</span>
                                                            </label>
                                                            <label class="col-sm-3 radiofive">
                                                               <input id="other" name="guardian" type="radio" value="2"> <label for="other"></label> <span>Other</span>
                                                            </label>
                                                        </span>


                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="fatherfirstname">First Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherfirstname" name="fatherFirstName" type="text" value="<?php echo set_value('fatherFirstName');?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Parent.FirstName" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="control-label col-sm-2" for="fatherlastname">Last Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherlastname" name="fatherLastName" type="text" value="<?php echo set_value('fatherLastName');?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Parent.LastName" data-valmsg-replace="true"></span>
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="profession">Profession</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherProfession" name="fatherProfession" type="text" value="<?php echo set_value('fatherProfession');?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="designation">Designation</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherDesignation" name="fatherDesignation" type="text" value="<?php echo set_value('fatherDesignation');?>">
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="orgName">Organization Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherOrgName" name="fatherOrgName" type="text" value="<?php echo set_value('fatherOrgName');?>">
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="address">Office Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherOfficeAddress" name="fatherOfficeAddress" type="text" value="<?php echo set_value('fatherOfficeAddress');?>">
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="telephone">Telephone</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherTelephone" name="fatherTelephone" type="text" value="<?php echo set_value('fatherTelephone');?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="mobile">Mobile</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherMobile" name="fatherMobile" type="text" value="<?php echo set_value('fatherMobile');?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="email">Email</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherEmail" name="fatherEmail" type="text" value="<?php echo set_value('fatherEmail');?>">
                                    </div>
                                </div>


                            </div>

                            <div class="col-sm-3" id="guardianimg" style="display:none;">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px; margin-left:97px"><img src="assets/img/parent profile picture.png" style="width: 200px; height: 150px;"></div>
                                    <div class="text-center" style="margin-left: 95px;">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input name="GuardianImage" type="file"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-midnightblue">
                                <h4><img src="<?php echo base_url();?>assets/img/fee info.gif" style="height:30px;width:30px;float:left;margin-right:5px;"> Fee Info</h4>
                                <div class="panel-body" style="border-radius: 0px;">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="AdmFee">AdmFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control txtCal" data-val="true" data-val-number="The field AdmFee must be a number." data-val-required="The AdmFee field is required." id="AdmFee" name="admission_fee" value="" type="text">
                                                    <span class="field-validation-valid" data-valmsg-for="Fee.AdmFee" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="FeePkg">FeePkg</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="feePkg" name="feePkg" type="text" value="<?php echo set_value('feePkg');?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="TuitionFee">TuitionFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="tuitionFee" name="tuitionFee" type="text" value="<?php echo set_value('tuitionFee');?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="BoradUniRegFee">BoradUniRegFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="boardUniRegFee" name="boardUniRegFee" type="text" value="<?php echo set_value('boardUniRegFee');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="LibraryFee">LibraryFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="libFee" name="libFee" type="text" value="<?php echo set_value('libFee');?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="Miscellaneous">Miscellaneous</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="miscFee" name="miscFee" type="text" value="<?php echo set_value('miscFee');?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="Others">Others</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="otherFee" name="otherFee" type="text" value="<?php echo set_value('otherFee');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3 pull-right">
                                                <label class="col-sm-4 text-right" for="TotalFee">TotalFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="totalFee" name="totalFee" type="text" value="<?php echo set_value('totalFee');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3 pull-right">
                                                <label class="col-sm-4 text-right" for="GrandTotal">GrandTotal</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="grandTotal" name="grandTotal" type="text" value="<?php echo set_value('grandTotal');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-2 pull-right">
                                            <div class="col-md-6">
                                                <button class="btn-primary btn pull-right" type="submit"> Save </button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="/Admission/Registration" class="btn-default btn pull-right"> Cancel </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Previous Institutes Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="addrow">
                            <div class="form-group rw clearfix">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-sm-3">
                                            <select class="form-control exam" data-val="true" data-val-number="The field ExamType must be a number." data-val-required="The ExamType field is required." id="PreviousInstitutes_ExamType" name="PreviousInstitutesExamType[]">
                                                <option value="">Select</option>
                                                <option value="1">MatricOrEqualant</option>
                                                <option value="2">InterOrEqualant</option>
                                                <option value="3">GraduationOrEqualant</option>
                                                <option value="4">Others</option>
                                            </select>

                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" id="previousInstitue_Year" name="previousInstitueYear[]" placeholder="Year" type="text" value="<?php echo set_value('previousInstitueYear');?>">
                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" id="previousInstitue_RollNo" name="previousInstitueRollNo[]" placeholder="Roll No" type="text" value="<?php echo set_value('previousInstitueRollNo');?>">
                                        </div>

                                        <div class="col-sm-5">
                                            <input class="form-control" id="previousInstitue_BoardUni" name="previousInstitueBoardUni[]" placeholder="Board/University" type="text" value="<?php echo set_value('previousInstitueBoardUni');?>">
                                        </div>

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-sm-2">
                                            <input class="form-control" id="previousInstitue_ObtainedMarks" name="previousInstitueObtainedMarks[]" placeholder="Obt. Marks" type="text" value="<?php echo set_value('previousInstitueObtainedMarks');?>">
                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" id="previousInstitue_TotalMarks" name="previousInstitueTotalMarks[]" placeholder="Total Marks" type="text" value="<?php echo set_value('previousInstitueTotalMarks');?>">
                                        </div>

                                        <div class="col-sm-1">
                                            <input class="form-control" id="previousInstitue_Grade" name="previousInstitueGrade[]" placeholder="Grade" type="text" value="<?php echo set_value('previousInstitueGrade');?>">
                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" id="previousInstitue_subjects" name="previousInstitueSubjects[]" placeholder="Subjects" type="text" value="<?php echo set_value('previousInstitueSubjects');?>">
                                        </div>

                                        <div class="col-sm-5">
                                            <input class="form-control" id="previousInstitue_Name" name="previousInstitueName[]" placeholder="Institute Name" type="text" value="<?php echo set_value('previousInstitueName');?>">
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary btnadd"><span class="fa fa-plus"></span></button>
                                    <button type="button" class="btn btn-primary btnrmv"><span class="fa fa-minus"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>