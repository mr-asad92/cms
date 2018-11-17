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
            <form action="<?php echo base_url(); ?>admin/searchStudentsFeeList" class="" method="post"
                  novalidate="novalidate">
                <div class="mb5 clearfix">
                    <h4 class="pull-left"><strong>Enter any of the following field data to search</strong></h4>
                    <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-search"></span>  Search</button>
                    <button type="button" style="margin-right: 5px;" class="btn btn-info pull-right" onclick="window.location.href= '<?php echo base_url()."admin/studentsFeeList";?>';"><span class="fa fa-refresh"></span>  Refresh</button>
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
                    <div class="col-sm-2">
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

        <a href="<?php echo base_url();?>admin/printStudentsFeeList" style="margin-top:5px;margin-right: 5px;" class="btn btn-primary btn-sm pull-right">Print Students List</a>
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
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Class</th>
                            <th>Total Fee</th>
                            <th>Paid</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody id="printList">
                        <?php foreach ($studentsList as $student) :
                            $class_name = $this->admin_model->getClassNameWithProgramTitle($student['class_id']);
                            $paid_fee = $this->admin_model->getStudentFee($student['enrollment_no'], 1);
                            ?>
                            <tr>
                                <td><?php echo $student['enrollment_no']; ?></td>
                                <td><?php echo $student['roll_no']; ?></td>
                                <td><a href="<?php echo base_url().'admin/studentDetails/'.$student['enrollment_no'];?>"><?php echo $student['student_firstName'] . ' ' .$student['student_lastName']; ?></a></td>
                                <td><?php echo $student['father_name']; ?></td>
                                <td><?php echo $class_name; ?></td>
                                <td><?php echo $student['grand_total']; ?></td>
                                <td><?php echo $paid_fee; ?></td>
                                <td><?php echo $student['grand_total'] - $paid_fee; ?></td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php
                        if ($fee_totals != false){
                    ?>
                    <table class="table table-stripped table-condensed table-hover table-bordered" style="width: 250px;">
                        <tr>
                            <th colspan="2" class="text-center bg-primary">Details</th>
                        </tr>
                        <tr>
                            <th class="active">Total Fee</th>
                            <td><?php echo number_format($fee_totals['grandTotal']);?></td>
                        </tr>
                        <tr>
                            <th class="active">Paid Fee</th>
                            <td><?php echo number_format($fee_totals['paid_fee']);?></td>
                        </tr>

                        <tr>
                            <th class="active">Balance</th>
                            <td><?php echo number_format($fee_totals['grandTotal'] - $fee_totals['paid_fee']);?></td>
                        </tr>
                    </table>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

