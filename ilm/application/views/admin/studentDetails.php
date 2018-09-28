<div class="panel panel-primary">
    <div class="panel-heading">
        <h4>Student Information</h4>
    </div>
    <div class="panel-body">
        <div class="std-detail clearfix">
            <div class="row">
                <div class="col-sm-4">

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

                    </table>
                </div>

                <div class="col-sm-4 col-sm-offset-1">
                    <?php if($student_detail['status'] == 1):?>
                    <div class="well well-transparent well-sm">
                        <p class="alert alert-success">Active Student</p>
                    </div>

                    <?php elseif ($student_detail['status'] == 2):?>
                    <div class="panel">
                        <div class="panel-body">
                            <p class="alert alert-danger">Suspend Student</p>
                            <p><?php echo $suspendReason->reason ;?></p>
                            <?php echo anchor('admin/makeStudentActive/'.$student_detail['enrollment_id'],'Make Active',
                                array(
                                'class' => 'btn btn-primary pull-right',
                            )); ?>
                        </div>
                    </div>
                    <?php elseif ($student_detail['status'] == 3):?>
                    <div class="panel">
                        <div class="panel-body">
                            <p class="alert alert-warning">Leave Student</p>

                            <p><?php echo $leaveReason->reason ;?></p>
                            <?php echo anchor('admin/makeStudentActive/'.$student_detail['enrollment_id'],'Make Active',
                                array(
                                    'class' => 'btn btn-primary pull-right',
                                )); ?>

                        </div>
                    </div>
                    <?php endif;?>
                </div>

                <div class="col-sm-2 col-sm-offset-1">
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
                        <?php //echo '<pre>'; print_r($previousInstitutes); exit();?>
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

<?php if ($studentSuspendHistory): ?>

<div class="panel panel-primary">

    <div class="panel-heading">
        <h4>Student Suspend History</h4>
    </div>

    <div class="panel-body">
        <div class="col-sm-12">
            <div class="">
                <table class="table table-responsive table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Date</th>
                        <th>Reason</th>

                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                    <?php foreach ($studentSuspendHistory as $history) : ?>

                        <tr>

                            <td><?php echo  $i ?></td>
                            <td><?php echo  $history['created_at']; ?></td>
                            <td><?php echo  $history['reason']; ?> </td>

                        </tr>

                        <?php $i = $i + 1; ?>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if ($studentLeaveHistory): ?>

    <div class="panel panel-primary">

        <div class="panel-heading">
            <h4>Student Leave History</h4>
        </div>

        <div class="panel-body">
            <div class="col-sm-12">
                <div class="">
                    <table class="table table-responsive table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Date</th>
                            <th>Reason</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($studentLeaveHistory as $history) : ?>

                                <tr>

                                    <td><?php echo  $i ?></td>
                                    <td><?php echo  $history['created_at']; ?></td>
                                    <td><?php echo  $history['reason']; ?> </td>

                                </tr>

                                <?php $i = $i + 1; ?>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php
    //fee_pkg_history view is called
    echo $fee_pkg_history_view;

?>
<div class="row">
    <div class="col-md-4 col-md-offset-8 btn-group">


            <a href="<?php echo base_url(); ?>admin/editRegistration/<?php echo $student_detail['id']; ?>"><button class="btn btn-primary">Edit</button></a>


            <button class="btn btn-danger" data-toggle="modal" data-target="#suspendModal">Suspend</button>


            <button class="btn btn-warning" data-toggle="modal" data-target="#leaveModal">Leave</button>

            <a href="<?php echo base_url(); ?>admin/studentsList"><button class="btn btn-default">Cancel</button></a>



    </div>
</div>

    <div class="modal fade modal-lg" tabindex="-1" role="dialog" id="suspendModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Suspend Student</h4>
                    </div>
                    <form action="<?php echo base_url().'admin/makeStudentSuspend';?>" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                        <?php echo form_hidden('enrollment_id',$student_detail['enrollment_id']); ?>
                                        <?php echo form_textarea(array('name' => 'reason',
                                            'class' => 'form-control','placeholder' => 'Enter Reason Here')) ;?>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    <div class="modal fade modal-lg" tabindex="-1" role="dialog" id="leaveModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Leave Student</h4>
            </div>
            <form action="<?php echo base_url().'admin/makeStudentLeave';?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <?php echo form_hidden('enrollment_id',$student_detail['enrollment_id']); ?>
                            <?php echo form_textarea(array('name' => 'reason',
                                'class' => 'form-control','placeholder' => 'Enter Reason Here')) ;?>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#btnp').click(function () {
            alert('hello');
        });
    });
</script>
