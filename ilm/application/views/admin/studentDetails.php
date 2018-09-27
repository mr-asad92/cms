<div class="panel panel-primary">
    <div class="panel-heading">
        <h4>Student Information</h4>
    </div>
    <div class="panel-body">
        <div class="std-detail clearfix">
            <div class="row">
                <div class="col-sm-6">

                    <table class="table table-responsive table-condensed table-hover table-bordered">
                        <tr class="alert alert-info">
                            <td ><h5><b>Name</b></h5></span></td>
                            <td><h5><b><?php echo $student_detail['fName'] . ' ' .
                                            $student_detail['lName'];
                            ?></b></h5></td>
                        </tr>
                        <tr>
                            <td><h5>Enrollment No</h5></td>
                            <td><h5><?php echo $student_detail['enrollment_id'] ;?></h5></td>
                        </tr>
                        <tr>
                            <td><h5>Class</h5></td>
                            <td><h5><?php echo $student_detail['class_name'] ;?></h5></td>
                        </tr>
                        <tr>
                            <td><h5>Section</h5></td>
                            <td><h5><?php echo $student_detail['section_name'] ;?></h5></td>
                        </tr>
                        <tr>
                            <td><h5>Address</h5></td>
                            <td><h5><?= $presentAddresses['address']." , ".$presentAddresses['city']."  , "
                                    .$presentAddresses['district']."  , ".$presentAddresses['country'];?></h5></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-3 col-sm-offset-3">
                    <div class="">
                        <img src="<?php echo base_url(); ?>assets/img/profile picture.png" class="img-responsive img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4>Personal Detail</h4>
    </div>
    <div class="panel-body">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="">
                    <table class="table table-responsive table-hover  ">
                        <tbody><tr>
                            <th>Gender</th>
                            <td><?php echo $gender ;?></td>
                            <th>Current Address</th>
                            <td><?= $presentAddresses['address']." , ".$presentAddresses['city']."  , "
                                .$presentAddresses['district']."  , ".$presentAddresses['country'];?></td>
                        </tr>
                        <tr>
                            <td><strong>D.O.B</strong></td>
                            <td><?php echo $student_detail['dob'] ;?></td>
                            <td><b>Permanent Address</b></td>
                            <td><?= $permenantAddresses['address']." , ".$permenantAddresses['city']."  , "
                                .$permenantAddresses['district']."  , ".$permenantAddresses['country'];?></td>
                        </tr>
                        </tr>

                        <tr>
                            <th>Blood</th>
                            <td>
                                <?php
                                    //$blood_group = $student_detail['blood_group'];
                                ?>
                                <?php //echo $blood_group ;?>
                                <?php echo $blood_group[$student_detail['blood_group']]; ?>
                            </td>
                            <th>Caste</th>
                            <td colspan="3"><?php echo $student_detail['caste'] ;?></td>

                        </tr>

                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4>Guardian Information</h4>
    </div>
    <div class="panel-body">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="">
                    <table class="table table-responsive table-hover  ">
                        <tbody><tr>
                            <td colspan="4">
                                <div class="form-group">
                                    <h4>
                                        <span class="col-md-2">Guardian Detail</span>
                                    </h4>
                                    <span class="col-md-6">
                                        <?php $guardian_Id = $student_detail['guardian'] ;?>
                                        <label class="col-sm-3 radiofive">
                                            <input <?php echo $guardian_Id == 0 ? 'checked="True"' : 'disabled';?>
                                                    id="father" name="Parent.Type" type="radio"> <label
                                                    for="father"></label> <span>Father</span>
                                        </label>
                                        <label class="col-sm-3 radiofive">
                                            <input <?php echo $guardian_Id == 1 ? 'checked="True"' : 'disabled';?>
                                                    id="mother" name="Parent.Type" type="radio"> <label for="mother"></label> <span>Mother</span>
                                        </label>
                                        <label class="col-sm-3 radiofive">
                                            <input <?php echo $guardian_Id == 2 ? 'checked="True"' : 'disabled';?>
                                                    id="other" name="Parent.Type"
                                                    type="radio"> <label for="other"></label> <span>Other</span>
                                        </label>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Guardian Name</th>
                            <td><?php echo $student_detail['first_name'].' '. $student_detail['last_name'] ;?></td>

                            <th>Profession</th>
                            <td>
                                <?php echo $student_detail['profession'] ;?>
                            </td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td><?php echo $student_detail['designation'] ;?></td>
                        </tr>
                        <tr>
                            <th>Organization Name</th>
                            <td><?php echo $student_detail['organization_name'] ;?></td>
                            <th>Office Address</th>
                            <td><?php echo $student_detail['office_address'] ;?></td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td><?php echo $student_detail['mobile_no'] ;?></td>
                            <th>Telephone</th>
                            <td><?php echo $student_detail['telephone'] ;?></td>
                        </tr>



                        <tr>
                            <th>Email</th>
                            <td colspan="3"><?php echo $student_detail['email'] ;?></td>
                        </tr>
                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4>Previous Institute Detail</h4>



        <div class="options">

        </div>
    </div>
    <div class="panel-body std-panel infinite-scroll">

        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="">
                    <table class="table table-responsive table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Examination</th>
                            <th>Year</th>
                            <th>Roll no</th>
                            <th>Board/University</th>
                            <th>Obtained Marks</th>
                            <th>Total Marks</th>
                            <th>Grade</th>
                            <th>Subjects</th>
                            <th>Institute Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($previousInstitutes as $institute) : ?>
                        <tr>

                            <td><?php echo  $institute['exam_type']; ?></td>
                            <td><?php echo  $institute['exam_year']; ?></td>
                            <td><?php echo  $institute['p_roll_no']; ?> </td>
                            <td><?php echo  $institute['board_university']; ?></td>
                            <td><?php echo  $institute['obt_marks']; ?></td>
                            <td><?php echo  $institute['total_marks']; ?></td>
                            <td><?php echo  $institute['grade']; ?></td>
                            <td><?php echo  $institute['subjects']; ?></td>
                            <td><?php echo  $institute['institute_name']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
    //fee_pkg_history view is called
    echo $fee_pkg_history_view;

?>
<div class="row">
    <div class="col-md-4 col-md-offset-8 btn-group">


            <a href="<?php echo base_url(); ?>admin/editRegistration/<?php echo $student_detail['id']; ?>"><button class="btn btn-primary">Edit</button></a>


            <a href="<?php echo base_url(); ?>"><button class="btn btn-danger">Delete</button></a>



            <a href="<?php echo base_url(); ?>"><button class="btn btn-warning">Suspend</button></a>



            <a href="<?php echo base_url(); ?>"><button class="btn btn-brown">Leave</button></a>



            <a href="<?php echo base_url(); ?>admin/studentsList"><button class="btn btn-default">Cancel</button></a>


    </div>
</div>
