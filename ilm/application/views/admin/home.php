<div class="container">
    <form action="<?php echo $submitUrl;?>" class="form-horizontal" enctype="multipart/form-data" method="post">
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
                                        <input class="form-control" id="Student_EnrollmentNo" name="enrollmentNo" value="<?php echo set_value('enrollmentNo', setVal($enrollment_data, $enrollment_id, 'enroll_id', $editRegistration));?>" type="text" readonly>
                                    </div>
                                    <label class="col-sm-3 control-label" for="Student_EnrollmentDate">Enrollment Date</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <input class="form-control" data-val="true" data-val-date="The field Enrollment Date must be a date." data-val-required="This field is requried." id="Student_EnrollmentDate" name="enrollmentDate" type="text" value="<?php echo set_value('enrollmentDate', setVal($enrollment_data, date('Y-m-d'), 'enrollment_date', $editRegistration));?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.EnrollmentDate" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="ddlClass">Class</label>
                                    <div class="col-sm-3">
<!--                                        <select value="--><?php //echo set_value('classId');?><!--" class="form-control" data-val="true" data-val-number="The field Class must be a number." data-val-required="This field is requried." id="ddlClass" name="classId">-->
<!--                                            <option value="">Select Program</option>-->
<!--                                            --><?php //echo $classes;?>
<!--                                        </select>-->

                                        <?php echo form_dropdown('classId', $classes, set_value('classId', setVal($enrollment_data, 1, 'class_id', $editRegistration)),'class="form-control"');?>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.ClassId" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-3 control-label" for="ddlSection">Section</label>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown('sectionId', $sections, set_value('sectionId', setVal($enrollment_data, 1, 'section_id', $editRegistration)),'class="form-control"');?>

                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.SectionId" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="Student_Medium">Medium of Study</label>
                                    <div class="col-sm-3">
                                        <?php echo form_dropdown('studyMedium', $studyMedium, set_value('studyMedium', setVal($enrollment_data, 1, 'study_medium', $editRegistration)),'class="form-control"');?>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.Medium" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-3 control-label" for="Student_RollNo">Roll No</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" id="Student_RollNo" name="roll_no" value="<?php echo set_value('roll_no',setVal($enrollment_data, '', 'roll_no', $editRegistration));?>" type="text" onblur="validate(this, 'srln')">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.RollNo" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new col-sm-offset-2" data-provides="fileinput">

                                    <?php
                                        if($editRegistration){
                                            $src = ($enrollment_data['pic'] == '')?base_url().'assets/img/profile picture.png':base_url().'studentsPics/'.$enrollment_data['pic'];
                                        }
                                    ?>
                                    <div id="img-holder" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;margin-left:80px"><img src="<?php echo $src;?>" style="width: 200px; height: 160px;"></div>
                                    <div class="text-center" style="margin-left: 80px;">
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input name="img_url1" type="file"></span>

                                        <input name="studentsPics" type="file">

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
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="Student_FirstName" name="firstName" type="text" onblur="validate(this, 'fname')" value="<?php echo set_value('firstName',setVal($enrollment_data, '', 'fName', $editRegistration));?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.FirstName" data-valmsg-replace="true"></span>
                                    </div>

                                    <label class="col-sm-2 control-label" for="Student_LastName">Last Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="Student_LastName" name="lastName" type="text" onblur="validate(this, 'lname')" value="<?php echo set_value('lastName',setVal($enrollment_data, '', 'lName', $editRegistration));?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.LastName" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Student_Gender">Gender</label>
                                    <div class="col-sm-2">
                                        <?php echo form_dropdown('gender', $gender, set_value('gender', setVal($enrollment_data, 1, 'gender', $editRegistration)),'class="form-control"');?>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.Gender" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Student_DOB">D.O.B</label>
                                    <div class="col-sm-2">
                                        <div class="input-group date">
                                            <input class="form-control" data-val="true" data-val-date="The field D.O.B must be a date." data-val-required="This field is requried." id="Student_DOB" name="DOB" type="text" onblur="validate(this, 'dob')" value="<?php echo set_value('DOB',setVal($enrollment_data, '', 'dob', $editRegistration));?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Student.DOB" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="col-sm-2 control-label" for="Student_Religion">Religion</label>
                                    <div class="col-sm-2">
                                        <?php echo form_dropdown('religion', $religion, set_value('religion', setVal($enrollment_data, 1, 'religion', $editRegistration)),'class="form-control"');?>

                                        <span class="field-validation-valid Text-danger" data-valmsg-for="Student.Religion" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none;" id="advancedetail">
                                    <label class="col-sm-2 control-label" for="Student_BloodGroup">Blood Group</label>
                                    <div class="col-sm-2">

                                        <?php echo form_dropdown('bloodGroup', $bloodGroup, set_value('bloodGroup', setVal($enrollment_data, 1, 'blood_group', $editRegistration)),'class="form-control"');?>
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
                                <h4><img src="assets/img/address.png" style="height:30px; width:30px; float:left;
                                margin-right:5px;"> Present Address</h4>
                                <div class="panel-body" style="border-radius: 0px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="presentadress">Address</label>
                                                <div class="col-sm-10">

                                                    <textarea class="form-control" cols="20" data-val="true" data-val-required="This field is requried." id="presentadress" name="presentAddress" rows="2" onblur="validate(this, 'paddr')"> <?php echo set_value('presentAddress',setVal($presentAddresses, '', 'address', $editRegistration));?></textarea>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="presentcity">City</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="presentcity" name="presentCity" type="text" onblur="validate(this, 'pcity')"  value="<?php echo set_value('presentCity', setVal($presentAddresses, '', 'city', $editRegistration));?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[0].City" data-valmsg-replace="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label" for="presentdstrct">District</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="presentdstrct" name="presentDistrict" type="text" onblur="validate(this, 'pdistrict')" value="<?php echo set_value('presentDistrict', setVal($presentAddresses, '', 'district', $editRegistration));?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[0].District" data-valmsg-replace="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label" for="presentcntry">Country</label>
                                                <div class="col-sm-2">
                                                    <input value="Pakistan" class="form-control" data-val="true" data-val-required="This field is requried." id="presentcntry" name="presentCountry" type="text" onblur="validate(this, 'pcountry')" value="<?php echo set_value('presentCountry', setVal($presentAddresses, '', 'country', $editRegistration));?>">
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

                                                    <textarea class="form-control" cols="20" data-val="true" data-val-required="This field is requried." id="permanentadress" name="permenentAddress" rows="2"><?php echo set_value('permenentAddress', setVal($permenantAddresses, '', 'address', $editRegistration));?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="permanentcity">City</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="permanentcity" name="permenentCity" type="text" value="<?php echo set_value('permenentCity', setVal($permenantAddresses, '', 'city', $editRegistration));?>">
                                                    <span class="field-validation-valid text-danger" data-valmsg-for="address[1].City" data-valmsg-replace="true"></span>
                                                </div>
                                                <label class="control-label col-sm-2" for="permanentdstrct">District</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" data-val="true" data-val-required="This field is requried." id="permanentdstrct" name="permenentDistrict" type="text"  value="<?php echo set_value('permenentDistrict', setVal($permenantAddresses, '', 'district', $editRegistration));?>">
                                                </div>
                                                <label class="control-label col-sm-2" for="permanentcntry">Country</label>
                                                <div class="col-sm-2">
                                                    <input value="Pakistan" class="form-control" data-val="true" data-val-required="This field is requried." id="permanentcntry" name="permenentCountry" type="text"  value="<?php echo set_value('permenentCountry', setVal($permenantAddresses, '', 'country', $editRegistration));?>">
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
                                                                <input checked="True" id="father" name="guardian" type="radio" value="0" <?php echo set_value('guardian', (isset($enrollment_data['guardian']) && $enrollment_data['guardian'] == 0)?'checked':'');?> > <label for="father"></label> <span>Father</span>
                                                            </label>
                                                            <label class="col-sm-3 radiofive">
                                                                <input id="mother" name="guardian" type="radio" value="1" <?php echo set_value('guardian', (isset($enrollment_data['guardian']) && $enrollment_data['guardian'] == 1)?'checked':'');?>> <label for="mother"></label> <span>Mother</span>
                                                            </label>
                                                            <label class="col-sm-3 radiofive">
                                                               <input id="other" name="guardian" type="radio" value="2" <?php echo set_value('guardian', (isset($enrollment_data['guardian']) && $enrollment_data['guardian'] == 2)?'checked':'');?>> <label for="other"></label> <span>Other</span>
                                                            </label>
                                                        </span>


                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="fatherfirstname">First Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherfirstname" name="fatherFirstName" type="text" onblur="validate(this, 'gfname')" value="<?php echo set_value('fatherFirstName', setVal($enrollment_data, '', 'first_name', $editRegistration));?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Parent.FirstName" data-valmsg-replace="true"></span>
                                    </div>
                                    <label class="control-label col-sm-2" for="fatherlastname">Last Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherlastname" name="fatherLastName" type="text" onblur="validate(this, 'glname')" value="<?php echo set_value('fatherLastName',setVal($enrollment_data, '', 'last_name', $editRegistration));?>">
                                        <span class="field-validation-valid text-danger" data-valmsg-for="Parent.LastName" data-valmsg-replace="true"></span>
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="profession">Profession</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherProfession" name="fatherProfession" type="text" value="<?php echo set_value('fatherProfession', setVal($enrollment_data, '', 'profession', $editRegistration));?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="designation">Designation</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherDesignation" name="fatherDesignation" type="text" value="<?php echo set_value('fatherDesignation', setVal($enrollment_data, '', 'designation', $editRegistration));?>">
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="orgName">Organization Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherOrgName" name="fatherOrgName" type="text" value="<?php echo set_value('fatherOrgName', setVal($enrollment_data, '', 'organization_name', $editRegistration));?>">
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="address">Office Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherOfficeAddress" name="fatherOfficeAddress" type="text" value="<?php echo set_value('fatherOfficeAddress', setVal($enrollment_data, '', 'office_address', $editRegistration));?>">
                                    </div>
                                    <br><br>
                                    <label class="control-label col-sm-2" for="telephone">Telephone</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherTelephone" name="fatherTelephone" type="text" value="<?php echo set_value('fatherTelephone', setVal($enrollment_data, '', 'telephone', $editRegistration));?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="mobile">Mobile</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherMobile" name="fatherMobile" type="text" onblur="validate(this, 'gmobile')" value="<?php echo set_value('fatherMobile', setVal($enrollment_data, '', 'mobile_no', $editRegistration));?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="email">Email</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" data-val="true" data-val-required="This field is requried." id="fatherEmail" name="fatherEmail" type="text" value="<?php echo set_value('fatherEmail', setVal($enrollment_data, '', 'email', $editRegistration));?>">
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
                                                    <input class="form-control txtCal" data-val="true" data-val-number="The field AdmFee must be a number." data-val-required="The AdmFee field is required." id="AdmFee" name="admission_fee" value="<?php echo set_value('admission_fee', setVal($enrollment_data, '0', 'adm_fee', $editRegistration))?>" type="text" onblur="validate(this, 'admfee'); calculateFee()">
                                                    <span class="field-validation-valid" data-valmsg-for="Fee.AdmFee" data-valmsg-replace="true"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="FeePkg">FeePkg</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="feePkg" name="feePkg" type="text" value="<?php echo set_value('feePkg', setVal($enrollment_data, '0', 'fee_package', $editRegistration));?>" onblur="validate(this, 'feepkg'); calculateFee()">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="TuitionFee">TuitionFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="tuitionFee" name="tuitionFee" type="text" value="<?php echo set_value('tuitionFee', setVal($enrollment_data, '0', 'tuition_fee', $editRegistration));?>" onblur="validate(this, 'tuitionfee'); calculateFee()">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="BoradUniRegFee">BoradUniRegFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="boardUniRegFee" name="boardUniRegFee" type="text" value="<?php echo set_value('boardUniRegFee', setVal($enrollment_data, '0', 'boardUniReg_fee', $editRegistration));?>" onblur="validate(this, 'boarduniregfee'); calculateFee()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="LibraryFee">LibraryFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="libFee" name="libFee" type="text" value="<?php echo set_value('libFee', setVal($enrollment_data, '0', 'library_fee', $editRegistration));?>" onblur="validate(this, 'libfee'); calculateFee()">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="Miscellaneous">Miscellaneous</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="miscFee" name="miscFee" type="text" value="<?php echo set_value('miscFee', setVal($enrollment_data, '0', 'miscellaneous_fee', $editRegistration));?>" onblur="validate(this, 'miscfee'); calculateFee()">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-sm-4 text-right" for="Others">Others</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="otherFee" name="otherFee" type="text" value="<?php echo set_value('otherFee', setVal($enrollment_data, '0', 'others', $editRegistration));?>" onblur="validate(this, 'others'); calculateFee()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3 pull-right">
                                                <label class="col-sm-4 text-right" for="TotalFee">TotalFee</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="totalFee" name="totalFee" type="text" value="<?php echo set_value('totalFee', setVal($enrollment_data, '0', 'total_fee', $editRegistration));?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3 pull-right">
                                                <label class="col-sm-4 text-right" for="GrandTotal">GrandTotal</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" data-val="true" data-val-number="The field Fee Pkg must be a number." data-val-required="This field is requried." id="grandTotal" name="grandTotal" type="text" value="<?php echo set_value('grandTotal', setVal($enrollment_data, '0', 'grand_total', $editRegistration));?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-2 pull-right">
                                            <div class="col-md-6">
                                                <button class="btn-primary btn pull-right" type="submit" id="saveFormBtn"> Save </button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?php echo base_url().'admin';?>" class="btn-default btn pull-right"> Cancel </a>
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

                        <?php
                        if(count($previousInstitutes) > 0){
                            $c = 0;
                            foreach ($previousInstitutes as $pi){
                        ?>
                        <div class="addrow">
                            <div class="form-group rw clearfix">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-sm-3">

                                            <?php echo form_dropdown('PreviousInstitutesExamType[]', $PreviousInstitutesExamType, set_value('PreviousInstitutesExamType[]', setVal($previousInstitutes[$c], 1, 'exam_type', $editRegistration)),'class="form-control"');?>
                                            <input type="hidden" name="PI_rowId[]" value="<?php echo $previousInstitutes[$c]['id']?>">

                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" name="previousInstitueYear[]" placeholder="Year" type="text" value="<?php echo set_value('previousInstitueYear[]', setVal($previousInstitutes[$c], 1, 'exam_year', $editRegistration));?>">
                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" name="previousInstitueRollNo[]" placeholder="Roll No" type="text" value="<?php echo set_value('previousInstitueRollNo[]', setVal($previousInstitutes[$c], 1, 'p_roll_no', $editRegistration));?>">
                                        </div>

                                        <div class="col-sm-5">
                                            <input class="form-control" name="previousInstitueBoardUni[]" placeholder="Board/University" type="text" value="<?php echo set_value('previousInstitueBoardUni[]', setVal($previousInstitutes[$c], 1, 'board_university', $editRegistration));?>">
                                        </div>

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-sm-2">
                                            <input class="form-control" name="previousInstitueObtainedMarks[]" placeholder="Obt. Marks" type="text" value="<?php echo set_value('previousInstitueObtainedMarks[]', setVal($previousInstitutes[$c], 1, 'obt_marks', $editRegistration));?>">
                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" name="previousInstitueTotalMarks[]" placeholder="Total Marks" type="text" value="<?php echo set_value('previousInstitueTotalMarks[]', setVal($previousInstitutes[$c], 1, 'total_marks', $editRegistration));?>">
                                        </div>

                                        <div class="col-sm-1">
                                            <input class="form-control" name="previousInstitueGrade[]" placeholder="Grade" type="text" value="<?php echo set_value('previousInstitueGrade[]', setVal($previousInstitutes[$c], 1, 'grade', $editRegistration));?>">
                                        </div>

                                        <div class="col-sm-2">
                                            <input class="form-control" name="previousInstitueSubjects[]" placeholder="Subjects" type="text" value="<?php echo set_value('previousInstitueSubjects[]', setVal($previousInstitutes[$c], 1, 'subjects', $editRegistration));?>">
                                        </div>

                                        <div class="col-sm-5">
                                            <input class="form-control" name="previousInstitueName[]" placeholder="Institute Name" type="text" value="<?php echo set_value('previousInstitueName[]', setVal($previousInstitutes[$c], 1, 'institute_name', $editRegistration));?>">
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
                        <?php
                                $c++;
                            }
                        }
                        else{
                            ?>

                            <div class="addrow">
                                <div class="form-group rw clearfix">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="col-sm-3">

                                                <?php echo form_dropdown('PreviousInstitutesExamType[]', $PreviousInstitutesExamType, set_value('PreviousInstitutesExamType[]'),'class="form-control"');?>

                                            </div>

                                            <div class="col-sm-2">
                                                <input class="form-control" name="previousInstitueYear[]" placeholder="Year" type="text" value="<?php echo set_value('previousInstitueYear[]');?>">
                                            </div>

                                            <div class="col-sm-2">
                                                <input class="form-control" name="previousInstitueRollNo[]" placeholder="Roll No" type="text" value="<?php echo set_value('previousInstitueRollNo[]');?>">
                                            </div>

                                            <div class="col-sm-5">
                                                <input class="form-control" name="previousInstitueBoardUni[]" placeholder="Board/University" type="text" value="<?php echo set_value('previousInstitueBoardUni[]');?>">
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-sm-2">
                                                <input class="form-control" name="previousInstitueObtainedMarks[]" placeholder="Obt. Marks" type="text" value="<?php echo set_value('previousInstitueObtainedMarks[]');?>">
                                            </div>

                                            <div class="col-sm-2">
                                                <input class="form-control" name="previousInstitueTotalMarks[]" placeholder="Total Marks" type="text" value="<?php echo set_value('previousInstitueTotalMarks[]');?>">
                                            </div>

                                            <div class="col-sm-1">
                                                <input class="form-control" name="previousInstitueGrade[]" placeholder="Grade" type="text" value="<?php echo set_value('previousInstitueGrade[]');?>">
                                            </div>

                                            <div class="col-sm-2">
                                                <input class="form-control" name="previousInstitueSubjects[]" placeholder="Subjects" type="text" value="<?php echo set_value('previousInstitueSubjects[]');?>">
                                            </div>

                                            <div class="col-sm-5">
                                                <input class="form-control" name="previousInstitueName[]" placeholder="Institute Name" type="text" value="<?php echo set_value('previousInstitueName[]');?>">
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
                        <?php
                        }

                            ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>