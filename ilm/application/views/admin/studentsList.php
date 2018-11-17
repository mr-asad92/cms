<?php

//echo '<pre>';print_r($studentsList);exit();
?>
<link href='<?php echo base_url();?>assets/plugins/datatables/dataTables.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

<div class="panel panel-info">
    <div class="panel-heading ">
        <h4>Serach Student</h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <form action="<?php echo base_url(); ?>admin/searchStudent" class="" method="post"
                  novalidate="novalidate">
                <div class="mb5 clearfix">
                    <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                    <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                    <button type="button" style="margin-right: 5px;" class="btn btn-info pull-right" onclick="window.location.href= '<?php echo base_url()."admin/searchStudent";?>';"><span class="fa fa-refresh"></span>  Refresh</button>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        <label for="EnrollmentNo">Enrollment No</label>
                        <input class="form-control" id="EnrollmentNo" name="EnrollmentNo" value="" type="text">
                    </div>
                    <div class="col-sm-2">
                        <label for="RollNumber">Roll No</label>
                        <input class="form-control" data-val="true" data-val-number="The
                                                field Roll No must be a number." id="RollNumber" name="rollNo"
                               value="" type="text">
                    </div>
                    <div class="col-sm-2">
                        <label for="Name">Name</label>
                        <input class="form-control" id="Name" name="Name" value="" type="text">
                    </div>
                    <div class="col-sm-2">
                        <label for="GuardianName">Father Name</label>
                        <input class="form-control" id="GuardianName" name="guardianName"
                               value="" type="text">
                    </div>
                    <div class="col-sm-2">
                        <label for="GuardianMobile">Guardian Cell No</label>
                        <input class="form-control mob" id="GuardianMobile"
                               name="guardianMobile" value="" type="text">
                    </div>
                    <div class="col-sm-1">
                        <label for="Class">Class</label>
                        <!--classes
                        <select class="form-control" data-val="true" data-val-number="The field Class must be a number." id="ddlclass" name="Class">
                            <option value="">Select Class</option>
                            <option value="7">B</option>
                            <option value="6">FA</option>
                            <option value="5">ICS</option>
                            <option value="4">I-Com</option>
                            <option value="3">ADP(CS)</option>
                            <option value="2">ADP (Accounting )</option>
                            <option value="1">FSC (Medical)</option>
                        </select>-->
                        <?php echo form_dropdown('classId', $classes, set_value('classId', setVal('', 0, 'class_id', '')),'class="form-control"');?>


                    </div>
                    <div class="col-sm-1">
                        <label for="Class">Section</label>
                        <!--classes
                        <select class="form-control" data-val="true" data-val-number="The field Class must be a number." id="ddlclass" name="Class">
                            <option value="">Select Class</option>
                            <option value="7">B</option>
                            <option value="6">FA</option>
                            <option value="5">ICS</option>
                            <option value="4">I-Com</option>
                            <option value="3">ADP(CS)</option>
                            <option value="2">ADP (Accounting )</option>
                            <option value="1">FSC (Medical)</option>
                        </select>-->
                        <?php echo form_dropdown('sectionId', $sections, set_value('sectionId', setVal('', 0, 'sectionId', '')),'class="form-control"');?>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4>Student List</h4>

        <a href="<?php echo base_url() ;?>admin" style="margin-top:5px;" class="btn btn-primary
                                btn-sm
                                pull-right">Add
            Student</a>
        <a href="<?php echo base_url();?>admin/printAllStudentsList" style="margin-top:5px;margin-right: 5px;" class="btn btn-primary btn-sm pull-right">Print Students List</a>

        <div class="options">
        </div>
    </div>
    <div class="panel-body std-panel infinite-scroll">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped" id="studentsList">
                        <thead>

                        <tr>
                            <th>Enrollment No</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Guardian Cell No</th>
                            <th>Study Program</th>
<!--                            <th>Section</th>-->
                            <th>Roll No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($studentsList as $student) : ?>
                            <tr>
                                <td><?php echo $student['enrollment_no']; ?></td>
                                <td><?php echo $student['student_firstName'] . ' ' .
                                        $student['student_lastName']; ?></td>
                                <td><?php echo $student['father_name'] ; ?></td>
                                <td><?php echo $student['mobile_no']; ?></td>
                                <td><?php echo $student['study_program'].' ('.$student['class_name'].' - '.$student['section_name'].')'; ?></td>
<!--                                <td>--><?php //echo $student['class_name']; ?><!--</td>-->
<!--                                <td>--><?php //echo $student['section_name']; ?><!--</td>-->
                                <td><?php echo $student['roll_no']; ?></td>
                                <td>
                                    <?php
                                    if ($student['status'] == 0)
                                    {
                                        echo 'Old';
                                    }
                                    elseif ($student['status'] == 1)
                                    {
                                        echo '<p class="text-success">Active</p>';
                                    }
                                    elseif ($student['status'] == 2)
                                    {
                                        echo '<p class="text-danger">Suspend</p>';
                                    }
                                    elseif ($student['status'] == 3)
                                    {
                                        echo '<p class="text-warning">Leave</p>';
                                    }

                                    ?>
                                </td>
                                <td>

                                    <a href="<?php echo base_url();?>admin/studentDetails/<?php echo $student['enrollment_no']; ?>"
                                       data-toggle="tooltip" title="View Detail"><i
                                                class="fa fa-info" aria-hidden="true"></i></a> &nbsp; <b>|</b>&nbsp;
                                    <a href="<?php echo base_url();?>admin/editRegistration/<?php echo $student['enrollment_no']; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp; <b>|</b>&nbsp;
                                    <a href="<?php echo base_url();?>admin/makeInstallments/<?php echo $student['enrollment_no']; ?>" class="disabled" data-toggle="tooltip" title="Fee Installment"><i class="fa fa-money" aria-hidden="true"></i></a>
                                    &nbsp; <b>|</b>&nbsp;
                                    <a style="margin-top:2px" class="fa fa-print" data-ajax="true" data-ajax-method="GET" data-ajax-mode="replace" data-ajax-success="PrintElem('.printable')" data-ajax-update="#rldAdmission" data-toggle="tooltip" href="<?php echo base_url();?>admin/printStudentDetails/<?php echo $student['enrollment_no']; ?>" title="Print"> </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

