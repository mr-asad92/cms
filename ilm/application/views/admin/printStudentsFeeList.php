
<div class="panel panel-info" id="printList">
    <div class="panel-body std-panel infinite-scroll">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
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
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>

<script type="text/javascript">

    $(document).ready(function(){
        PrintElem('#printList', 'studentsFeeList');
    });
</script>

