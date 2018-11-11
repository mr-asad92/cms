<?php
    //student_info view is called
    if (isset($student_info))
    {
        echo $student_info;
    }


?>
<div>
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Fee Package</div>
        <div class="panel-body">
            <table class="table">

                <thead>
                <tr>
                    <th>Admission Fee</th>
                    <th>Fee Package</th>
                    <th>Tuition Fee</th>
                    <th>Board/University Fee</th>
                    <th>Library Fee</th>
                    <th>Miscellaneous</th>
                    <th>Others</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Grand Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo  $fee_package->adm_fee; ?></td>
                    <td><?php echo  $fee_package->fee_package; ?></td>
                    <td><?php echo  $fee_package->tuition_fee; ?> </td>
                    <td><?php echo  $fee_package->boardUniReg_fee; ?></td>
                    <td><?php echo  $fee_package->library_fee; ?></td>
                    <td><?php echo  $fee_package->miscellaneous_fee; ?></td>
                    <td><?php echo  $fee_package->others; ?></td>
                    <td><b><?php echo  $fee_package->total_fee; ?></b></td>
                    <td><b><?php echo  $fee_package->discount; ?></b></td>
                    <td><b><?php echo  $fee_package->grand_total; ?></b></td>
                </tr>


                </tbody>
            </table>
            <p><span class="pull-right alert alert-info" ><b>Total Fee Package :  Rs. <?php echo
                        $fee_package->grand_total ;
                        ?></b></span></p>
        </div>

    </div>

    <div class="panel panel-info">
        <!-- Default panel contents -->
        <div class="panel-heading">Total Paid Fee</div>
        <div class="panel-body">
            <table class="table table-striped table-hover">

                <thead>
                <tr>
                    <th>Sr No </th>
                    <th>Enrollment No</th>
                    <th>Installment No</th>
                    <th>Fee Amount</th>
                    <th>Due Date</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $paidFee = 0.0;
                $i = 1;
                ?>
                <?php foreach ($paid_fee as $fee): ?>
                    <tr>
                        <td><?php echo  $i; ?></td>
                        <td><?php echo  $fee->enrollment_id; ?></td>
                        <td><?php echo  $fee->installment_no; ?></td>
                        <td><?php echo  $fee->fee_amount; ?> </td>
                        <td><?php echo  $fee->installment_date; ?></td>
                        <td><?php echo  $fee->pay_date; ?></td>
                        <td><?php echo  'Paid'; ?>
                        </td>
                        <?php
                        $paidFee = $paidFee + $fee->fee_amount;
                        $i++;
                        ?>
                    </tr>
                <?php
                endforeach;

                if(count($paid_fee) <= 0){
                    $paidFee = 0;
                }

                ?>

                </tbody>
            </table>
            <p><span class="pull-right alert alert-success" ><b>Total Paid Amount  :  Rs. <?php echo $paidFee ;
                        ?></b></span></p>
        </div>

        <!-- Table -->

    </div>

    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">Total Un-Paid Fee</div>
        <div class="panel-body">
            <table class="table table-striped table-hover">

                <thead>
                <tr>
                    <th>Sr No </th>
                    <th>Enrollment No</th>
                    <th>Installment No</th>
                    <th>Fee Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $sum = 0.0;
                $i = 1;
                ?>
                <?php foreach ($unpaid_fee as $fee): ?>
                    <tr>
                        <td><?php echo  $i; ?></td>
                        <td><?php echo  $fee->enrollment_id; ?></td>
                        <td><?php echo  $fee->installment_no; ?></td>
                        <td><?php echo  $fee->fee_amount; ?> </td>
                        <td><?php echo  $fee->installment_date; ?></td>
                        <td><?php echo  'unPaid'; ?></td>

                    </tr>
                    <?php $sum = $sum + $fee->fee_amount;
                    $i++;
                    ?>
                <?php
                endforeach;

                if(count($unpaid_fee) <= 0){
                    $sum = $fee_package->grand_total - $paidFee;
                }
                ?>

                </tbody>
            </table>
            <p><span class="pull-right alert alert-danger" ><b>Total Unpaid Amount  :  Rs. <?php echo $sum ;
                        ?></b></span></p>
        </div>

        <!-- Table -->

    </div>

</div>