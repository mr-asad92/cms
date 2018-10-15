<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Fee Change History</div>
    <div class="panel-body">
        <table class="table table-responsive table-condensed table-bordered table-stripped">

            <thead>
            <tr>
                <th>Sr. </th>
                <th>Student Name</th>
                <th>Admission Fee</th>
                <th>Fee Package</th>
                <th>Tuition Fee</th>
                <th>Board/Uni Reg Fee</th>
                <th>Library Fee</th>
                <th>Miscellaneous</th>
                <th>Others</th>
                <th>Total</th>
                <th>Grand Total</th>
                <th>Edited By</th>
                <th>Edited At</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sr = 1;
                foreach ($fee_history as $item => $value){
                    ?>
                    <tr>
                        <td><?php echo  $sr; ?></td>
                        <td><?php echo  "<a href='".base_url()."admin/studentDetails/".$value->enrollment_id."'>".ucfirst($value->std_first_name). " ". ucfirst($value->std_last_name); ?></td>
                        <td><?php echo  $value->adm_fee; ?> </td>
                        <td><?php echo  $value->fee_package; ?> </td>
                        <td><?php echo  $value->tuition_fee; ?> </td>
                        <td><?php echo  $value->boardUniReg_fee; ?></td>
                        <td><?php echo  $value->library_fee; ?></td>
                        <td><?php echo  $value->miscellaneous_fee; ?></td>
                        <td><?php echo  $value->others; ?></td>
                        <td><b><?php echo  $value->total_fee; ?></b></td>
                        <td><b><?php echo  $value->grand_total; ?></b></td>
                        <td><b><?php echo "<a href='".base_url()."users/userDetails/".$value->modified_by."'>".ucfirst($value->editor_first_name). " ". ucfirst($value->editor_last_name)."</a>"; ?></b></td>
                        <td><b><?php echo  date("d M, Y - h:i A", strtotime($value->modification_date)); ?></b></td>
                    </tr>
            <?php
                    $sr++;
                }
            ?>



            </tbody>
        </table>

    </div>

</div>
