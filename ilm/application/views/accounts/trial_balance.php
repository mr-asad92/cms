<div class="panel panel-primary">
    <!-- Default panel contents -->
    <div class="panel-heading">Trial Balance</div>
    <div class="panel-body">
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
