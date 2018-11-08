<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Trial Balance</div>
    <div class="panel-body">

        <form action="<?php echo base_url().'/accounts/trial_balance';?>" method="post">
            <div class="row">
                <div class="col-sm-1"><label class="control-label">From: </label></div>
                <div class="col-sm-2"><input type="text" name="from_date" value="<?php echo date('Y-m-d');?>" class="form-control enableDatePicker"></div>

                <div class="col-sm-1"><label class="control-label">To: </label></div>
                <div class="col-sm-2"><input type="text" name="to_date" value="<?php echo date('Y-m-d');?>" class="form-control enableDatePicker"></div>

                <div class="col-sm-1"><label class="control-label">&nbsp;</label><input type="submit" value="Submit" class="btn btn-info"></div>
            </div>
        </form>
        <br />

        <b>From:</b> <?php echo $fromDate;?> <br />
        <b>To:</b> <?php echo $toDate;?> <br /> <br />
        <table class="table table-responsive table-condensed table-bordered table-hover table-stripped">

            <thead>
            <tr>
                <th>Sr. </th>
                <th>Account Name</th>
                <th>Debit</th>
                <th>Credit</th>
            </tr>
            </thead>
            <tbody>
            <?php
//             echo $trial_balance;

            $sr = 1;
            $dr_amount = 0;
            $cr_amount = 0;
                foreach ($trial_balance as $key => $value){
                    if(array_key_exists(0, $value)){

                        $dAmount = 0;
                        $cAmount = 0;
                        foreach ($value as $val){
                            ?>
                            <tr>
                                <td ><?php echo $sr;?></td>
                                <td ><?php echo $val['account_name']?></td>
                                <td ><?php echo $val['debit_amount']?></td>
                                <td ><?php echo $val['credit_amount']?></td>
                            </tr>

                            <?php
                            $sr++;
                            $dr_amount += $val['debit_amount'];
                            $cr_amount += $val['credit_amount'];
                        }
                    }
                    else {


                        ?>
                        <tr>
                            <td><?php echo $sr; ?></td>
                            <td><?php echo $value['account_name'] ?></td>
                            <td><?php echo $value['debit_amount'] ?></td>
                            <td><?php echo $value['credit_amount'] ?></td>
                        </tr>

                        <?php
                        $sr++;
                        $dr_amount += $value['debit_amount'];
                        $cr_amount += $value['credit_amount'];

                    }

                }
            ?>

            <tr>
                <td></td>
                <td class="text-right">Total:</td>
                <td><?php echo $dr_amount; ?></td>
                <td><?php echo $cr_amount; ?></td>
            </tr>

            </tbody>
        </table>

    </div>

</div>
