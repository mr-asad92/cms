<div class="panel panel-primary">
    <div class="panel-heading">
        <h4>Student Information</h4>
    </div>
    <div class="panel-body">
        <div class="std-detail clearfix">
            <div class="row">
                <div class="col-sm-4">

<!--                    --><?php //debug($student_detail['status']);?>
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
                    <?php if($student_detail['std_status'] == 1):?>
                        <div class="well well-transparent well-sm">
                            <p class="alert alert-success">Active Student</p>
                        </div>

                    <?php elseif ($student_detail['std_status'] == 2):?>
                        <div class="panel">
                            <div class="panel-body">
                                <p class="alert alert-danger">Suspend Student</p>
                                <?php if (isset($suspendReason)): ?>
                                    <p><?php echo $suspendReason->reason ;?></p>
                                <?php endif; ?>
                                <?php echo anchor('admin/makeStudentActive/'.$student_detail['enrollment_id'],'Make Active',
                                    array(
                                        'class' => 'btn btn-primary pull-right',
                                    )); ?>
                            </div>
                        </div>
                    <?php elseif ($student_detail['std_status'] == 3):?>
                        <div class="panel">
                            <div class="panel-body">
                                <p class="alert alert-warning">Leave Student</p>
                                <?php if (isset($leaveReason)): ?>
                                    <p><?php echo $leaveReason->reason ;?></p>
                                <?php endif; ?>
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
                        <?php
                        $src = ($student_detail['pic'] == '')?base_url().'assets/img/profile picture.png':base_url().'studentsPics/'.$student_detail['pic'];

                        ?>
                        <img src="<?php echo $src;?>" class="img-thumbnail img-responsive pull-right" style="height: 200px; width: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>