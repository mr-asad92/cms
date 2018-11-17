
<div class="panel panel-info" id="printList">
    <div class="panel-body std-panel infinite-scroll">
        <div class="std-detail clearfix">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
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
                        </tr>
                        </thead>
                        <tbody id="printList">
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
        PrintElem('#printList');
    });
</script>

